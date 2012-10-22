package net.sf.ffmpeg_java.example;

import net.sf.ffmpeg_java.AVCodecLibrary;
import net.sf.ffmpeg_java.AVFormatLibrary;
import net.sf.ffmpeg_java.AVUtilLibrary;
import net.sf.ffmpeg_java.AVUtilLibraryWorkarounds;
import net.sf.ffmpeg_java.SWScaleLibrary;
import net.sf.ffmpeg_java.AVCodecLibrary.AVCodec;
import net.sf.ffmpeg_java.AVCodecLibrary.AVCodecContext;
import net.sf.ffmpeg_java.AVCodecLibrary.AVFrame;
import net.sf.ffmpeg_java.AVFormatLibrary.AVFormatContext;
import net.sf.ffmpeg_java.AVFormatLibrary.AVOutputFormat;
import net.sf.ffmpeg_java.AVFormatLibrary.AVPacket;
import net.sf.ffmpeg_java.AVFormatLibrary.AVStream;
import net.sf.ffmpeg_java.AVFormatLibrary.ByteIOContext;
import net.sf.ffmpeg_java.example.Additions.SwsContext;

import com.sun.jna.Pointer;
import com.sun.jna.ptr.PointerByReference;

/**
 * Based on the example "output_example.c" provided with FFMPEG.  GPL version (with SWSCALE).
 * @author	Uwe Mannl
 *
 */
public class OutputExampleGPL {

	final static float STREAM_DURATION = 5.0f;
	final static int STREAM_FRAME_RATE = 25;
	final static int STREAM_NB_FRAMES = (int) (STREAM_DURATION * STREAM_FRAME_RATE);
	final static int STREAM_PIX_FMT = AVFormatLibrary.PIX_FMT_YUV420P;
	final static float M_PI = 3.14159265358979323846f;
	
	final static AVFormatLibrary AVFORMAT = AVFormatLibrary.INSTANCE;
	final static AVCodecLibrary AVCODEC = AVCodecLibrary.INSTANCE;
	final static AVUtilLibrary AVUTIL = AVUtilLibrary.INSTANCE;
	final static SWScaleLibrary SWSCALE = SWScaleLibrary.INSTANCE;
	
	static AVFrame picture, tmp_picture;
	static int frame_count, video_outbuf_size, audio_outbuf_size, audio_input_frame_size;
	static int sws_flags = SWScaleLibrary.SWS_BICUBIC;
	static float t, tincr, tincr2;
	
	static Pointer video_outbuf;
	static Pointer audio_outbuf;
	static Pointer samples;
	
	public static void main(String[] args) {

		String filename = null;
		AVOutputFormat fmt = null;
		AVFormatContext oc = null;
		AVStream audio_st, video_st;
		double audio_pts, video_pts;
		int i;
		
		/* initialize libavcodec, and register all codecs and formats */
		AVFORMAT.av_register_all();
		if (args.length != 1) {
			System.out.println("usage: java OutputExample output_filename");
			System.exit(1);
		}
		
		filename = args[0];
		
		/* auto detect the output format from the name. default is
	       mpeg. */
		fmt = AVFORMAT.guess_format(null, filename, null);
		if (fmt == null) {
			System.out.println("Could not deduce output format from file extension: using MPEG.");
			fmt = AVFORMAT.guess_format("mpeg2video", null, null);
		}
		
		if (fmt == null) {
			System.err.println("Could not find suitable output format");
			System.exit(1);
		}
		
		/* allocate the output media context */
		oc = AVFORMAT.av_alloc_format_context();
		if (oc == null) {
			System.err.println("Memory error");
			System.exit(1);
		}
		oc.oformat = fmt.getPointer();
		oc.filename = filename.getBytes();
		
		/* add the audio and video streams using the default format codecs
	       and initialize the codecs */
		audio_st = null;
		video_st = null;
		if (fmt.video_codec != AVCodecLibrary.CODEC_ID_NONE) {
			video_st = add_video_stream(oc, fmt.video_codec);
		}
		if (fmt.audio_codec != AVCodecLibrary.CODEC_ID_NONE) {
			audio_st = add_audio_stream(oc, fmt.audio_codec);
		}
		
		/* set the output parameters (mustbe done even if no parameters). */
		if (AVFORMAT.av_set_parameters(oc, null) < 0) {
			System.err.println("Invalid output format parameters.");
			System.exit(1);
		}
		
		AVFORMAT.dump_format(oc, 0, filename, 1);
		
		/* now that all the parameters are set, we can open the audio and
	       video codecs and allocate the necessary encode buffers */
		if (video_st != null) {
			open_video(oc, video_st);
		}
		if (audio_st != null) {
			open_audio(oc, audio_st);
		}
		
		/* open the output file, if needed */
		if ((fmt.flags & AVFormatLibrary.AVFMT_NOFILE) == 0) {
			final PointerByReference p = new PointerByReference();
			if (AVFORMAT.url_fopen(p, filename, AVFormatLibrary.URL_WRONLY) < 0) {
				System.err.println("Could not open " + filename);
				System.exit(1);
			}
			oc.pb = p.getValue();
		}
		
		AVFORMAT.av_write_header(oc);
		
		for (;;) {
			/* compute current audio and video time */
			if (audio_st != null)
				audio_pts = (double) audio_st.pts.val * audio_st.time_base.num / audio_st.time_base.den;
			else
				audio_pts = 0.0;
			
			if (video_st != null)
				video_pts = (double) video_st.pts.val * video_st.time_base.num / video_st.time_base.den;
	        else
	            video_pts = 0.0;
			
			if ((audio_st == null) || (audio_pts >= STREAM_DURATION) &&
				(video_st == null) || (video_pts >= STREAM_DURATION))
				break;
			
			/* write interleaved audio and video frames */
			if ((video_st == null) || ((video_st != null) && (audio_st != null) && audio_pts < video_pts)) {
				write_audio_frame(oc, audio_st);
			} else {
				write_video_frame(oc, video_st);
			}
		}
		
		/* close each codec */
		if (video_st != null)
			close_video(oc, video_st);
		if (audio_st != null)
			close_audio(oc, audio_st);
		
		/* write the trailer, if any */
		AVFORMAT.av_write_trailer(oc);
		
		/* free the streams */
		// TODO: free all streams
		for (i = 0; i < oc.nb_streams; i++) {
			AVStream tmp_stream = new AVStream(oc.streams0);
			AVUTIL.av_free(tmp_stream.codec);
			AVUTIL.av_free(oc.streams0);
		}

		if ((fmt.flags & AVFormatLibrary.AVFMT_NOFILE) == 0) {
			/* close the output file */
			AVFORMAT.url_fclose(new ByteIOContext(oc.pb));
		}
		
		/* free the stream */
		AVUTIL.av_free(oc.getPointer());
	}

	private static void write_audio_frame(AVFormatContext oc, AVStream st) {
		AVCodecContext c = new AVCodecContext(st.codec);
		AVPacket pkt = new AVPacket();
		AVFORMAT.av_init_packet(pkt);
		
		get_audio_frame(samples, audio_input_frame_size, c.channels);
		
		pkt.size = AVCODEC.avcodec_encode_audio(c, audio_outbuf, audio_outbuf_size, samples);
		
		AVFrame tmp_frame = new AVFrame(c.coded_frame);
		pkt.pts = AVUtilLibraryWorkarounds.av_rescale_q(tmp_frame.pts, c.time_base, st.time_base);
		pkt.flags |= AVFormatLibrary.PKT_FLAG_KEY;
		pkt.stream_index = st.index;
		pkt.data = audio_outbuf;
		
		/* write the compressed frame in the media file */
		if (AVFORMAT.av_write_frame(oc, pkt) != 0) {
			System.err.println("Error while writing audio_frame");
			System.exit(1);
		}
		
		st.pts.val = pkt.pts; // necessary for calculation of audio length
	}

	private static void write_video_frame(AVFormatContext oc, AVStream st) {
		int out_size, ret;
		AVCodecContext c = new AVCodecContext(st.codec);
		SwsContext img_convert_ctx = null;
		
		if (frame_count >= STREAM_NB_FRAMES) {
			/* no more frame to compress. The codec has a latency of a few
	           frames if using B frames, so we get the last frames by
	           passing the same picture again */
		} else {
			if (c.pix_fmt != AVCodecLibrary.PIX_FMT_YUV420P) {
				/* as we only generate a YUV420P picture, we must convert it
	               to the codec pixel format if needed */
				if (img_convert_ctx == null) {
					img_convert_ctx = new SwsContext(
							SWSCALE.sws_getContext(
									c.width, c.height,
									AVCodecLibrary.PIX_FMT_YUV420P,
									c.width, c.height,
									c.pix_fmt, sws_flags,
									null, null, null));
					if (img_convert_ctx == null) {
						System.err.println("Cannot initialize the conversion context");
						System.exit(1);
					}
					
				}
				fill_yuv_image(tmp_picture, frame_count, c.width, c.height);
				// TODO: i'm sure this won't work - but it is ever called?
				SWSCALE.sws_scale(img_convert_ctx.getPointer(),
						tmp_picture.data0, tmp_picture.linesize,
						0, c.height, picture.data0, picture.linesize);
			} else {
				fill_yuv_image(picture, frame_count, c.width, c.height);
			}
		}
		
		AVOutputFormat tmp_fmt = new AVOutputFormat(oc.oformat);
		if ((tmp_fmt.flags & AVFormatLibrary.AVFMT_RAWPICTURE) == 1) {
			/* raw video case. The API will change slightly in the near
	           futur for that */
			AVPacket pkt = new AVPacket();
			AVFORMAT.av_init_packet(pkt);
			
			pkt.flags |= AVFormatLibrary.PKT_FLAG_KEY;
			pkt.stream_index = st.index;
			pkt.data = picture.getPointer();
			pkt.size = picture.size();
			
			ret = AVFORMAT.av_write_frame(oc, pkt);
		} else {
			/* encode the image */
			out_size = AVCODEC.avcodec_encode_video(c, video_outbuf, video_outbuf_size, picture);
			/* if zero size, it means the image was buffered */
			if (out_size > 0) {
				AVPacket pkt = new AVPacket();
				AVFORMAT.av_init_packet(pkt);
				
				AVFrame tmp_frame = new AVFrame(c.coded_frame);
				pkt.pts = AVUtilLibraryWorkarounds.av_rescale_q(tmp_frame.pts, c.time_base, st.time_base);
				if (tmp_frame.key_frame == 1)
					pkt.flags |= AVFormatLibrary.PKT_FLAG_KEY;
				pkt.stream_index = st.index;	
				pkt.data = video_outbuf;
				pkt.size = out_size;
				
				/* write the compressed frame in the media file */
				ret = AVFORMAT.av_write_frame(oc, pkt);
				
				st.pts.val = pkt.pts; // necessary for calculation of video length
			} else {
				ret = 0;
			}
		}
		if (ret != 0) {
			System.err.println("Error while writing video frame");
			System.exit(1);
		}
		frame_count++;		
	}

	private static void get_audio_frame(Pointer samples, int frame_size, int nb_channels) {
		int j, i, v;
		Pointer q;
		int qOffset = 0;
		
		q = samples;
		for (j = 0; j < frame_size; j++) {
			v = (int) (Math.sin(t) * 10000);
			for (i = 0; i < nb_channels; i++) {
				q.setInt(qOffset, v);
				qOffset += 2;
			}
			t += tincr;
			tincr += tincr2;
		}
	}
	
	private static void fill_yuv_image(AVFrame pict, int frame_index,
			int width, int height) {
		int x, y, i;
		i = frame_index;
		
		/* Y */
		for (y = 0; y < height; y++) {
			for (x = 0; x < width; x++) {
				//pict.data0 [y * pict.linesize[0] + x] = x + y + i * 3;
				pict.data0.setByte(y * pict.linesize[0] + x, (byte) (x + y + i * 3));
			}
		}
		
		/* Cb and Cr */
		for (y = 0; y < height/2; y++) {
			for (x = 0; x < width/2; x++) {
				//pict.data1 = new Pointer(128+y+i*2);
				//pict.data2 = new Pointer(64+x+i*5);
				pict.data1.setByte(y * pict.linesize[1] + x, (byte) (128 + y + i * 2));
				pict.data2.setByte(y * pict.linesize[2] + x, (byte) (64 + x + i * 5));
			}
		}
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
		
		/* init signal generator */
		t = 0;
		tincr = 2 * M_PI * 110.0f / c.sample_rate;
		/* increment frequency by 110 Hz per second */
		tincr2 = 2 * M_PI * 110.0f / c.sample_rate / c.sample_rate;
		
		audio_outbuf_size = 10000;
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
		samples = AVUTIL.av_malloc(audio_input_frame_size * 2 * c.channels);
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
			video_outbuf_size = 200000;
			video_outbuf = AVUTIL.av_malloc(video_outbuf_size);
		}
		
		/* allocate the encoded raw picture */
		picture = alloc_picture(c.pix_fmt, c.width, c.height);
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
		AVFrame picture;
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
		return picture;
	}

	private static void close_audio(AVFormatContext oc, AVStream st) {
		AVCodecContext tmp_codec = new AVCodecContext(st.codec);
		AVCODEC.avcodec_close(tmp_codec);
		
		AVUTIL.av_free(samples);
		AVUTIL.av_free(audio_outbuf);
	}
	
	private static void close_video(AVFormatContext oc, AVStream st) {
		AVCodecContext tmp_codec = new AVCodecContext(st.codec);
		AVCODEC.avcodec_close(tmp_codec);
		AVUTIL.av_free(picture.data0);
		AVUTIL.av_free(picture.getPointer());
		if (tmp_picture != null) {
			AVUTIL.av_free(tmp_picture.data0);
			AVUTIL.av_free(tmp_picture.getPointer());
		}
		AVUTIL.av_free(video_outbuf);
	}

	private static AVStream add_audio_stream(AVFormatContext oc, int codec_id) {
		AVStream st;
		
		st = AVFORMAT.av_new_stream(oc, 1);
		if (st == null) {
			System.err.println("Could not alloc audio stream");
			System.exit(1);
		}
		
		AVCodecContext c = new AVCodecContext(st.codec);
		c.codec_id = codec_id;
		c.codec_type = AVCodecLibrary.CODEC_TYPE_AUDIO;
		
		/* put sample parameters */
		c.bit_rate = 64000;
		c.sample_rate = 44100;
		c.channels = 2;
		
		c.write(); // very very important!!!
		
		return st;
	}
	
	private static AVStream add_video_stream(AVFormatContext oc, int codec_id) {
		AVStream st;
		
		st = AVFORMAT.av_new_stream(oc, 0);
		if (st == null) {
			System.err.println("Could not alloc video stream.");
			System.exit(1);
		}
		AVCodecContext c = new AVCodecContext(st.codec);
		c.codec_id = codec_id;
		c.codec_type = AVCodecLibrary.CODEC_TYPE_VIDEO;
		
		/* put sample parameters */
		c.bit_rate = 400000;
		/* resolution must be a multiple of two */
		c.width = 352;
		c.height = 288;
		/* time base: this is the fundamental unit of time (in seconds) in terms
	       of which frame timestamps are represented. for fixed-fps content,
	       timebase should be 1/framerate and timestamp increments should be
	       identically 1. */
		c.time_base.den = STREAM_FRAME_RATE;
		c.time_base.num = 1;
		c.gop_size = 12;
		c.pix_fmt = STREAM_PIX_FMT;
		
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

}
