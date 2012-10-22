package net.sf.theora_java.jheora.utils;



import com.fluendo.jheora.Comment;
import com.fluendo.jheora.Info;
import com.jcraft.jogg.Packet;

/**
 * Used for dumping out various theora structures to standard output.
 * @author Ken Larson
 *
 */
public class Dumper
{

	public static void dump(Info ti)
	{
		System.out.println("theora_info:");
		System.out.println(" width=" + ti.width);		/**< encoded frame width  */
		System.out.println(" height=" + ti.height);		/**< encoded frame height */
		System.out.println(" frame_width=" + ti.frame_width);	/**< display frame width  */
		System.out.println(" frame_height=" + ti.frame_height);	/**< display frame height */
		System.out.println(" offset_x=" + ti.offset_x);	/**< horizontal offset of the displayed frame */
		System.out.println(" offset_y=" + ti.offset_y);	/**< vertical offset of the displayed frame */
		System.out.println(" fps_numerator=" + ti.fps_numerator);	    /**< frame rate numerator **/
		System.out.println(" fps_denominator=" + ti.fps_denominator);    /**< frame rate denominator **/
		System.out.println(" aspect_numerator=" + ti.aspect_numerator);   /**< pixel aspect ratio numerator */
		System.out.println(" aspect_denominator=" + ti.aspect_denominator); /**< pixel aspect ratio denominator */
		System.out.println(" colorspace=" + ti.colorspace);	    /**< colorspace */
		System.out.println(" target_bitrate=" + ti.target_bitrate);	    /**< nominal bitrate in bits per second */
		System.out.println(" quality=" + ti.quality);  /**< Nominal quality setting, 0-63 */
		System.out.println(" quick_p=" + ti.quick_p);  /**< Quick encode/decode */
		System.out.println(" version_major=" + ti.version_major);
		System.out.println(" version_minor=" + ti.version_minor);
		System.out.println(" version_subminor=" + ti.version_subminor);

		// TODO: codec_setup;

		// TODO: why doesn't jheora have these:
//		System.out.println(" dropframes_p=" + ti.dropframes_p);
//		System.out.println(" keyframe_auto_p=" + ti.keyframe_auto_p);
//		System.out.println(" keyframe_frequency=" + ti.keyframe_frequency);
//		System.out.println(" keyframe_frequency_force=" + ti.keyframe_frequency_force); 
//		System.out.println(" keyframe_data_target_bitrate=" + ti.keyframe_data_target_bitrate);
//		System.out.println(" keyframe_auto_threshold=" + ti.keyframe_auto_threshold);
//		System.out.println(" keyframe_mindistance=" + ti.keyframe_mindistance);
//		System.out.println(" noise_sensitivity=" + ti.noise_sensitivity);
//		System.out.println(" sharpness=" + ti.sharpness);
//		System.out.println(" pixelformat=" + ti.pixelformat);

	}
	
	public static void dump(Comment tc)
	{
		System.out.println("theora_comment:");
		System.out.println(" comments=" + (tc.user_comments == null ? 0 : tc.user_comments.length));
		for (int i = 0; tc.user_comments != null && i < tc.user_comments.length; ++i)
		{	System.out.println(" comment_lengths[" + i + "]=" + (tc.user_comments[i] == null ? 0 : tc.user_comments[i].length()));
			System.out.println(" user_comments[" + i + "]=" + tc.user_comments[i]);
		}
		System.out.println(" vendor=" + (tc.vendor == null ? "null" : new String(tc.vendor)));
		  
	}
	
	private static String zeroPad(String s, int len)
	{	while (s.length() < len)
			s = '0' + s;
		return s;
	}
	
	private static String toString(byte b)
	{	return zeroPad(Integer.toHexString(b & 0xff), 2);
	}
	
	public static void dump(Packet op)
	{
		final byte[] data = op.packet_base;
		final int bytes = op.bytes;
		final int offset = op.packet;
		System.out.println("ogg_packet: ");
		System.out.println(" bytes=" + bytes);
		//System.out.println(" offset=" + offset);
		for (int i = 0; i < op.bytes; ++i)	// TODO: is bytes the total len, or len after offset?
		{	System.out.println(" packet[" + (i) + "]=" + toString(data[offset + i]));
		}
	}
}
