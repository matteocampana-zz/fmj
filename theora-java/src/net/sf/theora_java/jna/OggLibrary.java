package net.sf.theora_java.jna;

import com.sun.jna.Native;
import com.sun.jna.NativeLong;
import com.sun.jna.Pointer;
import com.sun.jna.Structure;

/**
 * based on libogg-1.1.3 ogg.h
 * @author Ken Larson
 *
 */
public interface OggLibrary extends XiphLibrary
{

    public static final OggLibrary INSTANCE = (OggLibrary) Native.loadLibrary("ogg", OggLibrary.class);

	/********************************************************************
	 *                                                                  *
	 * THIS FILE IS PART OF THE OggVorbis SOFTWARE CODEC SOURCE CODE.   *
	 * USE, DISTRIBUTION AND REPRODUCTION OF THIS LIBRARY SOURCE IS     *
	 * GOVERNED BY A BSD-STYLE SOURCE LICENSE INCLUDED WITH THIS SOURCE *
	 * IN 'COPYING'. PLEASE READ THESE TERMS BEFORE DISTRIBUTING.       *
	 *                                                                  *
	 * THE OggVorbis SOURCE CODE IS (C) COPYRIGHT 1994-2002             *
	 * by the Xiph.Org Foundation http://www.xiph.org/                  *
	 *                                                                  *
	 ********************************************************************

	 function: toplevel libogg include
	 last mod: $Id: OggLibrary.java,v 1.1 2007/08/28 15:48:21 kenlars99 Exp $

	 ********************************************************************/
//	#ifndef _OGG_H
//	#define _OGG_H
//
//	#ifdef __cplusplus
//	extern "C" {
//	#endif
//
//	#include <ogg/os_types.h>

	public static class oggpack_buffer extends Structure
	{
	  public NativeLong /*long*/ endbyte;
	  public int  endbit;

	  public Pointer /*unsigned char **/buffer;
	  public Pointer /*unsigned char **/ptr;
	  public NativeLong /*long*/ storage;
	}

	/* ogg_page is used to encapsulate the data in one Ogg bitstream page *****/

	public static class ogg_page extends Structure
	{
		public Pointer /*unsigned char **/header;
		public NativeLong /*long*/ header_len;
		public Pointer /*unsigned char **/body;
		public NativeLong /*long*/ body_len;
	} 

	/* ogg_stream_state contains the current encode/decode state of a logical
	   Ogg bitstream **********************************************************/

	public static class ogg_stream_state extends Structure
	{
		public Pointer /*unsigned char   **/ body_data;    /* bytes from packet bodies */
		public NativeLong /*long*/    body_storage;          /* storage elements allocated */
		public NativeLong /*long*/    body_fill;             /* elements stored; fill mark */
		public NativeLong /*long*/    body_returned;         /* elements of fill returned */


		public Pointer /*int     **/lacing_vals;      /* The values that will go to the segment table */
		public Pointer /*ogg_int64_t **/granule_vals; /* granulepos values for headers. Not compact
					this way, but it is simple coupled to the
					lacing fifo */
		public NativeLong /*long*/    lacing_storage;
		public NativeLong /*long*/    lacing_fill;
		public NativeLong /*long*/    lacing_packet;
		public NativeLong /*long*/    lacing_returned;

		public byte[] /*unsigned char*/    header = new byte[282];      /* working space for header encode */
		public int              header_fill;

		public int     e_o_s;          /* set when we have buffered the last packet in the
	                             logical bitstream */
		public int     b_o_s;          /* set after we've written the initial page
	                             of a logical bitstream */
		public NativeLong /*long*/    serialno;
		public NativeLong /*long*/    pageno;
		public long /*ogg_int64_t*/  packetno;      /* sequence number for decode; the framing
	                             knows where there's a hole in the data,
	                             but we need coupling so that the codec
	                             (which is in a seperate abstraction
	                             layer) also knows about the gap */
		public long /*ogg_int64_t*/   granulepos;

	}

//	/* ogg_packet is used to encapsulate the data and metadata belonging
//	   to a single raw Ogg/Vorbis packet *************************************/
//
//	public static class ogg_packet extends Structure
//	{
//		public Pointer /*unsigned char **/packet;
//		public NativeLong /*long*/  bytes;
//		public NativeLong /*long*/  b_o_s;
//		public NativeLong /*long*/  e_o_s;
//
//		public long /*ogg_int64_t*/  granulepos;
//	  
//		public long /*ogg_int64_t*/  packetno;     /* sequence number for decode; the framing
//					knows where there's a hole in the data,
//					but we need coupling so that the codec
//					(which is in a seperate abstraction
//					layer) also knows about the gap */
//	} 

	public static class ogg_sync_state extends Structure
	{
		public Pointer /*unsigned char **/data;
		public int storage;
		public int fill;
		public int returned;

		public int unsynced;
		public int headerbytes;
		public int bodybytes;
	} 

	/* Ogg BITSTREAM PRIMITIVES: bitstream ************************/

	void  oggpack_writetrunc(oggpack_buffer b,NativeLong /*long*/ bits);
	void  oggpack_writealign(oggpack_buffer b);
	void  oggpack_writecopy(oggpack_buffer b,Pointer /*void **/source,NativeLong /*long*/ bits);
	void  oggpack_reset(oggpack_buffer b);
	void  oggpack_writeclear(oggpack_buffer b);
	void  oggpack_readinit(oggpack_buffer b,Pointer /*unsigned char **/buf,int bytes);
	void  oggpack_write(oggpack_buffer b,NativeLong /*unsigned long*/ value,int bits);
	NativeLong /*long*/  oggpack_look(oggpack_buffer b,int bits);
	NativeLong /*long*/  oggpack_look1(oggpack_buffer b);
	void  oggpack_adv(oggpack_buffer b,int bits);
	void  oggpack_adv1(oggpack_buffer b);
	NativeLong /*long*/  oggpack_read(oggpack_buffer b,int bits);
	NativeLong /*long*/  oggpack_read1(oggpack_buffer b);
	NativeLong /*long*/  oggpack_bytes(oggpack_buffer b);
	NativeLong /*long*/  oggpack_bits(oggpack_buffer b);
	Pointer /*unsigned char **/oggpack_get_buffer(oggpack_buffer b);

	void  oggpackB_writeinit(oggpack_buffer b);
	void  oggpackB_writetrunc(oggpack_buffer b,NativeLong /*long*/ bits);
	void  oggpackB_writealign(oggpack_buffer b);
	void  oggpackB_writecopy(oggpack_buffer b,Pointer /*void **/source,NativeLong /*long*/ bits);
	void  oggpackB_reset(oggpack_buffer b);
	void  oggpackB_writeclear(oggpack_buffer b);
	void  oggpackB_readinit(oggpack_buffer b,Pointer /*unsigned char **/buf,int bytes);
	void  oggpackB_write(oggpack_buffer b, NativeLong /*unsigned long*/ value,int bits);
	NativeLong /*long*/  oggpackB_look(oggpack_buffer b,int bits);
	NativeLong /*long*/  oggpackB_look1(oggpack_buffer b);
	void  oggpackB_adv(oggpack_buffer b,int bits);
	void  oggpackB_adv1(oggpack_buffer b);
	NativeLong /*long*/  oggpackB_read(oggpack_buffer b,int bits);
	NativeLong /*long*/  oggpackB_read1(oggpack_buffer b);
	NativeLong /*long*/  oggpackB_bytes(oggpack_buffer b);
	NativeLong /*long*/  oggpackB_bits(oggpack_buffer b);
	Pointer /*unsigned char **/oggpackB_get_buffer(oggpack_buffer b);

	/* Ogg BITSTREAM PRIMITIVES: encoding **************************/

	int      ogg_stream_packetin(ogg_stream_state os, ogg_packet op);
	int      ogg_stream_pageout(ogg_stream_state os, ogg_page og);
	int      ogg_stream_flush(ogg_stream_state os, ogg_page og);

	/* Ogg BITSTREAM PRIMITIVES: decoding **************************/

	int      ogg_sync_init(ogg_sync_state oy);
	int      ogg_sync_clear(ogg_sync_state oy);
	int      ogg_sync_reset(ogg_sync_state oy);
	int	ogg_sync_destroy(ogg_sync_state oy);

	Pointer /*char    **/ogg_sync_buffer(ogg_sync_state oy, NativeLong /*long*/ size);
	int      ogg_sync_wrote(ogg_sync_state oy, NativeLong /*long*/ bytes);
	NativeLong /*long*/     ogg_sync_pageseek(ogg_sync_state oy,ogg_page og);
	int      ogg_sync_pageout(ogg_sync_state oy, ogg_page og);
	int      ogg_stream_pagein(ogg_stream_state os, ogg_page og);
	int      ogg_stream_packetout(ogg_stream_state os,ogg_packet op);
	int      ogg_stream_packetpeek(ogg_stream_state os,ogg_packet op);

	/* Ogg BITSTREAM PRIMITIVES: general ***************************/

	int      ogg_stream_init(ogg_stream_state os,int serialno);
	int      ogg_stream_clear(ogg_stream_state os);
	int      ogg_stream_reset(ogg_stream_state os);
	int      ogg_stream_reset_serialno(ogg_stream_state os,int serialno);
	int      ogg_stream_destroy(ogg_stream_state os);
	int      ogg_stream_eos(ogg_stream_state os);

	void     ogg_page_checksum_set(ogg_page og);

	int      ogg_page_version(ogg_page og);
	int      ogg_page_continued(ogg_page og);
	int      ogg_page_bos(ogg_page og);
	int      ogg_page_eos(ogg_page og);
	long /*ogg_int64_t*/  ogg_page_granulepos(ogg_page og);
	int      ogg_page_serialno(ogg_page og);
	NativeLong /*long*/     ogg_page_pageno(ogg_page og);
	int      ogg_page_packets(ogg_page og);

	void     ogg_packet_clear(ogg_packet op);


//	#ifdef __cplusplus
//	}
//	#endif
//
//	#endif  /* _OGG_H */







}
