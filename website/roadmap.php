<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'include/metas.php'; ?>
<?php include 'include/globals.php'; ?>

<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="styles/styles.css" />
<script type="text/javascript" language="JavaScript1.2" src="js/stmenu.js"></script>
<script type="text/javascript" src="js/jquery-1.1.4.pack.js"></script>
<script language="javascript">

	$(document).ready(function(){
		$("table[@id~=roadmaptable_]").hide();
	});

	
	function toggleRoadmapTable(id) {
		if( $("#roadmaptable_"+id).attr('class')=='ishidden') {
			$("a[@id=roadmaptoggle_"+id+"]").html("less");
			$("#roadmaptable_"+id).fadeIn("normal", function() { 
												$("#roadmaptable_"+id).attr('class', ''); 
												});
		}
		else {
			$("a[@id=roadmaptoggle_"+id+"]").html("more");
			$("#roadmaptable_"+id).fadeOut("normal", function() { 
												$("#roadmaptable_"+id).attr('class', 'ishidden');  
												});
		}
	}
</script>
<title>Roadmap &amp; Status - FMJ</title>
</head>
<body>

<!-- NOTE: Please do follow the design format when creating a new roadmap section. -->

<table id="webpage" align="center" cellpadding="0" cellspacing="5">
<tr><td id="header">
	<?php include 'include/header.php'; ?>
</td></tr>
<tr><td id="mainmenu" class="mainmenu">
	<script type="text/javascript" language="JavaScript1.2" src="js/mainmenu.js"></script>
</td></tr>
<tr><td>
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td id="maincontent" class="maincontent">
				<h1>Roadmap &amp; Status</h1>
				<p><strong>Help is needed</strong> with implementing portions of the following tasks. Click on "more" link to expand each task. Keep in mind that if you are eager to help, you are always welcome to <a href="fmj/join_team.php" title="Join FMJ development team">join our team</a>!</p>
				
				<table id="roadmaptables" width="100%" cellpadding="3" cellspacing="0">
				
				<tr><td style="height: 20px;">
					<strong>1. Implement Public JMF API</strong>&nbsp;&nbsp;[<a id="roadmaptoggle_0" href="javascript:void(0);" onclick="toggleRoadmapTable(0);">more</a>]
				</td></tr>
				<tr><td>
					<table id="roadmaptable_0" class="ishidden" width="100%" cellpadding="5" cellspacing="0">
						<tr>
							<td width="50%" class="roadmapheader">Status</td>
							<td width="50%" class="roadmapheader">Help Needed/TODO</td>
						</tr>
						<tr>
							<td class="roadmaprow">
							<p>The public API is simply the architecture, without providing any specific actual codecs, formats, or players.
							This is mostly done. We also implement some internal com.sun and com.ibm classes as needed to support existing projects which use JMF.
							</p>
							<p>
							Progress.csv (available in HTML and for download as an CSV file from <a href="fmj/progress.php">here</a>) shows the progress of individual (public) classes. Mostly complete apart from GUI and a few RTP classes. 
							</p>
							<p>FMJ can be swapped out for JMF when running several Essential JMF samples (their sample multi-image and text players)</p>
							</td>
							<td class="roadmaprow">
							<p>Implement javax.media.bean.playerbean.*</p>
							<p>Replacements for more internal com.sun and com.ibm classes</p>
							<p>Flesh out few JMF classes that are still stubbed out. </p>
							</td>
						</tr>
					</table>
				</td></tr>
				
				
				
				<tr><td style="height: 20px;">
					<strong>2. FMJ Studio</strong>&nbsp;&nbsp;[<a id="roadmaptoggle_1" href="javascript:void(0);" onclick="toggleRoadmapTable(1);">more</a>]
				</td></tr>
				<tr><td>
					<table id="roadmaptable_1" class="ishidden" width="100%" cellpadding="5" cellspacing="0" >
						<tr>
							<td width="50%" class="roadmapheader">Status</td>
							<td width="50%" class="roadmapheader">Help Needed/TODO</td>
						</tr>
						<tr>
							<td class="roadmaprow">
							<p>This is FMJ's answer to JMStudio, a sample application which demonstrates many of the features of FMJ/JMF.</p>
							<p>Currently supports playback (to the extent that the formats/codecs are supported)</p>
							<p>Volume control</p>
							<p>Playback of RTP audio and video</p>
							<p>Transmission of RTP audio using RTP/ULAW</p>
							<p>Registry editor</p>
							</td>
							<td class="roadmaprow">
							<p>Transmission of RTP audio using other formats</p>
							<p>Transmission of RTP video, and audio/video simultaneously</p>
							<p>Transcode wizard</p>
							<p>FMJ Studio menu options: maintain aspect ration, full screen, snapshot, plugin viewer, capture control, transmission stats</p>
							<p>Better and more graphical controls for playback/rate/volume, and graphical controls for things like packet size, etc.  There are some controls in EJMF that we may be able to use as a reference.</p>
							</td>
						</tr>
					</table>
				</td></tr>
				
				
				
				<tr><td style="height: 20px;">
					<strong>3. Native Players</strong>&nbsp;&nbsp;[<a id="roadmaptoggle_2" href="javascript:void(0);" onclick="toggleRoadmapTable(2);">more</a>]
				</td></tr>
				<tr><td>
					<table id="roadmaptable_2" class="ishidden" width="100%" cellpadding="5" cellspacing="0">
						<tr>
							<td width="50%" class="roadmapheader">Status</td>
							<td width="50%" class="roadmapheader">Help Needed/TODO</td>
						</tr>
						<tr>
							<td class="roadmaprow">
								<p>This is the simplest way to playback video.  
								Native players do not process the media in Java, but simply wrap a native player, and use that player's GUI for display.  
								Internal codecs and such are not exposed, and no JMF-style filter graph is built.</p>
								<p>We have Java-based player/handlers using Quicktime, DirectShow, and GStreamer (via <a href="http://code.google.com/p/gstreamer-java/" target="_blank">GStreamer-Java</a>) wrappers. Each of these is a class named Handler which implements Player.</p>
								
							</td>
							<td class="roadmaprow">
								<p>Some features are missing for some players, including the ability to get the correct media time, seek, fast forward, rewind, etc.</p>
								<p>The next step with these wrappers needs to be done, which is to get the bits of the decoded audio/video, to allow them to be pumped through a filter graph, rather than
								rendered natively. (We would still want to keep the ability to render natively of course)</p>
							</td>
						</tr>
					</table>
				</td></tr>
					
					
					
				<tr><td style="height: 20px;">
					<strong>4. Filter-Graph Playback</strong>&nbsp;&nbsp;[<a id="roadmaptoggle_3" href="javascript:void(0);" onclick="toggleRoadmapTable(3);">more</a>]
				</td></tr>
				<tr><td>
					<table id="roadmaptable_3" class="ishidden" width="100%" cellpadding="5" cellspacing="0">
						<tr>
							<td width="50%" class="roadmapheader">Status</td>
							<td width="50%" class="roadmapheader">Help Needed/TODO</td>
						</tr>
						<tr>
							<td class="roadmaprow">
							<p>JMF defines an architecture with for playback/processing with DataSources, Demultiplexers, Codecs, and Renderers. For media playback, a filter graph is built using these elements. </p>
							<p>FMJ has implemented basic filter graph construction and execution.</p>
							<p>Many audio Demultiplexers / Cocecs are implemented using JavaSound.</p>
							<p>A number of RTP Packetizers / Depacketizers / Codecs are implemented (JPEG, ULAW, ALAW, Speex, iLBC)</p>
							<p>Sound and video renderers are implemented, with volume control</p>
							<p>Playback of streaming audio, such as from internet radio</p>
							<p>Play most uncompressed audio files using JavaSound.</p>
							<p>Play MP3/OGG files in a GUI using javazoom / jlayer SPIs for JavaSound (FMJ has a JavaSound parser, codec, and renderer). WAV, AU, and AIFF files play   with javasound using no SPIs </p>
							<p>Alternatively, play OGG files using JFFMPEG</p>
							<p>Support FOBS4JMF if in classpath</p>
							<p>Support ffmpeg demux/decode via ffmpeg-java (see below)</p>
							</td>
							<td class="roadmaprow">
							<p>Filter graph processing needs to improve synchronization of audio and video.</p>
							<p>Filter graph processing needs to use multiple threads and double-buffering to improve performance.</p>
							<p>More pure-Java Demultiplexers and Codecs need to be implemented</p>
							<p>More wrappers around native Demultiplexers and Codecs need to be implemented</p>
							<p>Controls on various plugins, such as packet size, etc.</p>
							<p>Support native/NIO buffers for improved performance</p>
							</td>
						</tr>
					</table>
				</td></tr>	
					
				
				<tr><td style="height: 20px;">
					<strong>5. Capture</strong>&nbsp;&nbsp;[<a id="roadmaptoggle_4" href="javascript:void(0);" onclick="toggleRoadmapTable(4);">more</a>]
				</td></tr>
				<tr><td>
					<table id="roadmaptable_4" class="ishidden" width="100%" cellpadding="5" cellspacing="0">
						<tr>
							<td width="50%" class="roadmapheader">Status</td>
							<td width="50%" class="roadmapheader">Help Needed/TODO</td>
						</tr>
						<tr>
							<td class="roadmaprow">
							<p>Video capture device support provided via <a href="http://lti-civil.org/" target="_blank" title="Go to LTI-CIVIL's website">LTI-CIVIL</a> (DirectShow, Quicktime, V4L2).</p>
							<p>Audio capture using a javasound datasource. </p>
							</td>
							<td class="roadmaprow">
							<p>Support querying and changing of resolution/format</p>
							<p>Support faster throughput (double-buffering)</p>
							<p>Support format details in video capture URLs</p>
							</td>
						</tr>
					</table>
				</td></tr>
					
					
				<tr><td style="height: 20px;">
					<strong>6. RTP</strong>&nbsp;&nbsp;[<a id="roadmaptoggle_5" href="javascript:void(0);" onclick="toggleRoadmapTable(5);">more</a>]
				</td></tr>
				<tr><td>
					<table id="roadmaptable_5" class="ishidden" width="100%" cellpadding="5" cellspacing="0">
						<tr>
							<td width="50%" class="roadmapheader">Status</td>
							<td width="50%" class="roadmapheader">Help Needed/TODO</td>
						</tr>
						<tr>
							<td class="roadmaprow">
							<p>We have a contributed RTP library, and supporting Codec / DataSource for JPEG/RTP reception and rtp:// URL handling, but integration and testing is still in progress. SIP-Communicator has some packetizers/depacketizers we have borrowed/integrated.</p>
							<p>A number of RTP Packetizers / Depacketizers / Codecs are implemented (JPEG, ULAW, ALAW, Speex, iLBC)</p>
							<p>Display RTP/JPEG streams, using the rtp:// URL syntax (e.g. rtp://192.168.1.1:8000)</p>
							<p>Transmit and playback a number of different RTP audio streams: RTP/ULAW, RTP/ALAW, RTP/Speex, RTP/iLBC</p>
							</td>
							<td class="roadmaprow">
							<p>RTP/JPEG transmission (packetizer)</p>
							<p>Implementation of other RTP Packetizers / Depacketizers / Codecs, either in pure Java or by wrapping native code.</p>
							<p>Synchronization of audio and video</p>
							</td>
						</tr>
					</table>
				</td></tr>
					
					
				<tr><td style="height: 20px;">
					<strong>7. Processing</strong>&nbsp;&nbsp;[<a id="roadmaptoggle_6" href="javascript:void(0);" onclick="toggleRoadmapTable(6);">more</a>]
				</td></tr>
				<tr><td>
					<table id="roadmaptable_6" class="ishidden"  width="100%" cellpadding="5" cellspacing="0">
						<tr>
							<td width="50%" class="roadmapheader">Status</td>
							<td width="50%" class="roadmapheader">Help Needed/TODO</td>
						</tr>
						<tr>
							<td class="roadmaprow">
							<p>Basic construction and execution of Processors is working. This always means the construction of a filter graph, and often involves Multiplexers at the output end of the graph.</p>
							<p>A JavaSound Multiplexer has been written which can write files such as .wav and .au</p>
							</td>
							<td class="roadmaprow">
							<p>Advanced features of processing such as inserting codecs into the codec chain, and adding renderers</p>
							<p>Multiplexers which wrap native libraries (DirectShow, Quicktime, GStreamer, FFMPEG)</p>
							</td>
						</tr>
					</table>
				</td></tr>
				
				
				<tr><td style="height: 20px;">
					<strong>8. FFMPEG-Java</strong>&nbsp;&nbsp;[<a id="roadmaptoggle_7" href="javascript:void(0);" onclick="toggleRoadmapTable(7);">more</a>]
				</td></tr>
				<tr><td>
					<table id="roadmaptable_7" class="ishidden"   width="100%" cellpadding="5" cellspacing="0">
						<tr>
							<td width="50%" class="roadmapheader">Status</td>
							<td width="50%" class="roadmapheader">Help Needed/TODO</td>
						</tr>
						<tr>
							<td class="roadmaprow">
							<p>The existing FFMPEG wrappers have shortcomings:
								(FOBS4JMF: an unnecessary C++ wrapper is in between Java and ffmpeg, hiding functionality) 
								(JFFMPEG: attempt to port FFMPEG to Java, lags behind FFMPEG).
								So a new FFMPEG wrapper, FFMPEG-Java is being developed using JNA.  
								It is in the FMJ CVS repository, under a different root folder, FFMPEG-Java.
								It also has its own file releases on the downloads page.
							</p>
							<p>Demultiplexer wraps FFMPEG if available as dynamic libraries.</p>
							<p>Supports arbitrary JMF/FMJ DataSources, not limited to file://, http:// etc, supported by FFMPEG</p>
							</td>
							<td class="roadmaprow">
							<p>Break out codecs from demultiplexer to be implemented by JMF-style Codecs</p>
							<p>Break out software scaling (including YUV/RGB conversion) from demultiplexer to be implemented by JMF-style Codecs</p>
							<p>Test/integrate Other ffmpeg protocols: pipe, tcp, rtp</p>
							<p>Support encoding</p>
							</td>
						</tr>
					</table>
					
				<tr><td style="height: 20px;">
					<strong>9. Theora</strong>&nbsp;&nbsp;[<a id="roadmaptoggle_8" href="javascript:void(0);" onclick="toggleRoadmapTable(8);">more</a>]
				</td></tr>
				<tr><td>
					<table id="roadmaptable_8" class="ishidden"  width="100%" cellpadding="5" cellspacing="0">
						<tr>
							<td width="50%" class="roadmapheader">Status</td>
							<td width="50%" class="roadmapheader">Help Needed/TODO</td>
						</tr>
						<tr>
							<td class="roadmaprow">
							<p>Theora occupies a unique place in the world of media: it is the only modern, performant codec that is unencumbered by patent and royalty issues. It then makes sense that an open-source media project should have first-class support for this. In particular, it would be good have a pure java version of this, since it would be perfect for applets.  <a href="http://www.flumotion.net/cortado/" target="_blank">Cortado</a> could serve this purpose, but it is GPL, not LGPL.</p>
							<p>The actual ogg container should already be supported by FMJ's support of Ogg/Vorbis audio.</p>
							</td>
							<td class="roadmaprow">
							<p>The first task would be to wrap the native theora library using JNA, has started, see below.  The next effort would be to actually port the C to Java.</p>
							</td>
						</tr>
					</table>
				</td></tr>
				
				
				<tr><td style="height: 20px;">
					<strong>10. Theora-Java</strong>&nbsp;&nbsp;[<a id="roadmaptoggle_9" href="javascript:void(0);" onclick="toggleRoadmapTable(9);">more</a>]
				</td></tr>
				<tr><td>
					<table  id="roadmaptable_9" class="ishidden"   width="100%" cellpadding="5" cellspacing="0">
						<tr>
							<td width="50%" class="roadmapheader">Status</td>
							<td width="50%" class="roadmapheader">Help Needed/TODO</td>
						</tr>
						<tr>
							<td class="roadmaprow">
							<p>
								A theora/ogg/vorbis wrapper, theora-java is being developed using JNA.  
								It is in the FMJ CVS repository, under a different root folder, Theora-Java.
								It also has its own file releases on the downloads page.
							</p>
							</td>
							<td class="roadmaprow">
							<p>Create a demultiplexer/codecs based on Theora-Java</p>
							<p>Support encoding</p>
							</td>
						</tr>
					</table>
				</td></tr>
				
				
				<tr><td style="height: 20px;">
					<strong>11. Miscellaneous</strong>&nbsp;&nbsp;[<a id="roadmaptoggle_10" href="javascript:void(0);" onclick="toggleRoadmapTable(10);">more</a>]
				</td></tr>
				<tr><td>
					
					<table id="roadmaptable_10" class="ishidden" width="100%" cellpadding="5" cellspacing="0">
						<tr>
							<td width="50%" class="roadmapheader">Status</td>
							<td width="50%" class="roadmapheader">Help Needed/TODO</td>
						</tr>
						<tr>
							<td class="roadmaprow">
							<p>Miscellaneous tasks</p>
							</td>
							<td class="roadmaprow">
							<p>Sample media. It would be great to find public domain media files that we can use and redistribute for testing. We have a few in our samplemedia directory. </p>
							<p>Help get JFFMPEG to work with FMJ.  Some of the parsers and codecs are now close to working. Much of this work is on the JFFMPEG end. </p>
							<p>JMF-based open-source projects: Searching on Sourceforge for JMF turns up a number of open-source projects based on JMF. We should work to make FMJ be able to be used instead of JMF for these. The first step is usually just trying to build the other projects against FMJ instead of JMF. This will turn up various dependencies on Sun and IBM internal libraries, for example. See <a href="jmf/projects.php">here</a> for FMJ's list of JMF-related projects. </p>
							<p>JMF sample code: We should work to make FMJ be able to be used instead of JMF for various sample code files/projects. The first step is usually just trying to build them against FMJ instead of JMF. This will turn up various dependencies on Sun and IBM internal libraries, for example. See <a href="jmf/examples.php">here</a> for FMJ's list of JMF sample code. </p>
							</td>
						</tr>
					</table>
				</td></tr>
				
				
				<tr><td style="height: 20px;">
					<strong>12. Future Ideas / Directions</strong>&nbsp;&nbsp;[<a id="roadmaptoggle_11" href="javascript:void(0);" onclick="toggleRoadmapTable(11);">more</a>]
				</td></tr>
				<tr><td>
					
					<table id="roadmaptable_11" class="ishidden" width="100%" cellpadding="5" cellspacing="0">
						<tr>
							<td width="50%" class="roadmapheader">Ideas from kenlars99:</td>
						</tr>
						<tr>
							<td class="roadmaprow">
								<ul>
								<li>Support capture devices on Mac OSX, Linux 64-bit (JMF only supports Win32, Linux x86, and Solaris) </li>
								<li>Support hotplugging of capture devices </li>
								<li>Support a standard way of adding MIME types. This is supported in JMF using an internal Sun class. </li>
								<li>Native codecs on various platforms, with dynamic determination of supported formats, rather than having to use registry. </li>
								<li>Integration with codec downloading where supported (DirectShow, WMP, Quicktime) </li>
								<li>An API to get tags from various files like MP3/Ogg </li>
								<li>m3u/playlists </li>
								<li>ip cameras, and server end of an ip camera</li>
								<li>CD audio</li>
								<li>data sink for internet radio streaming</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td width="50%" class="roadmapheader">Ideas from stormboy:</td>
						</tr>
						<tr>
							<td class="roadmaprow">
							  <p>I believe the JMF APIs should be updated as well. Although FMJ should comply with official APIs, it may be able to influence the direction of API changes. </p>
							  <p>It should function 100% Java with no native libraries required, but if native libraries exist, certain features use them. </p>
							  <p>Here are some of many suggestions (although some of them may be better placed in jffmpeg or FOBS): </p>
							  <ul>
								<li>Use of nio buffers instead of JMF's native buffer hack. Sun's current JMF code checks if a buffer is a special native implementation. This is specific to   Sun's JMF implementation so the native abilities may not be re-used by other plugins. Ultimately there should be an API change to javax.media.Buffer to use nio.Buffers </li>
								<li>Add a few good renderers. I have written a JOGL renderer that does pretty well, especially when scaling the video image. I have also written an Xv video renderer for rendering YUV directly on Linux systems. </li>
								<li>Being able to choose a particular audio Mixer for audio input or output, and control of line level. Use current sample audio APIs. </li>
								<li>Better video capture DataSources: DirectShow on Win, V4L2 on Linux, IEEE1394 capture on Linux, Quicktime on MacOS (fobs may have this already). </li>
								<li>A well managed registry - possibly using XML or some other editable text format instead of a binary format. API that allows registering mime-types and protocol packages. </li>
								<li>An online registry of JMF plugins where the FMJ may download and install required/missing plugins. </li>
								<li>Good automatic detection of media devices available to FMJ. </li>
								<li>Updated security/permissions handling, using up to date JAAS. Currently if the libraries for JMF and Java3D are in different locations, security exceptions occur. </li>
								<li>Accelerated player/filter implementaions: e.g. GStreamer (using GST-Java), DirectShow. </li>
								<li>Efficient RTP transmitting and receiving: optional native library acceleration. </li>
								<li>Perhaps a MIDI data source. Use current Java MIDI APIs. </li>
								<li>A binary package for each platform that has JFFMPEG and/or fobs already packaged. </li>
								<li>Support for interactive media such as DVD menus and SMIL. </li>
								<li>Also note improvements suggested <a href="http://www.dutchie.net/jmf/bugs/default.htm" target="_blank">here</a> (some of them were submitted by me). </li>
							  </ul>
							  <p>&nbsp;</p>
							</td>
						</tr>
					</table>
				</td></tr>
				
				
				<!-- END OF ROADMAP TABLES (ALL) -->
				</table>
				<p>&nbsp;</p>
				
				
				<h2>Goals</h2>
			 	<ol>
					<li>Provide a drop-in replacement for JMF, supporting existing code that uses JMF </li>
					<li>Address shortcomings of JMF, and provide additional features that JMF does not provide, for example: 
						<ul>
							<li>Support for modern codecs</li>
							<li>Wrap various native libraries (DirectShow, Quicktime, GStreamer, FFMPEG)</li>
							<li>Support more platforms (Windows, Mac OS X, Linux, 64-bit support)</li>
							<li>Dynamic plug-in, codec, and capture device support</li>
							<li>Editable registry file</li>
							<li>Not require anything to be installed to the JRE</li>
						</ul>
					</li>
					<li>Provide both native performance where possible, and pure-java flexibility where possible. </li>
			  	</ol>
				<p>&nbsp;</p>
			  
			</td>
			<td id="rightpanel" class="rightpanel">
				<?php include 'include/panel/panel_default.php'; ?>
			</td>
		</tr>
	</table>
</td></tr>

<tr><td id="footer">
	<?php include 'include/footer.php'; ?>
</td></tr>
</table>
</body>
</html>
