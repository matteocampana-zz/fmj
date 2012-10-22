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

<title>Dead JMF Projects - FMJ</title>
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
				<h1>Dead or Unmaintained Projects</h1>
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
					  <td><a href="http://sourceforge.net/projects/roffice3" target="_blank">roffice3</a></td>
					  <td>An graphical java-environment, which includes a mediaplayer (Qt, JMF and JavaSound), a CD-burning applilcation and a very simple word-processor.</td>
					  <td>GPL</td>
					  <td>No files in CVS</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle1">
					  <td><a href="http://sourceforge.net/projects/jvideo4linux" target="_blank">jvideo4linux</a></td>
					  <td>Java Video4Linux designed to make easie integration of Java software with Linux native video subsystem(&quot;Video for Linux&quot;). It is developer library which, for example, may be useful for implementing JMF API for Linux.</td>
					  <td>GPL</td>
					  <td>No files in CVS</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle0">
					  <td><a href="http://sourceforge.net/projects/j-force" target="_blank">j-force</a></td>
					  <td>J-Force is an MP3 player for Solaris, a full fledged media organizer which comes bagged with a portable media library. Built on Java using JMF 2.1, J-Force does everything from playing MP3s to streaming Media to Device Capturing.</td>
					  <td>Unknown</td>
					  <td>No files in CVS</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle1">
					  <td><a href="http://sourceforge.net/projects/jmmp" target="_blank">jmmp</a></td>
					  <td>The eventual goal of this project is to provide a Java based multimedia box. As there is a lot to do to achive this, the projects starts as &quot;Java Multimedia Project&quot;. The project is centered around the Java Media Framework (JMF).</td>
					  <td>GPL</td>
					  <td>No files in CVS</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle0">
					  <td><a href="http://sourceforge.net/projects/jmfogg" target="_blank">jmfogg</a></td>
					  <td>&quot;Ogg Vorbis JMF Plug-in&quot; is intended to provide a plug-in/codec for the Java Media Framework which may provide quality audio en/de/transcoding and RTP streaming for the Ogg Vorbis audio format. See &quot;Forums&quot; and &quot;Docs&quot; for additional information.</td>
					  <td>LGPL</td>
					  <td>Has files in CVS, but not close to a working state, appears dead.</td>
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
					  <td><a href="http://sourceforge.net/projects/divx-for-jmf" target="_blank">divx-for-jmf</a></td>
					  <td>The aim of this project is creating a JMF (Java Media Framework) wrapper for DivX (tm) codec.</td>
					  <td>Unknown</td>
					  <td>Appears dead</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle1">
					  <td><a href="http://sourceforge.net/projects/chimmp" target="_blank">chimmp</a></td>
					  <td>CHET's Instant Message Music Player (CHIMMP) is an music jukebox system controlled using an instant-messenging client, such as AIM. The pure-java solution uses JMF, JDBC, and Jabber for operation.</td>
					  <td>MIT</td>
					  <td>Appears dead</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle0">
					  <td><a href="http://sourceforge.net/projects/h263" target="_blank">h263</a></td>
					  <td>Open source implementation of a H.263 decoder written in 1.1.8 compatible Java code. Designed to work out of the box with the RAW/RTP H263/RTP transmission settings in JMF (and JMFStudio). Suitable for running pure Java H.263 decoder video as an application.</td>
					  <td>Unknown</td>
					  <td>No files yet. If this project is not dead and ever develops, could be useful in developing our RTP implementation</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle1">
					  <td><a href="http://sourceforge.net/projects/jmspeex" target="_blank">jmspeex</a></td>
					  <td>Speex codec plugin for the Java Media Framework (JMF) (encoder, decoder, packetizer, depacketizer).</td>
					  <td>Unknown</td>
					  <td>No files in CVS</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle0">
					  <td><a href="http://sourceforge.net/projects/jchatbox" target="_blank">jchatbox</a></td>
					  <td>A complete IM system similar to Yahoo or MSN with ful support of voice/video via JMF and almost all features which you can find in commerical IM systems. Features like friend list, users room, PM, conference, etc.</td>
					  <td>Unknown</td>
					  <td>No files in CVS</td>
					</tr>
						<tr class="jmfprojectsrow colortoggle1">
					  <td><a href="http://sourceforge.net/projects/jxtalk" target="_blank">jxtalk</a></td>
					  <td>To develop an instant voice and message application on JXTA network, a peer-to-peer platform, like Microsoft MSN. Using JMF to control audio from peer and transfering instant message, voice, even file by JXTA.</td>
					  <td>Unknown</td>
					  <td>Appears dead</td>
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
