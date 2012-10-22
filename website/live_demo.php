<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
	include 'include/globals.php';
	include 'include/metas.php'; 
?>

<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="styles/styles.css" />
<script type="text/javascript" language="JavaScript1.2" src="js/stmenu.js"></script>

<title>Live Demo - FMJ</title>
</head>
<body>
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
				<h1>Live FMJ Demo</h1>
				<p>
					The live demo only works with Java 5.0 and might be a bit slow to load. The playback, depending
					on your connection speed, could be choppy as there is no buffering of the media implemented yet.  
					Also, only pure java code is used here. So, none of the FFMPEG, GStreamer or DirectShow stuff is
					involved.
				</p>
				<p>
					<strong>Note :</strong> By default, if JMF is installed, then its own controls will load instead of FMJ's. 
					To be able to see FMJ's set of controls, uninstall JMF first and then try accessing this page again. 
				</p>
				<table align="center" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center" class="livedemo" >
						<iframe frameborder="0" scrolling="no" align="middle" width="340" height="300" src="http://fmj.larsontechnologies.com/applet.example/GenericPlayer.html" ></iframe>
					</td>
				</tr>
				</table>
				<p>&nbsp;</p>
				<p>
					The applet will play an Ogg file (Vorbis audio + Theora video) directly downloadable from <a href="http://fmj.larsontechnologies.com/samplemedia/Apollo_15_liftoff_from_inside_LM.ogg" title="Download original Ogg file">here</a>.
				</p>
				<p>Visit our <a href="screenshots.php" title="Go to FMJ's screenshots page">screenshots</a> page for more
				examples of FMJ in action.</p>
				
			</td>
			<td id="rightpanel" class="rightpanel">
				<?php
				include 'include/panel/panel_default.php'; 
				?>
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
