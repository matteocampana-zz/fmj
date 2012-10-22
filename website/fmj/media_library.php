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

<title>Media Library - FMJ</title>
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
				<h1>Media Library</h1>
				
				<p>
					All the media library content provided on this web-page courtesy <a href="http://www.mplayerhq.hu" title="Visit MPlayer website">MPlayer</a>. Feel free to download files and try them with FMJ Studio. 
				</p>
				<p>
					In order for FMJ Studio to play them, most of these media files will require one of the following to be 
					installed: <a href="getting_started.php" title="Hot to install FFMPEG">FFMPEG</a>, <a href="getting_started.php" title="Hot to install GStreamer">GStreamer</a>, DirectShow (Windows), Quicktime (Mac OS X).
				</p>
				<p>
					Use <strong>right-click</strong> to download files.
				</p>
				<table align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<iframe class="medialibrary" frameborder="0" width="650" scrolling="yes" src="http://samples.mplayerhq.hu"></iframe>
					</td>
				</tr>
				</table>
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
