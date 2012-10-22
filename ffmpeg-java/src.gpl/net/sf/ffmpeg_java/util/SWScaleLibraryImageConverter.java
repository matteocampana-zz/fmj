package net.sf.ffmpeg_java.util;

import java.util.logging.Logger;

import net.sf.ffmpeg_java.AVUtilLibrary;
import net.sf.ffmpeg_java.SWScaleLibrary;
import net.sf.ffmpeg_java.AVCodecLibrary.AVFrame;

import com.sun.jna.Pointer;

/**
 * NOTICE: THIS CLASS IS GPL-LICENSED, UNLIKE THE REST OF FFMPEG-JAVA.
 * 
 * Implementation of ImageConverter which uses SWScale.
 * @author Stephan Goetter
 * @author Ken Larson
 *
 */
public class SWScaleLibraryImageConverter implements ImageConverter
{

	private static final Logger logger = LoggerSingleton.logger;
	
	private final AVUtilLibrary AVUTIL;
	private final SWScaleLibrary SWSCALE;
    private Pointer swsContext = null;

	public SWScaleLibraryImageConverter()
	{
		super();
		AVUTIL = AVUtilLibrary.INSTANCE;
		SWSCALE = SWScaleLibrary.INSTANCE;
	}

	public int img_convert(AVFrame dstFrame, int dstPixFmt, AVFrame srcFrame, int pix_fmt, int width, int height)
	{
		// swscale was found. use it!
        Pointer srcFilter = null;
        Pointer dstFilter = null;
        Pointer param = null;
        
        int flags = SWScaleLibrary.SWS_BICUBIC;
        String sunCpuIsalist = System.getProperty("sun.cpu.isalist");
        if (sunCpuIsalist != null && sunCpuIsalist.indexOf("mmx") > 0) {
        	//flags |= SWScaleLibrary.SWS_CPU_CAPS_MMX;
        }
        swsContext = SWSCALE.sws_getCachedContext(swsContext, width, height, pix_fmt, width,
        		height, dstPixFmt, flags, srcFilter, dstFilter, param);
        if (swsContext == null) {
        	throw new RuntimeException("sws_getContext failed");
        }
        
        Pointer pSrc = srcFrame.getPointer(); // data is first component in AVFrame data structure, so ptr is the same
        Pointer pDest = dstFrame.getPointer(); // data is first component in AVFrame data structure, so ptr is the same
        final int ret = SWSCALE.sws_scale(swsContext, pSrc, srcFrame.linesize, 0, height, pDest, dstFrame.linesize);
        AVUTIL.av_free(pDest);
        AVUTIL.av_free(pSrc);
        /* TODO: update JNA with Pointer[] parameter support and uncomment this code */
        /*
        Pointer[] src = new Pointer[4];
        src[0] = srcFrame.data0;
        src[1] = srcFrame.data1;
        src[2] = srcFrame.data2;
        src[3] = srcFrame.data3;
        Pointer[] dest = new Pointer[4];
        dest[0] = dstFrame.data0;
        dest[1] = dstFrame.data1;
        dest[2] = dstFrame.data2;
        dest[3] = dstFrame.data3;
        final int ret = SWSCALE.sws_scale(swsContext, src, srcFrame.linesize, 0, height, dest, dstFrame.linesize);
        */
        if (ret < 0) {
        	logger.warning("SWSCALE.sws_scale failed: " + ret);
        }
        // ffplay is not freeing the cached context. do we need to?
        // This class is hold in Singleton, so we don't free either
        //SWSCALE.sws_freeContext( swsContext );
        
        return ret;
	}


}
