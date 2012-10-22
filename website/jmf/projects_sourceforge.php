<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
	include '../include/globals.php';
	include '../include/metas.php'; 
?>

<link rel="shortcut icon" href="../favicon.ico" />
<link rel="stylesheet" type="text/css" href="../styles/styles.css" />
<script type="text/javascript" language="JavaScript1.2" src="../js/stmenu.js"></script>
<script type="text/javascript" src="../js/jquery-1.1.4.pack.js"></script>
<script type="text/javascript" src="../js/jmf/projects.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		setNumberedMenu();
		setSliderMenu();
	});
</script>

<title>SourceForge.net JMF Projects - FMJ</title>
</head>
<body>
<table id="webpage" align="center" cellpadding="0" cellspacing="5">
<tr><td id="header">
	<?php include '../include/header.php'; ?>
</td></tr>
<tr><td id="mainmenu" class="mainmenu">
	<script type="text/javascript" language="JavaScript1.2" src="../js/mainmenu.js"></script>
</td></tr>
<tr><td>
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td id="maincontent" class="maincontent">
				<h1>Projects from SourceForge.net</h1>
				<div id="numberedmenu"><!-- empty --></div>
				<p>&nbsp;</p>
				
				<table width="100%" border="0" cellpadding="5" cellspacing="0">
					<tr class="jmfprojectsheader">
						<td width="10%">Name</td>
						<td width="40%">Description</td>
						<td width="10%">License</td>
						<td width="40%">Comments</td>
				  	</tr>  
				  
					<tr class="jmfprojectsrow colortoggle0">
					  <td><a href="http://sourceforge.net/projects/jffmpeg" target="_blank">jffmpeg</a></td>
					  <td>This is a Java wrapper for Ffmpeg. The JMF (Java Media Framework) plugins system lets one use JMStudio or other application to play H.263/rfc2190 streams. Support for H.263+ and MPEG-4 is currently under test, please contact us for further information.</td>
					  <td>LGPL</td>
					  <td>Having trouble getting this to work even with JMF. In particular, the mpeg 4 demux is getting exceptions even with JMF.</td>
					</tr>
					
					<tr class="jmfprojectsrow colortoggle1">
					  <td><a href="http://sourceforge.net/projects/jaud" target="_blank">jaud</a></td>
					  <td>JAud is an Open Source Audio Application, using the JMF framework. Written in Java it utilises a number of Java libraries to try and create a Java application which does not look like or behave like a Java application.</td>
					  <td>LGPL</td>
					  <td>Very nice looking player. Appears to only use JMF to play .cda (CD audio) files. WAV files are played directly using javasound, and It looks like they use an LGPL mp3 library for mp3s (one for tags, another for playback). Playback is implemented using mp3sp.1.4.jar from http://tritonus.org/. It is an SPI for java sound. FMJ may be able to implement wav and mp3 playback using something similar. <br />
						Uses javax.media.bean. playerbean.MediaPlayer for cda, which is currently stubbed in FMJ. However, JAud could be changed to get a player from the manager, instead of using the MediaPlayer directly, since it is not using the MediaPlayer's GUI anyway as far as I can tell. </td>
					</tr>
					<tr class="jmfprojectsrow colortoggle0">
					  <td><a href="http://www.javazoom.net/projects.html" target="_blank">javazoom</a></td>
					  <td>Has a number of javasound (not JMF) projects.</td>
					  <td>LGPL</td>
					  <td>Has an MP3 SPI and and OGG SPI, which could be useful for FMJ.</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle1">
					  <td><a href="http://sourceforge.net/projects/fobs" target="_blank">fobs</a></td>
					  <td>Fobs (Ffmpeg OBjectS) offers multiplatform object oriented APIs (C++, Java) to ease the developing effort of using ffmpeg in your application. A JMF (Java Media Framework) plugin is also included in the package.</td>
					  <td>LGPL</td>
					  <td>Seems to be in a fairly early stage, doesn't seem usable yet.</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle0">
					  <td><a href="http://sourceforge.net/projects/jipcam" target="_blank">jipcam</a></td>
					  <td>jipCam provides a JMF-based datasource implementation for IP-based video cameras. This allows Internet Procotol based cameras like the Axis 2100 or 2120 to be used directly in a Java Media Framework enabled video application.</td>
					  <td>LGPL</td>
					  <td>Basically works with FMJ currently. Had to add the following to FMJ: com.sun.media. parser.RawPullBufferParser and com.sun.media. renderer.video.JPEGRenderer. The raw parser code in FMJ is still a little rough. </td>
					</tr>
					<tr class="jmfprojectsrow colortoggle1">
					  <td><a href="http://sourceforge.net/projects/rtp-text-t140" target="_blank">rtp-text-t140</a></td>
					  <td>RTP text/t140 Library is a reference implementation for RTP Payload Type for Text Conversation (RFC 4103). The library has source code for encoding and decoding RFC 4103 data, and may be used either as a plug-in to JMF or in a separate RTP sender/receive</td>
					  <td>LGPL</td>
					  <td>Has files in CVS</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle0">
					  <td><a href="http://sourceforge.net/projects/jlibdc1394" target="_blank">jlibdc1394</a></td>
					  <td>Java API for controling 1394 Digital Cameras (based on libdc1394: <a href="http://sourceforge.net/projects/libdc1394/">for Linux</a>, and on: CMU 1394 DC <a href="http://www-2.cs.cmu.edu/~iwan/1394/">for Win32</a>). On Top of the library comes a RCP plugin and a JMF capture device.</td>
					  <td>LGPL</td>
					  <td>Has files in CVS</td>
					</tr>
					
					<tr class="colortoggle1">
						<td>&nbsp;</td>
						<td colspan="3" align="left" style="height: 376px;  vertical-align: middle; ">
						<script type="text/javascript"><!--
						google_ad_client = "pub-3404523735448812";
						google_ad_width = 336;
						google_ad_height = 280;
						google_ad_format = "336x280_as";
						google_ad_type = "text_image";
						//2007-10-18: FMJ_JMFProjects
						google_ad_channel = "3286330128";
						google_color_border = "FFFFFF";
						google_color_bg = "FFFFFF";
						google_color_link = "215EA0";
						google_color_text = "232323";
						google_color_url = "000000";
						//-->
						</script>
						<script type="text/javascript"
						  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
						</script>
						</td>
					</tr>
					

					<tr class="jmfprojectsrow colortoggle0">
					  <td><a href="http://sourceforge.net/projects/timcam" target="_blank">timcam</a></td>
					  <td>TimCam - A simple graphical WebCam program written in Java using the JMF (therefore usable on Microsoft Windows and Linux). Main objective is to capture   pictures on an interval, and intelligently upload to a ftp site specified.</td>
					  <td>Public Domain</td>
					  <td>Not working with JMF capture devices, need to test with JMF on Windows for comparison</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle1">
					  <td><a href="http://sourceforge.net/projects/netsitemais" target="_blank">netsitemais</a></td>
					  <td>SIP SoftPhone desenvolvido em Java baseado na JAIN-SIP, JMF e Sip-Communicator 1.0. Possui tamb&Atilde;&copy;m o envio de SMS, Agenda, NAT Traversal, DTMF Send/Receive, CallTo e etc. A Java SIP SoftPhone based in JAIN-SIP, JMF and Sip-Comminicator 1.0.</td>
					  <td>GPL</td>
					  <td>Has files in CVS</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle0">
					  <td><a href="http://sourceforge.net/projects/javakaraoke" target="_blank">javakaraoke</a></td>
					  <td>The Java Karaoke project is implementing Karaoke players in Java, using the JMF and javasound APIs</td>
					  <td>GPL</td>
					  <td>Has files in CVS</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle1">
					  <td><a href="http://sourceforge.net/projects/neburstream" target="_blank">neburstream</a></td>
					  <td>NeburStream is a java streaming server over JMF (Java Media Framework).</td>
					  <td>Open Software License</td>
					  <td>Has files in CVS</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle0">
					  <td><a href="http://sourceforge.net/projects/marseva" target="_blank">marseva</a></td>
					  <td>Mars Eva Computing Environment is a JMF, JINI project that is used to provide a collaborative mission planning &amp; execution environment for furture teams on Mars. This effort is part of a simulation for the Mars Society of Australia.</td>
					  <td>MPL</td>
					  <td>Has files in CVS</td>
					</tr>
					
					<tr class="jmfprojectsrow colortoggle1">
					  <td><a href="http://sourceforge.net/projects/wakimediaplayer" target="_blank">wakimediaplayer</a></td>
					  <td>A Java Based Multimedia Player and Library Organizer.Instructions:
					  <br />1. Install latest <a href="http://java.com/en/download/manual.jsp">Java JRE (v5.0+)</a>
					  <br />2. Download and install <a href="http://java.sun.com/products/java-media/jmf/2.1.1/download.html">JMF</a>
					  <br />3. Install WMP</td>
					  <td>Unknown</td>
					  <td>Has files in CVS</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle0">
					  <td><a href="http://sourceforge.net/projects/jmf1394" target="_blank">jmf1394</a></td>
					  <td>A linux IEEE 1394 (firewire) driver for the Java Media Framework (JMF).</td>
					  <td>LGPL</td>
					  <td>Has files in CVS</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle1">
					  <td><a href="http://sourceforge.net/projects/jfw" target="_blank">jfw</a></td>
					  <td>This project provides firewire camera support for use in the Java Media Framework (JMF) under Linux.</td>
					  <td>LGPL</td>
					  <td>Has files in CVS</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle0">
					  <td><a href="http://sourceforge.net/projects/intervid" target="_blank">intervid</a></td>
					  <td>Intervid is a Java/JMF framework for building interactive video-based applications. The Intervid engine is used to display video clips based on time-sensitive user input.</td>
					  <td>GPL</td>
					  <td>Has files in CVS</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle1">
					  <td><a href="http://sourceforge.net/projects/madsserv" target="_blank">madsserv</a></td>
					  <td>Our project consists in the design and the implementation in JMF of a platform of services supply. The platform will enable the users to download multimedia applications and the applications to react to the changes of the environment.</td>
					  <td>GPL</td>
					  <td>Has files in CVS</td>
					</tr>
				</table>
				
				<p>&nbsp;</p>
				<div id="slidermenu"><!-- empty --></div>
				<p>&nbsp;</p>
			</td>
			<td id="rightpanel" class="rightpanel">
				<?php
				include '../include/panel/panel_default.php'; 
				?>
			</td>
		</tr>
	</table>
</td></tr>

<tr><td id="footer">
	<?php include '../include/footer.php'; ?>
</td></tr>
</table>
</body>
</html>
