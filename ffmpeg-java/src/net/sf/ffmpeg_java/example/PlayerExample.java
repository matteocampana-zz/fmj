package net.sf.ffmpeg_java.example;

import java.awt.Image;
import java.awt.Toolkit;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.awt.image.MemoryImageSource;

import net.sf.ffmpeg_java.AVCodecLibrary;
import net.sf.ffmpeg_java.AVFormatLibrary;
import net.sf.ffmpeg_java.AVUtilLibrary;
import net.sf.ffmpeg_java.AVCodecLibrary.AVCodec;
import net.sf.ffmpeg_java.AVCodecLibrary.AVCodecContext;
import net.sf.ffmpeg_java.AVCodecLibrary.AVFrame;
import net.sf.ffmpeg_java.AVFormatLibrary.AVFormatContext;
import net.sf.ffmpeg_java.AVFormatLibrary.AVPacket;
import net.sf.ffmpeg_java.AVFormatLibrary.AVStream;
import net.sf.ffmpeg_java.gui.ImageFrame;

import com.sun.jna.Pointer;
import com.sun.jna.ptr.IntByReference;
import com.sun.jna.ptr.PointerByReference;

/**
 * Based on AVCodecSample, but shows the movie in a window.
 * TODO: audio
 * TODO: timing
 * @author Ken Larson
 *
 */
public class PlayerExample
{
	public static void main(String[] args) throws Exception
	{
		if (args.length < 1)
			throw new RuntimeException("First argument must be path to movie file");
		
		final String filename = args[0];

		final AVFormatLibrary AVFORMAT = AVFormatLibrary.INSTANCE;
		final AVCodecLibrary AVCODEC = AVCodecLibrary.INSTANCE;
		final AVUtilLibrary AVUTIL = AVUtilLibrary.INSTANCE;
		
		
		// not sure what the consequences of such a mismatch are, but it is worth logging a warning:
		if (AVCODEC.avcodec_version() != AVCodecLibrary.LIBAVCODEC_VERSION_INT)
			System.err.println("ffmpeg-java and ffmpeg versions do not match: avcodec_version=" + AVCODEC.avcodec_version() + " LIBAVCODEC_VERSION_INT=" + AVCodecLibrary.LIBAVCODEC_VERSION_INT);

		AVFORMAT.av_register_all();
		

		final PointerByReference ppFormatCtx = new PointerByReference();
		
		// Open video file
		if (AVFORMAT.av_open_input_file(ppFormatCtx, filename, null, 0, null) != 0)
		    throw new RuntimeException("Couldn't open file"); // Couldn't open file
		
		final AVFormatContext formatCtx = new AVFormatContext(ppFormatCtx.getValue());
		System.out.println(new String(formatCtx.filename));
			
		// Retrieve stream information
		if (AVFORMAT.av_find_stream_info(formatCtx) < 0)
		    throw new RuntimeException("Couldn't find stream information"); // Couldn't find stream information
	
		AVFORMAT.dump_format(formatCtx, 0, filename, 0);
	
		
	    // Find the first video stream
	    int videoStream=-1;
	    for (int i=0; i<formatCtx.nb_streams; i++)
	    {   final AVStream stream = new AVStream(formatCtx.getStreams()[i]);
	    	final AVCodecContext codecCtx = new AVCodecContext(stream.codec);
	    	//System.out.println("codecCtx " + i + ": " + codecCtx);
	    	if (codecCtx.codec_type == AVCodecLibrary.CODEC_TYPE_VIDEO)
	        {
	            videoStream=i;
	            break;
	        }
	    }
	    if (videoStream==-1)
	        throw new RuntimeException("Didn't find a video stream"); // Didn't find a video stream
	    
	    //System.out.println("Video stream index: " + videoStream);
	    
	    // Get a pointer to the codec context for the video stream
	    final Pointer pCodecCtx = new AVStream(formatCtx.getStreams()[videoStream]).codec;
	    final AVCodecContext codecCtx = new AVCodecContext(pCodecCtx);
	    
	    //System.out.println("Codec id: " + codecCtx.codec_id);
	    
	    if (codecCtx.codec_id == 0)
	    	throw new RuntimeException("Codec id is zero (no codec)");
	    
	    // Find the decoder for the video stream
	    final AVCodec codec = AVCODEC.avcodec_find_decoder(codecCtx.codec_id);
	    if (codec == null)
	        throw new RuntimeException("Codec not found for codec_id " + codecCtx.codec_id); // Codec not found
	    
	    // Open codec
	    if (AVCODEC.avcodec_open(codecCtx, codec) < 0)
	    	 throw new RuntimeException("Could not open codec"); // Could not open codec
	    
	    // Allocate video frame
	    final AVFrame frame = AVCODEC.avcodec_alloc_frame();
	    if (frame == null)
	    	throw new RuntimeException("Could not allocate frame");
	     
	    // Allocate an AVFrame structure
	    final AVFrame frameRGB = AVCODEC.avcodec_alloc_frame();
	    if (frameRGB == null)
	    	throw new RuntimeException("Could not allocate frame");
	    
	    // Determine required buffer size and allocate buffer
	    final int numBytes = AVCODEC.avpicture_get_size(AVCodecLibrary.PIX_FMT_RGB32, codecCtx.width, codecCtx.height);
	    final Pointer buffer = AVUTIL.av_malloc(numBytes);
	    
	    // Assign appropriate parts of buffer to image planes in pFrameRGB
	    AVCODEC.avpicture_fill(frameRGB, buffer, AVCodecLibrary.PIX_FMT_RGB32, codecCtx.width, codecCtx.height);

	    open_video(codecCtx.width, codecCtx.height);
	    
	    final AVPacket packet = new AVPacket();
	    while (AVFORMAT.av_read_frame(formatCtx, packet) >= 0)
	    {
	    	
	    	// Is this a packet from the video stream?
	        if (packet.stream_index == videoStream)
	        {
	        	final IntByReference frameFinished = new IntByReference();
	            // Decode video frame
	        	AVCODEC.avcodec_decode_video(codecCtx, frame, frameFinished, packet.data, packet.size);

	            // Did we get a video frame?
	            if (frameFinished.getValue() != 0)
	            {
	                // Convert the image from its native format to RGB
	                AVCODEC.img_convert(frameRGB, AVCodecLibrary.PIX_FMT_RGB32, 
	                    frame, codecCtx.pix_fmt, codecCtx.width, 
	                    codecCtx.height);

	                // using MemoryImageSource is faster than creating a BufferedImage
	                final int[] data = frameRGB.data0.getIntArray(0, codecCtx.height * codecCtx.width);//frameRGB.linesize[0]); 
	                final MemoryImageSource mis = new MemoryImageSource (codecCtx.width, codecCtx.height, data, 0, codecCtx.width); 
	                final Image bi = Toolkit.getDefaultToolkit().createImage(mis); 
	                imageFrame.setImage(bi); 
	                
	                //final byte[] data = frameRGB.data0.getByteArray(0, codecCtx.height * frameRGB.linesize[0]);
	                //final BufferedImage bi = FrameDataToImage.createImage(data, codecCtx.width, codecCtx.height);
	        		//imageFrame.setImage(bi);

	            }
	        }

	        // Free the packet that was allocated by av_read_frame
	        // AVFORMAT.av_free_packet(packet.getPointer()) - cannot be called because it is an inlined function.
	        // so we'll just do the JNA equivalent of the inline:
	        if (packet.destruct != null)
	        	packet.destruct.callback(packet);

	    }

	    // Free the RGB image
	    AVUTIL.av_free(frameRGB.getPointer());

	    // Free the YUV frame
	    AVUTIL.av_free(frame.getPointer());

	    // Close the codec
	    AVCODEC.avcodec_close(codecCtx);

	    // Close the video file
	    AVFORMAT.av_close_input_file(formatCtx);
	    
		System.out.println("Done");
	}
	
	static ImageFrame imageFrame;
	
	static void open_video(int width, int height)
	{

		imageFrame = new ImageFrame("FFMPEG Video");

		imageFrame.setImageSize(width, height);
		imageFrame.setLocation(200, 200);
		imageFrame.addWindowListener(new WindowAdapter()
		{
			public void windowClosing(WindowEvent e)
			{
				System.exit(0); // TODO: shutdown properly
			}
		});
		imageFrame.setVisible(true);

	}
}
