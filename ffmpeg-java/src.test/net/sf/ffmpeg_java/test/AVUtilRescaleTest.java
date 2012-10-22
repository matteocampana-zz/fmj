package net.sf.ffmpeg_java.test;

import junit.framework.TestCase;
import net.sf.ffmpeg_java.AVUtilLibrary;
import net.sf.ffmpeg_java.AVUtilLibraryWorkarounds;
import net.sf.ffmpeg_java.FFMPEGLibrary.AVRational;

import com.sun.jna.Pointer;

/**
 * Unit tests for AVUtilLibrary and AVUtilLibraryWorkarounds.
 * @author Ken Larson
 *
 */
public class AVUtilRescaleTest extends TestCase
{

	public void test1()
	{
		final AVRational a = new AVRational();//AVRational(1, 25);
		final AVRational b = new AVRational(); //AVRational(1, 90000);
		a.num = 1;
		a.den = 25;
		b.num = 1;
		b.den = 90000;
		a.write();
		b.write();
		
		assertEquals(AVUtilLibraryWorkarounds.av_rescale_q(0, a, b), 0);
		assertEquals(AVUtilLibraryWorkarounds.av_rescale_q(1, a, b), 3600);
		assertEquals(AVUtilLibraryWorkarounds.av_rescale_q(2, a, b), 7200);
		
	}
	
	public void test_av_rescale_rnd()
	{
		assertEquals(AVUtilLibraryWorkarounds.av_rescale_rnd(0, 90000, 25, 5), 0);
		assertEquals(AVUtilLibraryWorkarounds.av_rescale_rnd(1, 90000, 25, 5), 3600);
		assertEquals(AVUtilLibraryWorkarounds.av_rescale_rnd(2, 90000, 25, 5), 7200);
		
		assertEquals(AVUtilLibrary.INSTANCE.av_rescale_rnd(0, 90000, 25, 5), 0);
		assertEquals(AVUtilLibrary.INSTANCE.av_rescale_rnd(1, 90000, 25, 5), 3600);
		assertEquals(AVUtilLibrary.INSTANCE.av_rescale_rnd(2, 90000, 25, 5), 7200);
	}
	
	public void test_av_rescale()
	{
		assertEquals(AVUtilLibraryWorkarounds.av_rescale(0, 90000, 25), 0);
		assertEquals(AVUtilLibraryWorkarounds.av_rescale(1, 90000, 25), 3600);
		assertEquals(AVUtilLibraryWorkarounds.av_rescale(2, 90000, 25), 7200);
		
		assertEquals(AVUtilLibrary.INSTANCE.av_rescale(0, 90000, 25), 0);
		assertEquals(AVUtilLibrary.INSTANCE.av_rescale(1, 90000, 25), 3600);
		assertEquals(AVUtilLibrary.INSTANCE.av_rescale(2, 90000, 25), 7200);
	}
	
	public static void main(String[] args)
	{
		final AVUtilLibrary AVUTIL = AVUtilLibrary.INSTANCE;
		
		final AVRational a = new AVRational();//AVRational(1, 25);
		final AVRational b = new AVRational(); //AVRational(1, 90000);
		a.num = 1;
		a.den = 25;
		b.num = 1;
		b.den = 90000;
		a.write();
		b.write();
		a.read();
		b.read();
		
		Pointer p = AVUTIL.av_malloc(8*2);//a.getPointer();
		p.setInt(0, 1);
		p.setInt(1, 25);
		p.setInt(2, 25);
		p.setInt(3, 25);
		p.setInt(4, 25);
		
		Pointer p2 = AVUTIL.av_malloc(8*2);//b.getPointer();
		p2.setInt(0, 1);
		p2.setInt(1, 90000);
		p2.setInt(2, 90000);		
		p2.setInt(3, 90000);
		p2.setInt(4, 90000);

		for (long pts = 0; pts < 100; ++pts)
		{	long result = AVUtilLibraryWorkarounds.av_rescale_q(pts, a, b);
			System.out.println("tmp_frame.pts=" + pts + " c.time_base=" + a.num + "/" +a.den + " st.time_base=" + b.num + "/" +b.den + " pkt.pts=" + result);

		}
	}
}
