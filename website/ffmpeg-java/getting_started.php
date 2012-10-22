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

<title>Getting Started with FFMPEG-Java - FMJ</title>
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
				<h1>Getting Started with FFMPEG-Java</h1>
				<p>
					<strong>Note :</strong> FFMPEG-Java is not the same thing as Jffmpeg. FFMPEG-Java is a sub-project of 
					Freedom for Media in Java, FMJ in short.
				</p>
				
				<p>
					This project is licensed under the LGPL. It has optional GPL components for using FFMPEG's GPL swscale library.  
					If you wish to use swscale and the GPL, use ffmpeg-java-gpl.jar.  The standard LGPL jar for this project 
					is ffmpeg-java.jar.
				</p>
					
				<p>
					FFMPEG-Java is a Java wrapper around FFMPEG, using JNA. It assumes that dynamic libraries for FFMPEG have been compiled, and are in your library path. 
				</p>
				<p>
					<strong>Note :</strong> mmx is disabled in this example, as it has caused problems in the past.
				</p>

				<p>
					<strong>Step 1 :</strong> Get FFMPEG sources from <a href="http://ffmpeg.mplayerhq.hu" title="FFMPEG main site" target="_blank">http://ffmpeg.mplayerhq.hu</a>
				</p>
				<p>
					<strong>Step 2 :</strong> Build/install FFMPEG
				</p>

				<blockquote>
					./configure --disable-mmx --enable-shared<br /><br />
					make<br /><br />
					sudo make install
				</blockquote>
				<p>&nbsp;</p>
				
				<p>
					<strong>Step 3 :</strong> Run one of the sample programs with a media file as the first parameter.
				</p>

				<p>
					In several *nix systems, sometimes have to set your library path explicitly. For example :
				</p>
				<blockquote>
					export LD_LIBRARY_PATH=/usr/local/lib
				</blockquote>
				<p>&nbsp;</p>
		
				<h3>PlayerExample</h3>
				<p>
				 	Plays a movie in a window :
				</p>
				<blockquote>			
					java -cp ./ffmpeg-java.jar:./lib/jna.jar net.sf.ffmpeg_java.example.PlayerExample http://www.javasaver.com/testjs/jmf/anim/2005-11-26.mov
				</blockquote>
				<p>&nbsp;</p>
				
				<h3>AVCodecSample</h3> 
				<p>
					Creates 5 ppm files in the current directory with the first 5 frames of the movie :
				</p>
				<blockquote>			
					java -cp ./ffmpeg-java.jar:./lib/jna.jar net.sf.ffmpeg_java.example.AVCodecSample http://www.javasaver.com/testjs/jmf/anim/2005-11-26.mov
				</blockquote>
				<p>&nbsp;</p>
				
				<p>
					Very good documentation how to setup build environment - <strong>msys</strong> and <strong>mingw</strong> - and how to build FFMPEG on Windows can be found in <a href="http://arrozcru.no-ip.org/ffmpeg_wiki/tiki-index.php" target="_blank">here</a>. The FFMPEG builts provided there have worked too, but some image codecs/formats were missing.
				</p>
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
