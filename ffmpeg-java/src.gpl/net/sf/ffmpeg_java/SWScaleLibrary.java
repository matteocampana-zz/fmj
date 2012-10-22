package net.sf.ffmpeg_java;
import com.sun.jna.Native;
import com.sun.jna.Pointer;
import com.sun.jna.Structure;

/**
 * NOTICE: THIS CLASS IS GPL-LICENSED, UNLIKE THE REST OF FFMPEG-JAVA.
 * 
 * Based on FFMPEG Aug 18 2007.  
 * 
 * @author Stephan Goetter
 *
 */
public interface SWScaleLibrary extends FFMPEGLibrary 
{
    public static final SWScaleLibrary INSTANCE = (SWScaleLibrary) Native.loadLibrary(
    		System.getProperty("os.name").startsWith("Windows") ? "swscale-0" : "swscale", 
    		SWScaleLibrary.class);

    /* values for the flags, the stuff on the command line is different */
    int SWS_FAST_BILINEAR     = 1;
    int SWS_BILINEAR          = 2;
    int SWS_BICUBIC           = 4;
    int SWS_X                 = 8;
    int SWS_POINT          = 0x10;
    int SWS_AREA           = 0x20;
    int SWS_BICUBLIN       = 0x40;
    int SWS_GAUSS          = 0x80;
    int SWS_SINC          = 0x100;
    int SWS_LANCZOS       = 0x200;
    int SWS_SPLINE        = 0x400;

    int SWS_SRC_V_CHR_DROP_MASK     = 0x30000;
    int SWS_SRC_V_CHR_DROP_SHIFT    = 16;

    int SWS_PARAM_DEFAULT           = 123456;

    int SWS_PRINT_INFO              = 0x1000;

//    the following 3 flags are not completely implemented
//    internal chrominace subsampling info
    int SWS_FULL_CHR_H_INT    = 0x2000;
//    input subsampling info
    int SWS_FULL_CHR_H_INP    = 0x4000;
    int SWS_DIRECT_BGR        = 0x8000;
    int SWS_ACCURATE_RND      = 0x40000;

    int SWS_CPU_CAPS_MMX      = 0x80000000;
    int SWS_CPU_CAPS_MMX2     = 0x20000000;
    int SWS_CPU_CAPS_3DNOW    = 0x40000000;
    int SWS_CPU_CAPS_ALTIVEC  = 0x10000000;
    int SWS_CPU_CAPS_BFIN     = 0x01000000;

/*    float SWS_MAX_REDUCE_CUTOFF = 0.002f;

    int SWS_CS_ITU709         = 1;
    int SWS_CS_FCC            = 4;
    int SWS_CS_ITU601         = 5;
    int SWS_CS_ITU624         = 5;
    int SWS_CS_SMPTE170M      = 5;
    int SWS_CS_SMPTE240M      = 7;
    int SWS_CS_DEFAULT        = 5;
*/


//     when used for filters they must have an odd number of elements
//     coeffs cannot be shared between vectors
/*    typedef struct {
        double *coeff;
        int length;
    } SwsVector;*/

	public static class SwsVector extends Structure
	{
		public Pointer coeff;
	    public int length;
	};
	
//     vectors can be shared
/*    typedef struct {
        SwsVector *lumH;
        SwsVector *lumV;
        SwsVector *chrH;
        SwsVector *chrV;
    } SwsFilter;*/

    public static class SwsFilter extends Structure
	{
		public Pointer lumH;
		public Pointer lumV;
		public Pointer chrH;
		public Pointer chrV;
	};
	

    //struct SwsContext;

    public static class SwsContext extends Structure {
    	
    }

    //void sws_freeContext(struct SwsContext *swsContext);

    void sws_freeContext(Pointer swsContext);
    
    /*struct SwsContext *sws_getContext(int srcW, int srcH, int srcFormat, int dstW, int dstH, int dstFormat, int flags,
                                      SwsFilter *srcFilter, SwsFilter *dstFilter, double *param);*/
    
    Pointer sws_getContext(int srcW, int srcH, int srcFormat, int dstW, int dstH, int dstFormat, int flags,
            Pointer srcFilter, Pointer dstFilter, Pointer param);

    
    /*int sws_scale(struct SwsContext *context, uint8_t* src[], int srcStride[], int srcSliceY,
                  int srcSliceH, uint8_t* dst[], int dstStride[]);*/
    int sws_scale(Pointer context, Pointer src[], int srcStride[], int srcSliceY,
            int srcSliceH, Pointer dst[], int dstStride[]);
    // TODO: Pointer[] aren't supported by JNA version in CVS. we use Pointer as workaround!
    int sws_scale(Pointer context, Pointer src, int srcStride[], int srcSliceY,
            int srcSliceH, Pointer dst, int dstStride[]);
    
    /*int sws_scale_ordered(struct SwsContext *context, uint8_t* src[], int srcStride[], int srcSliceY,
            int srcSliceH, uint8_t* dst[], int dstStride[]) attribute_deprecated;*/
    /**
     * @deprecated
     */
    int sws_scale_ordered(Pointer context, Pointer src, Pointer srcStride, int srcSliceY,
            int srcSliceH, Pointer dst, Pointer dstStride);


    //int sws_setColorspaceDetails(struct SwsContext *c, const int inv_table[4], int srcRange, const int table[4], int dstRange, int brightness, int contrast, int saturation);
    int sws_setColorspaceDetails(Pointer c, Pointer inv_table, int srcRange, Pointer table, int dstRange, int brightness, int contrast, int saturation);
    //int sws_getColorspaceDetails(struct SwsContext *c, int **inv_table, int *srcRange, int **table, int *dstRange, int *brightness, int *contrast, int *saturation);
    int sws_getColorspaceDetails(Pointer c, Pointer inv_table, Pointer srcRange, Pointer table, Pointer dstRange, Pointer brightness, Pointer contrast, Pointer saturation);
    //SwsVector *sws_getGaussianVec(double variance, double quality);
    Pointer sws_getGaussianVec(double variance, double quality);
    //SwsVector *sws_getConstVec(double c, int length);
    Pointer sws_getConstVec(double c, int length);
    //SwsVector *sws_getIdentityVec(void);
    Pointer sws_getIdentityVec();
    //void sws_scaleVec(SwsVector *a, double scalar);
    void sws_scaleVec(Pointer a, double scalar);
    //void sws_normalizeVec(SwsVector *a, double height);
    void sws_normalizeVec(Pointer a, double height);
    //void sws_convVec(SwsVector *a, SwsVector *b);
    void sws_convVec(Pointer a, Pointer b);
    //void sws_addVec(SwsVector *a, SwsVector *b);
    void sws_addVec(Pointer a, Pointer b);
    //void sws_subVec(SwsVector *a, SwsVector *b);
    void sws_subVec(Pointer a, Pointer b);
    //void sws_shiftVec(SwsVector *a, int shift);
    void sws_shiftVec(Pointer a, int shift);
    //SwsVector *sws_cloneVec(SwsVector *a);
    Pointer sws_cloneVec(Pointer a);

    //void sws_printVec(SwsVector *a);
    void sws_printVec(Pointer a);
    //void sws_freeVec(SwsVector *a);
    void sws_freeVec(Pointer a);

    /*SwsFilter *sws_getDefaultFilter(float lumaGBlur, float chromaGBlur,
            float lumaSarpen, float chromaSharpen,
            float chromaHShift, float chromaVShift,
            int verbose);*/
    Pointer sws_getDefaultFilter(float lumaGBlur, float chromaGBlur,
            float lumaSarpen, float chromaSharpen,
            float chromaHShift, float chromaVShift,
            int verbose);
    //void sws_freeFilter(SwsFilter *filter);
    void sws_freeFilter(Pointer filter);

    /*struct SwsContext *sws_getCachedContext(struct SwsContext *context,
            int srcW, int srcH, int srcFormat,
            int dstW, int dstH, int dstFormat, int flags,
            SwsFilter *srcFilter, SwsFilter *dstFilter, double *param);*/
    Pointer sws_getCachedContext(Pointer context,
            int srcW, int srcH, int srcFormat,
            int dstW, int dstH, int dstFormat, int flags,
            Pointer srcFilter, Pointer dstFilter, Pointer param);

    
}
