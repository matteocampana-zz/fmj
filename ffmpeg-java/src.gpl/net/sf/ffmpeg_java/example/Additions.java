package net.sf.ffmpeg_java.example;

import com.sun.jna.Pointer;
import com.sun.jna.Structure;

/**
 * 
 * @author	Uwe Mannl
 *
 */
public class Additions {
	
    
    public static class SwsContext extends Structure
    {
    	public int srcW;
    	public int srcH;
    	public int srcFormat;
    	public int dstW;
    	public int dstH;
    	public int dstFormat;
    	public int flags;
    	public Pointer srcFilter;
    	public Pointer dstFilter;
    	public Pointer param;
    	
    	public SwsContext()
    	{
    		super();
    	}
    	
    	public SwsContext(Pointer p)
    	{
    		super();
    		useMemory(p);
    		read();
    	}
    	
    }
    

	
}
