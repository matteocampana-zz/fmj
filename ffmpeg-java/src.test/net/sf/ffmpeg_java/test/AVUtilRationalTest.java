package net.sf.ffmpeg_java.test;

import junit.framework.TestCase;
import net.sf.ffmpeg_java.AVUtilLibrary;
import net.sf.ffmpeg_java.AVUtilLibraryWorkarounds;
import net.sf.ffmpeg_java.FFMPEGLibrary.AVRational;

/**
 * Tests AVRational issues.
 * @author Ken Larson
 *
 */
public class AVUtilRationalTest extends TestCase
{

	public void test1()
	{
		AVUtilLibrary AVUTIL = AVUtilLibrary.INSTANCE;
		
		// Test our workaround for JNA's inability to return structures:
		{
			long r = AVUTIL.av_d2q(2.0, 100);
			if (!AVUtilLibraryWorkarounds.isBigEndian())
				assertEquals(r, 0x0000000100000002L);
			else
				assertEquals(r, 0x0000000200000001L);
				
			//System.out.println(Long.toHexString(r));
		}
		
		{
			AVRational r = AVUtilLibraryWorkarounds.av_d2q(2.0, 100); //AVUTIL.av_d2q(2.0, 100);
			assertEquals(r.num, 2);
			assertEquals(r.den, 1);
		}
		
		
		{
			AVRational r1 = new AVRational(3, 1);
			AVRational r2 = new AVRational(r1.toLong());
			assertEquals(r1.num, r2.num);
			assertEquals(r2.den, r2.den);
		}
//		System.out.println(AVUtilLibraryWorkarounds.isBigEndian());
		
	}
}
