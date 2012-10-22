package net.sf.theora_java.jheora.utils;

import java.awt.image.BufferedImage;
import java.awt.image.ColorModel;
import java.awt.image.ImageConsumer;
import java.util.Hashtable;

import com.fluendo.jheora.Info;
import com.fluendo.jheora.YUVBuffer;

/**
 * Converts a yuv_buffer to a BufferedImage (RGB).
 * @author Ken Larson
 *
 */
public class YUVConverter
{

	public static BufferedImage toBufferedImage(YUVBuffer yuv, Info ti)
	{
		MyImageConsumer ic = new MyImageConsumer();
		yuv.startProduction(ic);
	
		return ic.getBufferedImage();
	}
	
	/**
	 * Coded using internal knowledge of YUVBuffer.
	 *
	 */
	private static class MyImageConsumer implements ImageConsumer
	{

		private BufferedImage bi;
		
		public void imageComplete(int status)
		{
		}

		public void setColorModel(ColorModel model)
		{
		}

		public void setDimensions(int width, int height)
		{
		}

		public void setHints(int hintflags)
		{
		}

		public void setPixels(int x, int y, int w, int h, ColorModel model, byte[] pixels, int off, int scansize)
		{
		}

		public void setPixels(int x, int y, int w, int h, ColorModel model, int[] pixels, int off, int scansize)
		{
			// we are relying on the assumption that the YUVBuffer is using ColorModel.getRGBdefault;
			if (model != ColorModel.getRGBdefault())
				throw new RuntimeException();
			bi = new BufferedImage(w, h, BufferedImage.TYPE_INT_ARGB);	// the constructor for BufferedImage uses ColorModel.getRGBdefault for this format
			bi.setRGB(x, y, w, h, pixels, off, scansize);
			

		}

		public void setProperties(Hashtable<?, ?> props)
		{
		}
		
		public BufferedImage getBufferedImage()
		{	return bi;
		}
		
	}

}
