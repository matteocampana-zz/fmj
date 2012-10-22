package net.sf.theora_java.jheora.example;

import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.awt.image.BufferedImage;
import java.io.FileInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.PrintStream;
import java.net.URL;

import javax.sound.sampled.AudioFormat;
import javax.sound.sampled.AudioSystem;
import javax.sound.sampled.LineUnavailableException;
import javax.sound.sampled.SourceDataLine;
import javax.sound.sampled.AudioFormat.Encoding;

import net.sf.theora_java.gui.ImageFrame;
import net.sf.theora_java.jheora.utils.Dumper;
import net.sf.theora_java.jheora.utils.YUVConverter;

import com.fluendo.jheora.Colorspace;
import com.fluendo.jheora.YUVBuffer;
import com.jcraft.jogg.Packet;
import com.jcraft.jogg.Page;
import com.jcraft.jogg.StreamState;
import com.jcraft.jogg.SyncState;

/**
 * A simple Java video/audio player for ogg (theora, vorbis).
 * Adapted from player_example.c.
 * The original example used SDL for the actual rendering of audio and video, here we use a simple Swing control and JavaSound.
 * TODO: synchronize audio and video properly.
 * TODO: when playing audio only, need to drain line so that we hear the whole thing.
 * @author Ken Larson
 *
 */
public class PlayerExample
{


	/* far more complex than most Ogg 'example' programs.  The complexity
	   of maintaining A/V sync is pretty much unavoidable.  It's necessary
	   to actually have audio/video playback to make the hard audio clock
	   sync actually work.  If there's audio playback, there might as well
	   be simple video playback as well...

	   A simple 'demux and write back streams' would have been easier,
	   it's true. */



	/*
	 * Helper; just grab some more compressed bitstream and sync it for page
	 * extraction
	 */
	int buffer_data(InputStream in, SyncState oy) throws IOException
	{
		int fill = oy.buffer(4096);
		byte[] buffer2 = oy.data;
		int bytes = in.read(buffer2, fill, 4096);
		if (bytes < 0)
			return bytes; // EOF
		oy.wrote(bytes);
		return (bytes);
	}

	/* Ogg and codec state for demux/decode */
	final SyncState   oy = new SyncState();
	final Page         og = new Page();
	StreamState vo = new StreamState();
	StreamState to = new StreamState();
	final com.fluendo.jheora.Info      ti = new com.fluendo.jheora.Info();
	final com.fluendo.jheora.Comment   tc = new com.fluendo.jheora.Comment();
	final com.fluendo.jheora.State     td = new com.fluendo.jheora.State();
	final com.jcraft.jorbis.Info      vi = new com.jcraft.jorbis.Info();
	final com.jcraft.jorbis.DspState vd = new com.jcraft.jorbis.DspState();
	final com.jcraft.jorbis.Block     vb = new com.jcraft.jorbis.Block(vd);
	com.jcraft.jorbis.Comment   vc = new com.jcraft.jorbis.Comment();

	int              theora_p=0;
	int              vorbis_p=0;
	int              stateflag=0;

	ImageFrame imageFrame;

	/* single frame video buffering */
	int          videobuf_ready=0;
	long /*ogg_int64_t*/  videobuf_granulepos=-1;
	double       videobuf_time=0;

	/* single audio fragment audio buffering */
	int          audiobuf_fill=0;
	int          audiobuf_ready=0;
	short []audiobuf;
	long /*ogg_int64_t*/  audiobuf_granulepos=0; /* time position of last sample */

//	/* audio / video synchronization tracking:
//
//	Since this will make it to Google at some point and lots of people
//	search for how to do this, a quick rundown of a practical A/V sync
//	strategy under Linux [the UNIX where Everything Is Hard].  Naturally,
//	this works on other platforms using OSS for sound as well.
//
//	In OSS, we don't have reliable access to any precise information on
//	the exact current playback position (that, of course would have been
//	too easy; the kernel folks like to keep us app people working hard
//	doing simple things that should have been solved once and abstracted
//	long ago).  Hopefully ALSA solves this a little better; we'll probably
//	use that once ALSA is the standard in the stable kernel.
//
//	We can't use the system clock for a/v sync because audio is hard
//	synced to its own clock, and both the system and audio clocks suffer
//	from wobble, drift, and a lack of accuracy that can be guaranteed to
//	add a reliable percent or so of error.  After ten seconds, that's
//	100ms.  We can't drift by half a second every minute.
//
//	Although OSS can't generally tell us where the audio playback pointer
//	is, we do know that if we work in complete audio fragments and keep
//	the kernel buffer full, a blocking select on the audio buffer will
//	give us a writable fragment immediately after playback finishes with
//	it.  We assume at that point that we know the exact number of bytes in
//	the kernel buffer that have not been played (total fragments minus
//	one) and calculate clock drift between audio and system then (and only
//	then).  Damp the sync correction fraction, apply, and walla: A
//	reliable A/V clock that even works if it's interrupted. */
//
//	long         audiofd_totalsize=-1;
	/** In bytes. */
	int          audiofd_fragsize;      /* read and write only complete fragments
	                                       so that SNDCTL_DSP_GETOSPACE is
	                                       accurate immediately after a bank
	                                       switch */
//	int          audiofd=-1;
//	long /*ogg_int64_t*/  audiofd_timer_calibrate=-1;
//
	
	private SourceDataLine sourceLine;
	
	void open_audio()
	{

		audiofd_fragsize = 10000; // TODO: this is just a hack
		audiobuf = new short[audiofd_fragsize / 2]; // in bytes, so divide by 2
													// to get shorts

		final Encoding encoding = AudioFormat.Encoding.PCM_SIGNED;
		final float sampleRate = vi.rate;
		final int sampleSizeInBits = 16;
		final int channels = vi.channels;
		final int frameSize = 2 * channels;
		final float frameRate = sampleRate * channels;
		final boolean bigEndian = false;

		try
		{
			final AudioFormat audioFormat = new AudioFormat(encoding, sampleRate, sampleSizeInBits, channels, frameSize, frameRate, bigEndian);
			System.out.println("JavaSound output format: " + audioFormat);
			sourceLine = AudioSystem.getSourceDataLine(audioFormat);
			sourceLine.open(audioFormat);
			// System.out.println("sourceLine.getBufferSize()=" +
			// sourceLine.getBufferSize()); // TODO: should we use this size for
			// audiofd_fragsize?
			sourceLine.start();
			// TODO: clean up when done: stop, drain, etc.
		} catch (LineUnavailableException e)
		{
			throw new RuntimeException(e);
		}

	}
//
	void audio_close()
	{
		if (sourceLine != null)
		{

			sourceLine.stop();
			sourceLine.close();

		}
	}
//
// /* call this only immediately after unblocking from a full kernel
//	   having a newly empty fragment or at the point of DMA restart */
//	void audio_calibrate_timer(int restart){
//	  struct timeval tv;
//	  long /*ogg_int64_t*/ current_sample;
//	  long /*ogg_int64_t*/ new_time;
//
//	  gettimeofday(&tv,0);
//	  new_time=tv.tv_sec*1000+tv.tv_usec/1000;
//
//	  if(restart){
//	    current_sample=audiobuf_granulepos-audiobuf_fill/2/vi.channels;
//	  }else
//	    current_sample=audiobuf_granulepos-
//	      (audiobuf_fill+audiofd_totalsize-audiofd_fragsize)/2/vi.channels;
//
//	  new_time-=1000*current_sample/vi.rate;
//
//	  audiofd_timer_calibrate=new_time;
//	}
//
//	/* get relative time since beginning playback, compensating for A/V
//	   drift */
//	double get_time(){
//	  static long /*ogg_int64_t*/ last=0;
//	  static long /*ogg_int64_t*/ up=0;
//	  long /*ogg_int64_t*/ now;
//	  struct timeval tv;
//
//	  gettimeofday(&tv,0);
//	  now=tv.tv_sec*1000+tv.tv_usec/1000;
//
//	  if(audiofd_timer_calibrate==-1)audiofd_timer_calibrate=last=now;
//
//	  if(audiofd<0){
//	    /* no audio timer to worry about, we can just use the system clock */
//	    /* only one complication: If the process is suspended, we should
//	       reset timing to account for the gap in play time.  Do it the
//	       easy/hack way */
//	    if(now-last>1000)audiofd_timer_calibrate+=(now-last);
//	    last=now;
//	  }
//
//	  if(now-up>200){
//	    double timebase=(now-audiofd_timer_calibrate)*.001;
//	    int hundredths=timebase*100-(long)timebase*100;
//	    int seconds=(long)timebase%60;
//	    int minutes=((long)timebase/60)%60;
//	    int hours=(long)timebase/3600;
//
//	    System.err.print("   Playing: %d:%02d:%02d.%02d                       \r",
//	            hours,minutes,seconds,hundredths);
//	    up=now;
//	  }
//
//	  return (now-audiofd_timer_calibrate)*.001;
//
//	}
//
	

	
	/**
	 * write a fragment to the OSS kernel audio API, but only if we can stuff in
	 * a whole fragment without blocking
	 */
	void audio_write_nonblocking()
	{

		if (audiobuf_ready != 0)
		{

			// convert from short array to byte array. TODO: inefficient, should
			// just store in byte array to begin with.
			final byte[] data = new byte[audiobuf.length * 2];
			for (int i = 0; i < audiobuf.length; ++i)
			{
				// little-endian:
				data[i * 2] = (byte) (audiobuf[i] & 0xff);
				data[i * 2 + 1] = (byte) ((audiobuf[i] >> 8) & 0xff);

			}

			int length = data.length;
			int offset = 0;

			// make sure all the bytes are written.
			while (length > 0)
			{

				// logger.fine("Available: " + sourceLine.available());
				// logger.fine("length: " + length);
				// logger.fine("sourceLine.getBufferSize(): " +
				// sourceLine.getBufferSize());

				int n = sourceLine.write(data, offset, length); // TODO: this can block for  a very long time if it doesn't
				if (n >= length)
					break;
				else if (n == 0)
				{

					System.err.println("sourceLine.write returned 0, offset=" + offset + "; length=" + length + "; available=" + sourceLine.available() + "; frame size in bytes" + sourceLine.getFormat().getFrameSize() + "; sourceLine.isActive() = " + sourceLine.isActive() + "; " + sourceLine.isOpen() + "; sourceLine.isRunning()=" + sourceLine.isRunning());
					throw new RuntimeException("audio write failed");
					// sourceLine.write docs indicate that this will only happen if there is an error.

				} else
				{
					offset += n;
					length -= n;
				}

			}

			audiobuf_fill = 0;
			audiobuf_ready = 0;

			// }
		}
	}

	void open_video()
	{

		imageFrame = new ImageFrame("Theora Video");

		imageFrame.setImageSize(ti.frame_width, ti.frame_height);
		// TODO: imageFrame needs to size correctly, for now, hack it.
		imageFrame.setLocation(200, 200);
		imageFrame.addWindowListener(new WindowAdapter()
		{
			@Override
			public void windowClosing(WindowEvent e)
			{
				System.exit(0); // TODO: shutdown properly
			}
		});
		imageFrame.setVisible(true);

	}

	void video_write()
	{
		final YUVBuffer yuv = new YUVBuffer();

		td.decodeYUVout(yuv);

		final BufferedImage bi = YUVConverter.toBufferedImage(yuv, ti);

		imageFrame.setImage(bi);

	}

	/** dump the theora (or vorbis) comment header */
	int dump_comments(com.fluendo.jheora.Comment tc)
	{
		int i;
		final PrintStream out = System.out;

		out.printf("Encoded by %s\n", tc.vendor);
		if (tc.user_comments != null && tc.user_comments.length > 0)
		{
			out.print("theora comment header:\n");
			for (i = 0; i < tc.user_comments.length; i++)
			{
				if (tc.user_comments[i] != null)
				{
					final String value = tc.user_comments[i];
					out.printf("\t%s\n", value);
				}
			}
		}
		return (0);
	}

	/**
	 * Report the encoder-specified colorspace for the video, if any. We don't
	 * actually make use of the information in this example; a real player
	 * should attempt to perform color correction for whatever display device it
	 * supports.
	 */
	void report_colorspace(com.fluendo.jheora.Info ti)
	{
	    if (ti.colorspace == Colorspace.UNSPECIFIED)
	    {
	        /* nothing to report */
	    }
	    else if (ti.colorspace == Colorspace.ITU_REC_470M)
	    {
	        System.out.print("  encoder specified ITU Rec 470M (NTSC) color.\n");
	    }
	    else if (ti.colorspace == Colorspace.ITU_REC_470BG)
	    {
	        System.out.print("  encoder specified ITU Rec 470BG (PAL) color.\n");
		}
	    else
	    {
	        System.out.printf("warning: encoder specified unknown colorspace (%d).\n", ti.colorspace);
	    }
	}

	/** helper: push a page into the appropriate steam 
	 * this can be done blindly; a stream won't accept a page that doesn't
	 * belong to it
	 */
	int queue_page(Page page)
	{
		if (theora_p != 0)
			to.pagein(og);
		if (vorbis_p != 0)
			vo.pagein(og);
		return 0;
	}

	static void usage()
	{
		System.err.print("Usage: " + PlayerExample.class.getName() + " <file.ogg>\n");
	}
	
	static final boolean ENABLE_AUDIO = true;	
	static final boolean ENABLE_VIDEO = true;
	static final boolean DUMP = false;	// used for testing only.
	static final boolean USE_URL = true;	// input is a URL, not a file name.  Note: no buffering is done, so playback over the net can be choppy.

	public static void main(String[] args) throws IOException
	{
		new PlayerExample().run(args);
	}
	
	public void run(String[] args) throws IOException
	{

		int i, j;
		final Packet op = new Packet();

		final InputStream infile;
		/* open the input file if any */
		if (args.length >= 1)
		{

			if (USE_URL)
			{
				final URL url = new URL(args[0]);
				infile = url.openStream();
				
			}
			else
			{
				infile = new FileInputStream(args[0]);
			}

		} else
		{
			usage();
			return;
		}

		System.out.println("Opened: " + args[0]);

		//System.out.println("Initializing...");

		/* start up Ogg stream synchronization layer */
		oy.init();

		/* init supporting Vorbis structures needed in header parsing */
		vi.init();
		vc.init();

		/* init supporting Theora structures needed in header parsing */
		//tc.init();
		//ti.init();

		//System.out.println("Parsing headers...");
		/* Ogg file open; parse the headers */
		/* Only interested in Vorbis/Theora streams */
		while (stateflag == 0)
		{
			int ret = buffer_data(infile, oy);
			if (ret <= 0)
				break;
			while (oy.pageout(og) > 0)
			{
				StreamState test = new StreamState();

				/* is this a mandated initial header? If not, stop parsing */
				if (og.bos() == 0)
				{
					/* don't leak the page; get it into the appropriate stream */
					queue_page(og);
					stateflag = 1;
					break;
				}

				test.init(og.serialno());
				test.pagein(og);
				test.packetout(op);
				if (DUMP)
					Dumper.dump(op);

				/* identify the codec: try theora */
				if (ENABLE_VIDEO && theora_p == 0 && ti.decodeHeader(tc, op) >= 0)
				{
					/* it is theora */
					to = test;
					if (DUMP)
						Dumper.dump(ti);
					if (DUMP)
						Dumper.dump(tc);
					theora_p = 1;
				} else if (ENABLE_AUDIO && vorbis_p == 0 && vi.synthesis_headerin(vc, op) >= 0)
				{
					/* it is vorbis */
					vo = test;
					//memcpy(&vo,&test,sizeof(test));
					vorbis_p = 1;
				} else
				{
					/* whatever it is, we don't care about it */
					test.clear();
				}
			}
			/* fall through to non-bos page parsing */
		}

		/* we're expecting more header packets. */
		while ((theora_p != 0 && theora_p < 3) || (vorbis_p != 0 && vorbis_p < 3))
		{
			int ret;

			/* look for further theora headers */
			while (theora_p != 0 && (theora_p < 3) && ((ret = to.packetout(op))) != 0)
			{
				if (ret < 0)
				{
					System.err.print("Error parsing Theora stream headers; corrupt stream?\n");
					return;
				}
				if (ti.decodeHeader(tc, op) != 0)
				{
					System.err.printf("Error parsing Theora stream headers; corrupt stream?\n");
					return;
				}
				theora_p++;
				if (theora_p == 3)
					break;
			}

			/* look for more vorbis header packets */
			while (vorbis_p != 0 && (vorbis_p < 3) && ((ret = vo.packetout(op))) != 0)
			{
				if (ret < 0)
				{
					System.err.print("Error parsing Vorbis stream headers; corrupt stream?\n");
					return;
				}

				if (vi.synthesis_headerin(vc, op) != 0)
				{
					System.err.print("Error parsing Vorbis stream headers; corrupt stream?\n");
					return;
				}
				vorbis_p++;
				if (vorbis_p == 3)
					break;
			}

			/* The header pages/packets will arrive before anything else we
			   care about, or the stream is not obeying spec */

			if (oy.pageout(og) > 0)
			{
				queue_page(og); /* demux into the appropriate stream */
			} else
			{
				final int ret2 = buffer_data(infile, oy); /* someone needs more data */
				if (ret2 <= 0)
				{
					System.err.print("End of file while searching for codec headers.\n");
					return;
				}
			}
		}

		//System.out.println("Initializing decoders...");

		/* and now we have it all.  initialize decoders */
		if (theora_p != 0)
		{
			td.decodeInit(ti);
			System.out.printf("Ogg logical stream %x is Theora %dx%d %.02f fps", getSerialNo(to), ti.width, ti.height, (double) ti.fps_numerator / ti.fps_denominator);
			// TODO: jheora doesn't have pixelformat as a field of ti:
			//	    switch(ti.pixelformat){
			//	      case TheoraLibrary.OC_PF_420: System.out.printf(" 4:2:0 video\n"); break;
			//	      case TheoraLibrary.OC_PF_422: System.out.printf(" 4:2:2 video\n"); break;
			//	      case TheoraLibrary.OC_PF_444: System.out.printf(" 4:4:4 video\n"); break;
			//	      case TheoraLibrary.OC_PF_RSVD:
			//	      default:
			//	  	    System.out.printf(" video\n  (UNKNOWN Chroma sampling!)\n");
			//		break;
			//	    }
			if (ti.width != ti.frame_width || ti.height != ti.frame_height)
				System.out.printf("  Frame content is %dx%d with offset (%d,%d).\n", ti.frame_width, ti.frame_height, ti.offset_x, ti.offset_y);
			report_colorspace(ti);
			dump_comments(tc);
		} else
		{
			/* tear down the partial theora setup */
			ti.clear();
			// tc.clear();
		}
		if (vorbis_p != 0)
		{
			vd.synthesis_init(vi);
			vb.init(vd);
			System.out.printf("Ogg logical stream %x is Vorbis %d channel %d Hz audio.\n", getSerialNo(vo), vi.channels, vi.rate);
		} else
		{
			/* tear down the partial vorbis setup */
			vi.clear();
			// vc.clear();
		}

		//System.out.println("Starting playback...");

		/* open audio */
		if (vorbis_p != 0)
			open_audio();

		/* open video */
		if (theora_p != 0)
			open_video();

		//	  /* install signal handler as SDL clobbered the default */
		//	  signal (SIGINT, sigint_handler);

		/* on to the main decode loop.  We assume in this example that audio
		   and video start roughly together, and don't begin playback until
		   we have a start frame for both.  This is not necessarily a valid
		   assumption in Ogg A/V streams! It will always be true of the
		   example_encoder (and most streams) though. */

		stateflag = 0; /* playback has not begun */
		while (true)
		{

			/* we want a video and audio frame ready to go at all times.  If
			   we have to buffer incoming, buffer the compressed data (ie, let
			   ogg do the buffering) */
			while (vorbis_p != 0 && audiobuf_ready == 0)
			{
				int ret;
				final float[][][] pcm = new float[1][][];
				final int[] index = new int[vi.channels];

				/* if there's pending, decoded audio, grab it */
				if ((ret = vd.synthesis_pcmout(pcm, index)) > 0)
				{

					final float[][] floatArrays = pcm[0];

					int count = audiobuf_fill / 2;
					final int maxsamples = (audiofd_fragsize - audiobuf_fill) / 2 / vi.channels;
					for (i = 0; i < ret && i < maxsamples; i++)
					{
						for (j = 0; j < vi.channels; j++)
						{

							int val = Math.round(floatArrays[j][index[j] + i] * 32767.f);
							if (val > 32767)
								val = 32767;
							if (val < -32768)
								val = -32768;
							audiobuf[count++] = (short) val;
						}
					}

					vd.synthesis_read(i);
					audiobuf_fill += i * vi.channels * 2;
					if (audiobuf_fill == audiofd_fragsize)
						audiobuf_ready = 1;
					// TODO: these fields are inaccessible with jorbis:
					//	        if(vd.granulepos>=0)
					//	          audiobuf_granulepos=vd.granulepos-ret+i;
					//	        else
					//	          audiobuf_granulepos+=i;

				} else
				{

					/* no pending audio; is there a pending packet to decode? */
					if (vo.packetout(op) > 0)
					{
						if (vb.synthesis(op) == 0) /* test for success! */
							vd.synthesis_blockin(vb);
					} else
						/* we need more data; break out to suck in another page */
						break;
				}
			}

			while (theora_p != 0 && videobuf_ready == 0)
			{
				/* theora is one in, one out... */
				if (to.packetout(op) > 0)
				{

					td.decodePacketin(op);
					videobuf_granulepos = td.granulepos;

					videobuf_time = td.granuleTime(videobuf_granulepos);

					//	        /* is it already too old to be useful?  This is only actually
					//	           useful cosmetically after a SIGSTOP.  Note that we have to
					//	           decode the frame even if we don't show it (for now) due to
					//	           keyframing.  Soon enough libtheora will be able to deal
					//	           with non-keyframe seeks.  */
					//
					//	        if(videobuf_time>=get_time())
					videobuf_ready = 1;

				} else
					break;
			}

			//	    if(videobuf_ready == 0 && audiobuf_ready == 0 && feof(infile))break;

			if (videobuf_ready == 0 || audiobuf_ready == 0)
			{
				/* no data yet for somebody.  Grab another page */
				int bytes = buffer_data(infile, oy);
				if (bytes < 0)
				{
					// EOF.  Now we have to still process any buffered data, in particular in
					// the case of audio-only, where a lot of data may still be buffered.
					// the original implementation outputs the audio in a much-more real-time (non-buffered)
					// fashion, so maybe this was never a problem.  kenlars99 8/23/07.
					while (oy.pageout(og) > 0)
					{
						queue_page(og);
					}

					if (videobuf_ready == 0 && audiobuf_ready == 0)
						break; // quit if EOF, AND no buffers.
				}
				while (oy.pageout(og) > 0)
				{
					queue_page(og);
				}
			}

			/* If playback has begun, top audio buffer off immediately. */
			if (stateflag != 0)
				audio_write_nonblocking();

			/* are we at or past time for this video frame? */
			if (stateflag != 0 && videobuf_ready != 0
			//		&& videobuf_time<=get_time()
			)
			{
				video_write();
				videobuf_ready = 0;
			}

			//	    if(stateflag &&
			//	       (audiobuf_ready || vorbis_p == 0) &&
			//	       (videobuf_ready || theora_p == 0) &&
			//	       !got_sigint){
			//	      /* we have an audio frame ready (which means the audio buffer is
			//	         full), it's not time to play video, so wait until one of the
			//	         audio buffer is ready or it's near time to play video */
			//	        
			//	      /* set up select wait on the audiobuffer and a timeout for video */
			//	      struct timeval timeout;
			//	      fd_set writefs;
			//	      fd_set empty;
			//	      int n=0;
			//
			//	      FD_ZERO(&writefs);
			//	      FD_ZERO(&empty);
			//	      if(audiofd>=0){
			//	        FD_SET(audiofd,&writefs);
			//	        n=audiofd+1;
			//	      }
			//
			//	      if(theora_p){
			//	        long milliseconds=(videobuf_time-get_time())*1000-5;
			//	        if(milliseconds>500)milliseconds=500;
			//	        if(milliseconds>0){
			//	          timeout.tv_sec=milliseconds/1000;
			//	          timeout.tv_usec=(milliseconds%1000)*1000;
			//
			//	          n=select(n,&empty,&writefs,&empty,&timeout);
			//	          if(n)audio_calibrate_timer(0);
			//	        }
			//	      }else{
			//	        select(n,&empty,&writefs,&empty,NULL);
			//	      }
			//	    }

			/* if our buffers either don't exist or are ready to go,
			   we can begin playback */
			if ((theora_p == 0 || videobuf_ready != 0) && (vorbis_p == 0 || audiobuf_ready != 0))
				stateflag = 1;
			//	    /* same if we've run out of input */
			//	    if(feof(infile))stateflag=1;

		}

		/* tear it all down */

		// play any remaining buffered audio:
		if (sourceLine != null)
			sourceLine.drain();

		audio_close();
		// TODO: close window?

		if (vorbis_p != 0)
		{
			vo.clear();
			vb.clear();
			vd.clear();
			// vc.clear();
			vi.clear();

		}
		if (theora_p != 0)
		{
			to.clear();
			td.clear();
			//tc.clear();
			ti.clear();
		}
		oy.clear();

		infile.close();

		System.out.println();
		System.out.println("Done.");

	}
	
	static int getSerialNo(StreamState ss)
	{	return -1;	// TODO: inaccessible with jorbis
		// TODO: we could use reflection
	}

	
}
