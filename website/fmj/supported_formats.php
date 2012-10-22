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

<title>Supported Formats - FMJ</title>
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
				<h1>Supported Media Formats</h1>
				<p>
					Below find lists of media formats currently supported by FMJ.

				</p>
			
				<h3>Native wrapper playback only</h3>
				<table width="100%" border="0" cellpadding="5" cellspacing="0">
					<tr class="generalheader">
						<td>Wrapper for</td>          
						<td>OS</td>
						<td>Formats</td>
					</tr>
					<tr class="colortoggle0">
						<td>DirectShow</td>          
						<td>Windows</td>
						<td>Pretty much anything!</td>
					</tr>
					<tr class="colortoggle1">
						<td>Quicktime for Java</td>          
						<td>Mac OS X</td>
						<td>Pretty much anything!</td>
					</tr>
					<tr class="colortoggle0">
						<td>GStreamer</td>          
						<td>Any</td>
						<td>Pretty much anything!</td>
					</tr>
				</table>
				<p>&nbsp;</p>
				
	
				<h3>Native wrapper processing and playback</h3>
				<table width="100%" border="0" cellpadding="5" cellspacing="0">
					<tr class="generalheader">
						<td>Wrapper for</td>          
						<td>OS</td>
						<td>Formats</td>
					</tr>
					<tr class="colortoggle0">
						<td>FFMPEG</td>          
						<td>Any</td>
						<td>Pretty much anything!</td>
					</tr>
				</table>
				<p>&nbsp;</p>
				
				<h3>Pure Java processing and playback</h3>
				<table width="100%" border="0" cellpadding="5" cellspacing="0">
					<tr class="generalheader">
						<td>Container</td>         
						<td>Format</td>          
						<td>Decode (D), Encode (E)</td>
					</tr>
					<tr class="colortoggle0">
						<td>RTP</td>          
						<td>JPEG/RTP</td>
						<td>D,E</td>
					</tr>
					<tr class="colortoggle0">
						<td>&nbsp;</td>          
						<td>ULAW/RTP</td>
						<td>D,E</td>
					</tr>
					<tr class="colortoggle0">
						<td>&nbsp;</td>          
						<td>ALAW/RTP</td>
						<td>D,E</td>
					</tr>
					<tr class="colortoggle0">
						<td>&nbsp;</td>          
						<td>SPEEX/RTP</td>
						<td>D,E</td>
					</tr>
					<tr class="colortoggle0">
						<td>&nbsp;</td>          
						<td>ILBC/RTP</td>
						<td>D,E</td>
					</tr>
					
					<tr class="colortoggle1">
						<td>WAV</td>          
						<td>LINEAR (PCM)</td>
						<td>D,E</td>
					</tr>
					
					<tr class="colortoggle0">
						<td>AU</td>          
						<td>LINEAR (PCM)</td>
						<td>D,E</td>
					</tr>
					<tr class="colortoggle0">
						<td>&nbsp;</td>          
						<td>ULAW</td>
						<td>D,?</td>
					</tr>
					
					<tr class="colortoggle1">
						<td>AIFF</td>          
						<td>LINEAR (PCM)</td>
						<td>D,E</td>
					</tr>
					
					
					<tr class="colortoggle0">
						<td>multpart/x-mixed-replace</td>          
						<td>JPEG</td>
						<td>D,E</td>
					</tr>
					<tr class="colortoggle0">
						<td>&nbsp;</td>          
						<td>GIF</td>
						<td>D,E<strong>*</strong></td>
					</tr>
					<tr class="colortoggle0">
						<td>&nbsp;</td>          
						<td>PNG</td>
						<td>D,E</td>
					</tr>
					
					<tr class="colortoggle1">
						<td>Ogg</td>          
						<td>VORBIS</td>
						<td>D</td>
					</tr>
					<tr class="colortoggle1">
						<td>&nbsp;</td>          
						<td>THEORA</td>
						<td>D</td>
					</tr>
					
					<tr class="colortoggle0">
						<td>MP3</td>          
						<td>MP3</td>
						<td>D</td>
					</tr>
				</table>
				<p style="font-size:11px;"><strong>*</strong> - encoding only with Java 6+</p>
				<p>&nbsp;</p>
								
				<h3>Assorted pure Java codecs</h3>
				<ul>
					<li>Audio resampling</li>
					<li>Video scaling</li>
				</ul>
				<p>&nbsp;</p>
				
				
				<h3>Capture</h3>
				<table width="100%" border="0" cellpadding="5" cellspacing="0">
					<tr class="generalheader">
						<td>Type</td>          
						<td>Technology</td>
						<td>OS</td>
					</tr>
					
					<tr class="colortoggle0">
						<td>Audio</td>          
						<td>JavaSound</td>
						<td>All</td>
					</tr>
					
					<tr class="colortoggle1">
						<td>Video</td>          
						<td>LTI-CIVIL using DirectShow</td>
						<td>Windows</td>
					</tr>
					
					<tr class="colortoggle1">
						<td>&nbsp;</td>          
						<td>LTI-CIVIL using V4L2</td>
						<td>Linux</td>
					</tr>
					
					<tr class="colortoggle1">
						<td>&nbsp;</td>          
						<td>LTI-CIVIL using Quicktime for Java</td>
						<td>Mac OS X</td>
					</tr>
				</table>
				<p>&nbsp;</p>
				
				<p>
					<strong>Note :</strong> FMJ and JMF can use each others' plugins, assuming the classpath and
					registry is set appropriately.
				</p>
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
