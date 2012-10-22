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

<title>Links &amp; Discussions - FMJ</title>
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
				<h1>Links and Discussions</h1>
				<p>
					Find below some links and discussions that might be useful to you. If you have more to contribute here, please, dont hesitate to contact us and let us know!
				</p>
				
				<!-- LINKS SECTION -->
				<table width="100%" cellpadding="5" cellspacing="0" style="text-align: justify;" >
					<tr><td class="generalheader">Various Useful Links</td></tr>
					<tr><td class="colortoggle0"><a href="http://java.sun.com/products/java-media/jmf/" target="_blank">JMF (Sun)</a> </td></tr>
					<tr><td class="colortoggle1"><a href="http://java.sun.com/products/java-media/jmf/2.1.1/apidocs/overview-tree.html" target="_blank">JMF Javadoc</a> </td></tr>
					<tr><td class="colortoggle0"><a href="http://archives.java.sun.com/archives/jmf-interest.html" target="_blank">JMF-Interest</a> the official discussion list</td></tr>
					<tr><td class="colortoggle1"><a href="http://code.google.com/p/gstreamer-java/" target="_blank">GStreamer-Java</a> </td></tr>
					<tr><td class="colortoggle0"><a href="https://jna.dev.java.net/" target="_blank">Java Native Access (JNA)</a> </td></tr>
					<tr><td class="colortoggle1"><a href="http://www.amazon.com/gp/product/0130801046/102-3725613-9540927?v=glance&amp;n=283155" target="_blank">Essential JMF (EJMF)</a> book on Amazon</td></tr>
					<tr><td class="colortoggle0"><a href="ftp://ftp.prenhall.com/pub/ptr/professional_computer_science.w-022/gordon/essential_jmf/" target="_blank">EJMF code</a> Note: I've checked with the author/publisher, and it is OK for to use this code in an open source project, as long as attribution is given. </td></tr>
					<tr><td class="colortoggle1"><a href="http://www.jmfapi.org/" target="_blank">www.jmfapi.org</a> useful JMF information</td></tr>
					<tr><td class="colortoggle0"><a href="http://www.javasaver.com/testjs/jmf/#media" target="_blank">Useful sample media</a> </td></tr>
					<tr><td class="colortoggle1"><a href="http://www.flumotion.net/cortado/" target="_blank">Fluomotion</a> cortado streaming applet for Ogg formats</td></tr>
					<tr><td class="colortoggle0"><a href="http://www.humatic.de/htools/dsj.htm" target="_blank">DSJ</a> DirectShow <> Java wrapper</td></tr>
					<tr><td class="colortoggle1"><a href="http://jffmpeg.sourceforge.net/" target="_blank">Jffmpeg</a> allows FFMPEG to be used with JMF. Note: we have our own ffmpeg wrapper under development: ffmpeg-java. </td></tr>
					<tr><td class="colortoggle0"><a href="http://fobs.sourceforge.net/" target="_blank">FOBS</a> - Fobs4JMF allows FFMPEG to be used with JMF. Note: we have our own ffmpeg wrapper under development: ffmpeg-java.</td></tr>
					<tr><td class="colortoggle1"><a href="http://www.gnu.org/software/classpath/" target="_blank">GNU Classpath</a> </td></tr>
					<tr><td class="colortoggle0"><a href="http://www.alphaworks.ibm.com/tech/mpeg-4" target="_blank">IBM MPEG-4 JMF Plug-in</a> </td></tr>
				
				</table>
				<p>&nbsp;</p>
				
				<!-- DISCUSSIONS SECTION -->
				<table width="100%" cellpadding="5" cellspacing="0" style="text-align: justify;" >
					<tr><td class="generalheader">Discussions</td>
					<tr><td class="colortoggle0">
					<a href="http://weblogs.java.net/blog/chet/archive/2007/05/media_frenzy.html" target="_blank">Java Media Components</a> (by Chet Haase)
					</td></tr>
					<tr><td class="colortoggle1"><a href="http://weblogs.java.net/blog/invalidname/archive/2005/04/java_media_with.html" target="_blank">Java Media without Mediocrity</a> (by Chris Adamson) 
					</td></tr>
					<tr><td class="colortoggle0"><a href="http://www.oreillynet.com/onjava/blog/2007/05/java_se_media_or_not_at_javaon.html" target="_blank">Java SE Media (Or Not) at JavaOne</a> (by Chris Adamson)
					</td></tr>
				
				</table>
				<?php 
					//this is a "stretch". dont remove until there's enough text to get the page stretched by itself
					insertStretchText(400);
				?>
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
