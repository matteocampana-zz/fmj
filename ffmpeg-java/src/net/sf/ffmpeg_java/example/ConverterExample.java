package net.sf.ffmpeg_java.example;

import net.sf.ffmpeg_java.AVCodecLibrary;
import net.sf.ffmpeg_java.AVFormatLibrary;
import net.sf.ffmpeg_java.AVUtilLibrary;
import net.sf.ffmpeg_java.AVUtilLibraryWorkarounds;
import net.sf.ffmpeg_java.AVCodecLibrary.AVCodec;
import net.sf.ffmpeg_java.AVCodecLibrary.AVCodecContext;
import net.sf.ffmpeg_java.AVCodecLibrary.AVFrame;
import net.sf.ffmpeg_java.AVFormatLibrary.AVFormatContext;
import net.sf.ffmpeg_java.AVFormatLibrary.AVOutputFormat;
import net.sf.ffmpeg_java.AVFormatLibrary.AVPacket;
import net.sf.ffmpeg_java.AVFormatLibrary.AVStream;
import net.sf.ffmpeg_java.AVFormatLibrary.ByteIOContext;

import com.sun.jna.Pointer;
import com.sun.jna.ptr.IntByReference;
import com.sun.jna.ptr.PointerByReference;

/**
 * ConverterExample - Based on AVCodecSample and OutputExample
 * Converts a video file with the first video and the first audio stream to a new format given by filename extension.
 * Output parameters (width, height, fps, aspect ratio, linesize) are imported from input file and can not be modified yet.
 * Rest is set to standard.
 * There are still many problems. Only successfully tested with MPEG1/2 videos as input and output (without ac3).
 * 
 * TODO: 
 * the functionality is very restricted. No change of video size, bitrate,
 * ... via command line. AC3 sound is decoded in a wrong way. And the really worst:
 * java crashes at the call "AVFORMAT.av_close_input_file(inFormatCtx);" ... probably
 * not free all pointer?!
 * 
 * @author Uwe Mannl
 *
 */
public class ConverterExample {

	final static int STREAM_BITRATE = 1048576;
	final static int STREAM_BITRATE_TOLERANCE = 50000;
	final static int STREAM_PIX_FMT = AVFormatLibrary.PIX_FMT_YUV420P;
	
	final static AVFormatLibrary AVFORMAT = AVFormatLibrary.INSTANCE;
	final static AVCodecLibrary AVCODEC = AVCodecLibrary.INSTANCE;
	final static AVUtilLibrary AVUTIL = AVUtilLibrary.INSTANCE;
	
	static AVFrame picture, tmp_picture;
	static int video_outbuf_size, audio_outbuf_size, audio_input_frame_size, samples_size;
//	static int sws_flags = SWScaleLibrary.SWS_BICUBIC;
	
	static Pointer video_outbuf, audio_outbuf, samples;
	
	static int outWidth, outHeight;
	
	public static void main(String[] args) throws Exception
	{
		if (args.length < 2)
			throw new RuntimeException("First argument must be input filename, second argument output filename");
		
		final String inFileName = args[0];
		final String outFileName = args[1];
	
		// not sure what the consequences of such a mismatch are, but it is worth logging a warning:
		if (AVCODEC.avcodec_version() != AVCodecLibrary.LIBAVCODEC_VERSION_INT)
			//System.err.println("ffmpeg-java and ffmpeg versions do not match: avcodec_version=" + AVCODEC.avcodec_version() + " LIBAVCODEC_VERSION_INT=" + AVCodecLibrary.LIBAVCODEC_VERSION_INT);

		AVFORMAT.av_register_all();
		
//		AVCODEC.avcodec_init(); // no one knows whether this is neccessary
	
		final PointerByReference ppInFormatCtx = new PointerByReference();
		
		// Open input video file
		if (AVFORMAT.av_open_input_file(ppInFormatCtx, inFileName, null, 0, null) != 0)
		    throw new RuntimeException("Couldn't open file"); // Couldn't open file
		
		final AVFormatContext inFormatCtx = new AVFormatContext(ppInFormatCtx.getValue());
		//System.out.println(new String(inFormatCtx.filename));
		
		/* auto detect the output format from the name. default is
	       mpeg2. */
		AVOutputFormat fmt = null;
		fmt = AVFORMAT.guess_format(null, outFileName, null);
		if (fmt == null) {
			System.out.println("Could not deduce output format from file extension: using VOB.");
			fmt = AVFORMAT.guess_format("vob", null, null);
		}
		if (fmt == null) {
			System.err.println("Could not find suitable output format");
			System.exit(1);
		}
		
		// Retrieve input stream information
		if (AVFORMAT.av_find_stream_info(inFormatCtx) < 0)
		    throw new RuntimeException("Couldn't find stream information"); // Couldn't find stream information
	
		AVFORMAT.dump_format(inFormatCtx, 0, inFileName, 0);
		
	    // Find the first video stream
	    int inVideoStreamNr=-1;
	    for (int i=0; i<inFormatCtx.nb_streams; i++)
	    { 
	    	final AVStream inStream = new AVStream(inFormatCtx.getStreams()[i]);
	    	final AVCodecContext inCodecCtx = new AVCodecContext(inStream.codec);
	    	if (inCodecCtx.codec_type == AVCodecLibrary.CODEC_TYPE_VIDEO)
	        {
	            inVideoStreamNr=i;
	            outHeight = inCodecCtx.height;
	            outWidth = inCodecCtx.width;
	            break;
	        }
	    }
	    if (inVideoStreamNr==-1)
	        throw new RuntimeException("Didn't find a video stream"); // Didn't find a video stream
	    
	    int inAudioStreamNr=-1;
	    for (int i=0; i<inFormatCtx.nb_streams; i++)
	    {
	    	final AVStream inStream = new AVStream(inFormatCtx.getStreams()[i]);
	    	final AVCodecContext inCodecCtx = new AVCodecContext(inStream.codec);
	    	if (inCodecCtx.codec_type == AVCodecLibrary.CODEC_TYPE_AUDIO)
	        {
	    		inAudioStreamNr=i;
	            break;
	        }
	    }
    
	    // Get a pointer to the codec context for the video stream
	    final Pointer pInVideoCodecCtx = new AVStream(inFormatCtx.getStreams()[inVideoStreamNr]).codec;
	    final AVCodecContext inVideoCodecCtx = new AVCodecContext(pInVideoCodecCtx);
	    
	    if (inVideoCodecCtx.codec_id == 0)
	    	throw new RuntimeException("Video codec id is zero (no codec)");

	    // Find the decoder for the video stream
	    final AVCodec inVideoCodec = AVCODEC.avcodec_find_decoder(inVideoCodecCtx.codec_id);
	    if (inVideoCodec == null)
	        throw new RuntimeException("Video codec not found for codec_id " + inVideoCodecCtx.codec_id); // Codec not found
	    
	    // Open video codec
	    if (AVCODEC.avcodec_open(inVideoCodecCtx, inVideoCodec) < 0)
	    	 throw new RuntimeException("Could not open video codec"); // Could not open codec
	    
	    Pointer pInAudioCodecCtx = null;
	    AVCodecContext inAudioCodecCtx = null;
	    
	    if (inAudioStreamNr==-1)
	    	System.err.println("Didn't find a audio stream");
	    else {
		    // Get a pointer to the codec context for the audio stream
	    	pInAudioCodecCtx = new AVStream(inFormatCtx.getStreams()[inAudioStreamNr]).codec;
		    inAudioCodecCtx = new AVCodecContext(pInAudioCodecCtx);
	
		    if (inAudioCodecCtx.codec_id == 0)
		    	throw new RuntimeException("Audio codec id is zero (no codec)");
		    
		    // Find the decoder for the audio stream
		    final AVCodec inAudioCodec = AVCODEC.avcodec_find_decoder(inAudioCodecCtx.codec_id);
		    if (inAudioCodec == null)
		        throw new RuntimeException("Audio codec not found for codec_id " + inAudioCodecCtx.codec_id); // Codec not found
	
		    // Open audio codec
		    if (AVCODEC.avcodec_open(inAudioCodecCtx, inAudioCodec) < 0)
		    	 throw new RuntimeException("Could not open audio codec"); // Could not open codec
	    }
	    
	    // Allocate video frame
	    final AVFrame frame = AVCODEC.avcodec_alloc_frame();
	    if (frame == null)
	    	throw new RuntimeException("Could not allocate frame");

		/* allocate the output media context */
		AVFormatContext outFormatCtx = AVFORMAT.av_alloc_format_context();
		if (outFormatCtx == null) {
			System.err.println("Memory error");
			System.exit(1);
		}
		outFormatCtx.oformat = fmt.getPointer();
		outFormatCtx.filename = outFileName.getBytes();
		
		/* add the audio and video streams using the default format codecs
	       and initialize the codecs */
		AVStream outAudioStream, outVideoStream;
		outAudioStream = null;
		outVideoStream = null;
		if (fmt.video_codec != AVCodecLibrary.CODEC_ID_NONE) {
			outVideoStream = add_video_stream(outFormatCtx, inFormatCtx.getStreams()[inVideoStreamNr], fmt.video_codec);
		}
		if ((fmt.audio_codec != AVCodecLibrary.CODEC_ID_NONE) && (inAudioStreamNr != -1)) {
			outAudioStream = add_audio_stream(outFormatCtx, inFormatCtx.getStreams()[inAudioStreamNr], fmt.audio_codec);
		}
		
		/* set the output parameters (mustbe done even if no parameters). */
		if (AVFORMAT.av_set_parameters(outFormatCtx, null) < 0) {
			System.err.println("Invalid output format parameters.");
			System.exit(1);
		}
		
		AVFORMAT.dump_format(outFormatCtx, 0, outFileName, 1);
		
		/* now that all the parameters are set, we can open the audio and
	       video codecs and allocate the necessary encode buffers */
		if (outVideoStream != null) {
			open_video(outFormatCtx, outVideoStream);
		}
		if (outAudioStream != null) {
			open_audio(outFormatCtx, outAudioStream);
		}
		
		/* open the output file, if needed */
		if ((fmt.flags & AVFormatLibrary.AVFMT_NOFILE) == 0) {
			final PointerByReference p = new PointerByReference();
			if (AVFORMAT.url_fopen(p, outFileName, AVFormatLibrary.URL_WRONLY) < 0) {
				System.err.println("Could not open " + outFileName);
				System.exit(1);
			}
			outFormatCtx.pb = p.getValue();
		}
	    
		AVFORMAT.av_write_header(outFormatCtx);
		
	    // Read frames and save to new video
	    final AVPacket packet = new AVPacket();
    	AVCodecContext outVideoCodecCtx = new AVCodecContext(outVideoStream.codec);
    	AVCodecContext outAudioCodecCtx = null;
    	if (outAudioStream != null)
    		outAudioCodecCtx = new AVCodecContext(outAudioStream.codec);
    	
	    while (AVFORMAT.av_read_frame(inFormatCtx, packet) >= 0)
	    {
	    	// Is this a packet from the video stream?
	        if (packet.stream_index == inVideoStreamNr)
	        {
	        	final IntByReference frameFinished = new IntByReference();
	            // Decode video frame
	        	AVCODEC.avcodec_decode_video(inVideoCodecCtx, frame, frameFinished, packet.data, packet.size);

	            // Did we get a video frame?
	            if (frameFinished.getValue() != 0)
	            {
	                // Save the frame into new video

	            	copy_image(frame, picture, inVideoCodecCtx.width, inVideoCodecCtx.height);
	            	
	                int out_size = AVCODEC.avcodec_encode_video(outVideoCodecCtx, video_outbuf, video_outbuf_size, picture);
	    			/* if zero size, it means the image was buffered */
	    			if (out_size > 0) {
	    				AVPacket pkt = new AVPacket();
	    				AVFORMAT.av_init_packet(pkt);
	    				AVFrame tmp_frame = new AVFrame(outVideoCodecCtx.coded_frame);
	    				
	    				pkt.pts = AVUtilLibraryWorkarounds.av_rescale_q(tmp_frame.pts, outVideoCodecCtx.time_base, outVideoStream.time_base);
	    				if (tmp_frame.key_frame == 1)
	    					pkt.flags |= AVFormatLibrary.PKT_FLAG_KEY;
	    				pkt.stream_index = outVideoStream.index;	
	    				pkt.data = video_outbuf;
	    				pkt.size = out_size;
	    				
	    				/* write the compressed frame in the media file */
	    				int ret = AVFORMAT.av_write_frame(outFormatCtx, pkt);
	    				if (ret != 0) {
	    					System.err.println("Error while writing video frame");
	    					System.exit(1);
	    				}
	    		        
	    		        if (pkt.destruct != null)
	    		        	pkt.destruct.callback(pkt);
	    		        
	    			} // if (out_size > 0)
	    				    			
	            } // if (frameFinished.getValue() != 0)
	            
	        } // if (packet.stream_index == inVideoStream)
	        
	        else if (packet.stream_index == inAudioStreamNr) {
        	
	        	final IntByReference frameSizePtr = new IntByReference();
	        	frameSizePtr.setValue(samples_size);
        		AVCODEC.avcodec_decode_audio2(inAudioCodecCtx, samples, frameSizePtr, packet.data, packet.size);
	        	
	            // Did we get an audio frame?
	            if (frameSizePtr.getValue() != 0) {

	            	int out_size = AVCODEC.avcodec_encode_audio(outAudioCodecCtx, audio_outbuf, audio_outbuf_size, samples);
					
					if (out_size > 0) {
						AVPacket pkt = new AVPacket();
						AVFORMAT.av_init_packet(pkt);
						
						pkt.size = out_size;
						
						AVFrame tmp_frame = new AVFrame(outAudioCodecCtx.coded_frame);
						pkt.pts = AVUtilLibraryWorkarounds.av_rescale_q(tmp_frame.pts, outAudioCodecCtx.time_base, outAudioStream.time_base);
						pkt.flags |= AVFormatLibrary.PKT_FLAG_KEY;
						pkt.stream_index = outAudioStream.index;
						pkt.data = audio_outbuf;
	    				
	    				/* write the compressed frame in the media file */
	    				int ret = AVFORMAT.av_write_frame(outFormatCtx, pkt);
	    				if (ret != 0) {
	    					System.err.println("Error while writing audio frame");
	    					System.exit(1);
	    				}
	    				
	    		        if (pkt.destruct != null)
	    		        	pkt.destruct.callback(pkt);
	    		        
					} // if (out_size > 0)
					
	            } // if (frameSizePtr.getValue() != 0)
	            
	        } // else if (packet.stream_index == inAudioStream)

	        // Free the packet that was allocated by av_read_frame
	        // AVFORMAT.av_free_packet(packet.getPointer()) - cannot be called because it is an inlined function.
	        // so we'll just do the JNA equivalent of the inline:
	        if (packet.destruct != null)
	        	packet.destruct.callback(packet);

	    } // while (AVFORMAT.av_read_frame(inFormatCtx, packet) >= 0)
	    
		/* close each codec */
		if (outVideoStream != null)
			close_video(outFormatCtx, outVideoStream);
		if (outAudioStream != null)
			close_audio(outFormatCtx, outAudioStream);
		
		/* write the trailer, if any */
		AVFORMAT.av_write_trailer(outFormatCtx);
		
		if ((fmt.flags & AVFormatLibrary.AVFMT_NOFILE) == 0) {
			/* close the output file */
			AVFORMAT.url_fclose(new ByteIOContext(outFormatCtx.pb));
		}
		
		/* free the stream */
		AVUTIL.av_free(outVideoCodecCtx.getPointer());
		if (outAudioStream != null)
			AVUTIL.av_free(outAudioCodecCtx.getPointer());
		AVUTIL.av_free(outFormatCtx.getPointer());
		
	    // Free the YUV frame
	    AVUTIL.av_free(frame.getPointer());

    	AVStream inVideoStream = new AVStream(inFormatCtx.getStreams()[inVideoStreamNr]);
    	AVUTIL.av_free(inVideoStream.codec);
    	AVUTIL.av_free(inFormatCtx.streams0);
    	
    	if (outAudioStream != null) {
	    	AVStream inAudioStream = new AVStream(inFormatCtx.getStreams()[inAudioStreamNr]);
	    	AVUTIL.av_free(inAudioStream.codec);
	    	AVUTIL.av_free(inFormatCtx.streams1);
    	}
    	
    	AVUTIL.av_free(inVideoCodecCtx.getPointer());
    	if (outAudioStream != null)
    		AVUTIL.av_free(inAudioCodecCtx.getPointer());
    	AVUTIL.av_free(inFormatCtx.getPointer());
    	
	    // Close the codec
	    AVCODEC.avcodec_close(inVideoCodecCtx);
	    if (outAudioStream != null)
	    	AVCODEC.avcodec_close(inAudioCodecCtx);

	    // Close the video file
//	    AVFORMAT.av_close_input_file(inFormatCtx); // TODO: crashes ?!

	}
	
	private static void copy_image(AVFrame inPic, AVFrame outPic, int width, int height) {
//		int x, y;
//		
//		/* Y */
//		for (y = 0; y < height; y++) {
//			for (x = 0; x < width; x++) {
//			outPic.data0.setByte(y * outPic.linesize[0] + x, inPic.data0.getByte(y * outPic.linesize[0] + x));	
//			}
//		}
//		
//		/* Cb and Cr */
//		for (y = 0; y < height/2; y++) {
//			for (x = 0; x < width/2; x++) {
//				outPic.data1.setByte(y * outPic.linesize[1] + x, inPic.data1.getByte(y * outPic.linesize[1] + x));
//				outPic.data2.setByte(y * outPic.linesize[2] + x, inPic.data2.getByte(y * outPic.linesize[2] + x));
//			}
//		}
		
		outPic.data0 = inPic.data0;
		outPic.data1 = inPic.data1;
		outPic.data2 = inPic.data2;

		// TODO: this should be calculated by outcodec parameters
		outPic.linesize = inPic.linesize;
	}
	
	private static void close_audio(AVFormatContext ofc, AVStream st) {
		AVCodecContext tmp_codec = new AVCodecContext(st.codec);
		AVCODEC.avcodec_close(tmp_codec);
		AVUTIL.av_free(st.codec);
		AVUTIL.av_free(ofc.streams1);		
		AVUTIL.av_free(samples);
		AVUTIL.av_free(audio_outbuf);
	}
	
	private static void close_video(AVFormatContext ofc, AVStream st) {
		AVCodecContext tmp_codec = new AVCodecContext(st.codec);
		AVCODEC.avcodec_close(tmp_codec);
		AVUTIL.av_free(st.codec);
		AVUTIL.av_free(ofc.streams0);
		AVUTIL.av_free(picture.data0); // TODO: remove if not necessary (picture.data0 = frame.data0)
		AVUTIL.av_free(picture.getPointer());
		if (tmp_picture != null) {
			AVUTIL.av_free(tmp_picture.data0);
			AVUTIL.av_free(tmp_picture.getPointer());
		}
		AVUTIL.av_free(video_outbuf);
	}
	
	private static AVStream add_audio_stream(AVFormatContext oc, Pointer is, int codec_id) {
		AVStream st;
		
		st = AVFORMAT.av_new_stream(oc, 1);
		if (st == null) {
			System.err.println("Could not alloc audio stream");
			System.exit(1);
		}
		
		AVCodecContext ic = new AVCodecContext(new AVStream(is).codec);
		
		AVCodecContext c = new AVCodecContext(st.codec);
		c.codec_id = codec_id;
		c.codec_type = AVCodecLibrary.CODEC_TYPE_AUDIO;
		
		/* put sample parameters */
		c.bit_rate = 64000;
		c.sample_rate = ic.sample_rate;
		c.channels = 2;
		
		c.write(); // very very important!!!
		
		return st;
	}
	
	private static AVStream add_video_stream(AVFormatContext oc, Pointer is, int codec_id) {
		AVStream st;
		
		st = AVFORMAT.av_new_stream(oc, 0);
		if (st == null) {
			System.err.println("Could not alloc video stream.");
			System.exit(1);
		}
		AVCodecContext c = new AVCodecContext(st.codec);
		c.codec_id = codec_id;
		c.codec_type = AVCodecLibrary.CODEC_TYPE_VIDEO;
		
		AVCodecContext ic = new AVCodecContext(new AVStream(is).codec);
		
		/* put sample parameters */
		c.bit_rate = STREAM_BITRATE;
		c.bit_rate_tolerance = STREAM_BITRATE_TOLERANCE;

		/* resolution must be a multiple of two */
		c.width = outWidth;
		c.height = outHeight;
		/* time base: this is the fundamental unit of time (in seconds) in terms
	       of which frame timestamps are represented. for fixed-fps content,
	       timebase should be 1/framerate and timestamp increments should be
	       identically 1. */
		c.time_base.den = ic.time_base.den;
		c.time_base.num = ic.time_base.num;
		c.gop_size = 12;
		c.pix_fmt = STREAM_PIX_FMT;
		
		// TODO: calculate display aspect ratio (16:9, 4:3, 1:1) from input file
		// very bad: i have deleted the file Additions.java with a port of av_d2q
//		AVRational bla = AVUtilLibraryWorkarounds.av_d2q(11.0/9.0*c.height/c.width, 255);
//		c.sample_aspect_ratio = bla;
		c.sample_aspect_ratio = ic.sample_aspect_ratio;
		
		if (c.codec_id == AVCodecLibrary.CODEC_ID_MPEG2VIDEO) {
			/* just for testing, we also add B frames */
			c.max_b_frames = 2;
		}
		if (c.codec_id == AVCodecLibrary.CODEC_ID_MPEG1VIDEO) {
			/* Needed to avoid using macroblocks in which some coeffs overflow.
	           This does not happen with normal video, it just happens here as
	           the motion of the chroma plane does not match the luma plane. */
			c.mb_decision = 2;

		}
		// some formats want stream headers to be separate
		AVOutputFormat tmp_fmt = new AVOutputFormat(oc.oformat);
		if (tmp_fmt.name.equals("mp4") || tmp_fmt.name.equals("mov") || tmp_fmt.name.equals("3gp")) {
			c.flags |= AVCodecLibrary.CODEC_FLAG_GLOBAL_HEADER;
		}
		
		c.write(); // very very important!!!

		return st;
	}
	
	private static void open_audio(AVFormatContext oc, AVStream st) {
		AVCodec codec;
		AVCodecContext c = new AVCodecContext(st.codec);
		
		/* find the audio encoder */
		codec = AVCODEC.avcodec_find_encoder(c.codec_id);
		if (codec == null) {
			System.err.println("audio codec not found");
			System.exit(1);
		}
		
		/* open it */
		if (AVCODEC.avcodec_open(c, codec) < 0) {
			System.err.println("could not open audio codec");
			System.exit(1);
		}
		
		audio_outbuf_size = AVCodecLibrary.AVCODEC_MAX_AUDIO_FRAME_SIZE;;
		audio_outbuf = AVUTIL.av_malloc(audio_outbuf_size);
		
		/* ugly hack for PCM codecs (will be removed ASAP with new PCM
		   support to compute the input frame size in samples */
		if (c.frame_size <= 1) {
			audio_input_frame_size = audio_outbuf_size / c.channels;
			switch (c.codec_id) {
			case AVCodecLibrary.CODEC_ID_PCM_S16LE:
			case AVCodecLibrary.CODEC_ID_PCM_S16BE:
			case AVCodecLibrary.CODEC_ID_PCM_U16LE:
			case AVCodecLibrary.CODEC_ID_PCM_U16BE:
				audio_input_frame_size >>= 1;
				break;
			default:
				break;
			}
		} else {
			audio_input_frame_size = c.frame_size;
		}
//		samples_size = audio_input_frame_size * 2 * c.channels * 100;
		samples_size = AVCodecLibrary.AVCODEC_MAX_AUDIO_FRAME_SIZE;
		samples = AVUTIL.av_malloc(samples_size);
	}
	
	private static void open_video(AVFormatContext oc, AVStream st) {
		AVCodec codec;
		AVCodecContext c = new AVCodecContext(st.codec);
		
		/* find the video encoder */
		codec = AVCODEC.avcodec_find_encoder(c.codec_id);
		if (codec == null) {
			System.err.println("video codec not found");
			System.exit(1);
		}
		
		/* open the codec */
		if (AVCODEC.avcodec_open(c, codec) < 0) {
			System.err.println("could not open video codec");
			System.exit(1);
		}
		
		video_outbuf = null;
		AVOutputFormat tmp_fmt = new AVOutputFormat(oc.oformat);
		if ((tmp_fmt.flags & AVFormatLibrary.AVFMT_RAWPICTURE) == 0) {
			/* allocate output buffer */
	        /* buffers passed into lav* can be allocated any way you prefer,
	           as long as they're aligned enough for the architecture, and
	           they're freed appropriately (such as using av_free for buffers
	           allocated with av_malloc) */
			video_outbuf_size = 500000;
			video_outbuf = AVUTIL.av_malloc(video_outbuf_size);
		}
		
		/* allocate the encoded raw picture */
		alloc_picture(c.pix_fmt, c.width, c.height);
		if (picture == null) {
			System.err.println("could not allocate picture");
			System.exit(1);
		}
		
		/* if the output format is not YUV420P, then a temporary YUV420P
	       picture is needed too. It is then converted to the required
	       output format */
		tmp_picture = null;
		if (c.pix_fmt != AVFormatLibrary.PIX_FMT_YUV420P) {
			tmp_picture = alloc_picture(AVFormatLibrary.PIX_FMT_YUV420P, c.width, c.height);
			if (tmp_picture == null) {
				System.err.println("could not allocate temporary picture");
				System.exit(1);
			}
		}
	}
	
	private static AVFrame alloc_picture(int pix_fmt, int width, int height) {
		Pointer picture_buf;
		int size;
		
		picture = AVCODEC.avcodec_alloc_frame();
		if (picture == null) {
			return null;
		}
		size = AVCODEC.avpicture_get_size(pix_fmt, width, height);
		picture_buf = AVUTIL.av_malloc(size);
		if (picture_buf == null) {
			AVUTIL.av_free(picture.getPointer());
			return null;
		}
		AVCODEC.avpicture_fill(picture, picture_buf, pix_fmt, width, height);
		
		// TODO: calculate it with outcodec parameters
//		picture.linesize[0] = 384;
//		picture.linesize[1] = 192;
//		picture.linesize[2] = 192;
		
		return picture;
	}
	
}
