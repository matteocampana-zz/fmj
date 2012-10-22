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

<title>Miscellaneous JMF Projects - FMJ</title>
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
				<h1>Miscellaneous Projects</h1>
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
					  <td><a href="http://tritonus.org/" target="_blank">tritonus</a></td>
					  <td>Tritonus is an implementation of the Java Sound API.</td>
					  <td>LGPL</td>
					  <td>Provides javasound SPI plugins for MP3, OGG, with both encoding/decoding, sample rate converters, more. See <a href="http://tritonus.org/plugins.html" target="_blank">plugins page</a> for a full list. Does not use JMF, but could be used by FMJ to add support for several audio formats.<br />FMJ uses this for MP3/OGG, via javazoom/javalayer. </td>
					</tr>
					<tr class="jmfprojectsrow colortoggle1">
					  <td><a href="http://www.x-smiles.org/" target="_blank">XSmiles</a></td>
					  <td>X-Smiles is a Java based XML browser. It is intended for both desktop use and embedded network devices and to support multimedia services.</td>
					  <td>Apache-style</td>
					  <td>Uses JMF for SIP Videoconferencing. Also video, and sound, requires JMF. Related <a href="http://sinex.tml.hut.fi/cgi-bin/viewcvs.cgi/xsmiles-jmfxine/README?rev=1.3" target="_blank">link</a>.<br />Appears to require com.sun.media. util.Resource to compile, but this import is not actually used. So with the import removed, xsmiles compiles with FMJ. </td>
					</tr>
					<tr class="jmfprojectsrow colortoggle0">
					  <td><a href="http://www.openoffice.org/" target="_blank">OpenOffice.org</a></td>
					  <td>OpenOffice.org is a multiplatform and multilingual office suite and an open-source project. Compatible with all other major office suites, the product is free to download, use, and distribute.</td>
					  <td>LGPL</td>
					  <td>Supposedly uses JMF for multimedia content in presentations. Related <a href="https://bugzilla.redhat.com/bugzilla/show_bug.cgi?id=161474" target="_blank">link</a>.</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle1">
					  <td><a href="http://www.mjsip.org/index.php?option=com_content&amp;task=view&amp;id=37&amp;Itemid=52" target="_blank">mjsip</a></td>
					  <td>MjSip is a complete java-based implementation of a SIP stack</td>
					  <td>Unknown</td>
					  <td>The MjUA is the part that appears to use JMF. See <a href="http://www.mjsip.org/index.php?option=com_content&amp;task=view&amp;id=37&amp;Itemid=52">more details</a>.</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle0">
					  <td><a href="http://www.kaffe.org/" target="_blank">kaffe</a></td>
					  <td>Kaffe is a clean room implementation of the Java virtual machine, plus the associated class libraries needed to provide a Java runtime environment.</td>
					  <td>GPL</td>
					  <td>Would be nice to ensure that FMJ is compatible.</td>
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
					  <td><a href="http://www.kisekaeworld.com/" target="_blank">UltraKiss</a></td>
					  <td>UltraKiss is a computer program that implements the Kisekae Set system, KiSS, a Japanese graphics system originally developed to facilitate costume changes on virtual dolls, or anime characters. </td>
					  <td>GPL</td>
					  <td>None</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle1">
					  <td><a href="http://fred.vcode.org/" target="_blank">FRED</a></td>
					  <td>FRED stands for Fast Renka movEment Detection. It is a micro system for movement detection and tracing written in Java. FRED uses Java Media Framework to communicate with webcam, which is his eye :). Java Native Interface is used for dialog with electronics responsible for moving the whole construction to   track do movement.</td>
					  <td>Unknown</td>
					  <td>None</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle0">
					  <td><a href="http://www.hitsquad.com/smm/programs/Sonogram_visible_linux/" target="_blank">Sonogram Visible Speech</a></td>
					  <td>Sonogram is a in many forms configurable sound analysis tool. It analyses sound and speech signals with the methods of the &quot;Fourier Tranformation&quot; (FFT), &quot;Linear Prediction Analyse&quot; (LPC), &quot;Cepstrum Analyse&quot; and the &quot;Wavelet transformation&quot;.</td>
					  <td>Unknown</td>
					  <td>None</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle1">
					  <td><a href="http://www.physci.org/sound/index.html" target="_blank">AudioTrace</a></td>
					  <td>Oscilloscope style sound trace application.</td>
					  <td>LGPL (source), MIT (binary)</td>
					  <td>Audio Trace shows an oscilloscope or lissajous style trace of the sounds currently playing through your computer. A variety of scroll, zoom and fade effects can be applied to the trace for visual interest.</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle0">
					  <td><a href="http://developer.berlios.de/projects/panicplayer/" target="_blank">panicplayer</a></td>
					  <td>OS independent audio player that uses JMF. The Panic Player should support a multitude of input and output formats. The input stream may be manipulated with   additional sample files.</td>
					  <td>Academic Free License (AFL)</td>
					  <td>None</td>
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
