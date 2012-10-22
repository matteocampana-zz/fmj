package net.sf.ffmpeg_java;
import com.sun.jna.Native;
import com.sun.jna.Pointer;

/**
 * Based on FFMPEG revision 12162, Feb 20 2008.
 * From mem.h
 * @author Ken Larson
 *
 */
public interface AVUtilLibrary extends FFMPEGLibrary 
{
    public static final AVUtilLibrary INSTANCE = (AVUtilLibrary) Native.loadLibrary(
    		System.getProperty("os.name").startsWith("Windows") ? "avutil-49" : "avutil", 
    		AVUtilLibrary.class);

// avutil.h
    
    // #define LIBAVUTIL_VERSION_TRIPLET 49,6,0
    public static final int LIBAVUTIL_VERSION_INT = ((49<<16)+(6<<8)+0);
    public static final String LIBAVUTIL_VERSION     = "49.6.0";
    public static final int LIBAVUTIL_BUILD       = LIBAVUTIL_VERSION_INT;

    public static final String LIBAVUTIL_IDENT       = "Lavu" + LIBAVUTIL_VERSION;
//------------------------------------------------------------------------------------------------------------------------
// mem.h
    
//    void *av_malloc(unsigned int size);
//    void *av_realloc(void *ptr, unsigned int size);
//    void av_free(void *ptr);
//    void *av_mallocz(unsigned int size);
//    char *av_strdup(const char *s);
//    void av_freep(void *ptr);
    public Pointer av_malloc(int size);
    public Pointer av_realloc(Pointer ptr, int size);
    public void av_free(Pointer ptr);
    public Pointer av_mallocz(int size);
    public Pointer av_strdup(Pointer s);
    public void av_freep(Pointer ptr);
    
// end mem.h
//------------------------------------------------------------------------------------------------------------------------
	
    
//------------------------------------------------------------------------------------------------------------------------
// mathematics.h
    
    public final static int AV_ROUND_ZERO		= 0; ///< round toward zero
	public final static int AV_ROUND_INF		= 1; ///< round away from zero
	public final static int AV_ROUND_DOWN		= 2; ///< round toward -infinity
	public final static int AV_ROUND_UP		= 3; ///< round toward +infinity
	public final static int AV_ROUND_NEAR_INF	= 5; ///< round to nearest and halfway cases away from zero


    /**
     * rescale a 64bit integer with rounding to nearest.
     * a simple a*b/c isn't possible as it can overflow
     */
    public long av_rescale(long a, long b, long c);

    /**
     * rescale a 64bit integer with specified rounding.
     * a simple a*b/c isn't possible as it can overflow
     */
    public long av_rescale_rnd(long a, long b, long c, int rounding);
    
 // TODO: not working right:
//
//    /**
//     * rescale a 64bit integer by 2 rational numbers.
//     */
//    public long av_rescale_q(long a, AVRational bq, AVRational cq);


// end mathematics.h    
//------------------------------------------------------------------------------------------------------------------------
    
// rational.h
	
//	/**
//	 * Compare two rationals.
//	 * @param a first rational
//	 * @param b second rational
//	 * @return 0 if a==b, 1 if a>b and -1 if a<b.
//	 */
//	static inline int av_cmp_q(AVRational a, AVRational b){
//	    const int64_t tmp= a.num * (int64_t)b.den - b.num * (int64_t)a.den;
//
//	    if(tmp) return (tmp>>63)|1;
//	    else    return 0;
//	}
//
//	/**
//	 * Rational to double conversion.
//	 * @param a rational to convert
//	 * @return (double) a
//	 */
//	static inline double av_q2d(AVRational a){
//	    return a.num / (double) a.den;
//	}

	/**
	 * Reduce a fraction.
	 * This is useful for framerate calculations.
	 * @param dst_nom destination numerator
	 * @param dst_den destination denominator
	 * @param nom source numerator
	 * @param den source denominator
	 * @param max the maximum allowed for dst_nom & dst_den
	 * @return 1 if exact, 0 otherwise
	 */
	public int av_reduce(Pointer /*int **/dst_nom, Pointer /*int **/dst_den, long nom, long den, long max);

	// TODO:
//	/**
//	 * Multiplies two rationals.
//	 * @param b first rational.
//	 * @param c second rational.
//	 * @return b*c.
//	 */
//	AVRational av_mul_q(AVRational b, AVRational c);
//
//	/**
//	 * Divides one rational by another.
//	 * @param b first rational.
//	 * @param c second rational.
//	 * @return b/c.
//	 */
//	AVRational av_div_q(AVRational b, AVRational c);
//
//	/**
//	 * Adds two rationals.
//	 * @param b first rational.
//	 * @param c second rational.
//	 * @return b+c.
//	 */
//	AVRational av_add_q(AVRational b, AVRational c);
//
//	/**
//	 * Subtracts one rational from another.
//	 * @param b first rational.
//	 * @param c second rational.
//	 * @return b-c.
//	 */
//	AVRational av_sub_q(AVRational b, AVRational c);

	/**
	 * Converts a double precision floating point number to a rational.
	 * @param d double to convert
	 * @param max the maximum allowed numerator and denominator
	 * @return (AVRational) d.
	 */
	//AVRational av_d2q(double d, int max);
	long av_d2q(double d, int max);
	
// end rational.h
    
}
