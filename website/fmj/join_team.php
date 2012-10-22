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

<title>Join Development Team - FMJ</title>
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
				<h1>Joining FMJ Development Team</h1>
  				<p>
					If you would like to contribute or better join FMJ development team, please, follow the general steps below.
					We are welcoming anyone who can help make FMJ a better project!
				</p>
				<p>
					Before you start, please, carefully review our <a href="engineering.php" title="View our engineering terms">engineering terms</a>.
				</p>
				<ol>
					<li>Download the FMJ release, play around with FMJ Studio and FMJ Registry.</li>
					<li>Get a SourceForge.net <a href="http://sourceforge.net/account/newuser_emailverify.php" title="Subscribe to SourceForge.net" target="_blank">user account</a>.</li>
					<li>Get the FMJ source code from <a href="../downloads.php" title="How to get FMJ code from CVS">CVS</a>.</li>
					<li>Subscribe to the <a href="http://sourceforge.net/mailarchive/forum.php?forum_name=fmj-devel" title="Go to fmj-devel mailing list page" target="_blank">fmj-devel</a> mailing list.</li>
					<li>Review some of the documents and links on the FMJ website, particularly those pertaining to <a href="../roadmap.php" title="Go to roadmap and status page">roadmap and status</a>.</li>
					<li>
						Do you have a particular project that you would like to get working with FMJ, or particular goals to achieve?  
					  	This is a good place to start.  See if it works with FMJ (without JMF), and perhaps report your findings to 
					  	the <a href="http://sourceforge.net/mailarchive/forum.php?forum_name=fmj-devel" title="Go to fmj-devel mailing list page" target="_blank">fmj-devel</a> mailing list, and the team will likely have ideas on where to start.
				    </li>
					<li>
						Do you have any particular area of interest or expertise? This is also very relevant, as there are many 
  						different tasks to be done, all the way from native library wrapping, porting codecs from C, to GUI work, 
						testing, optimization and improvement across the board.  For example, are you interested in playback, 
						transcoding, streaming, applets, RTP, live audio and video capture?  Do you have experience with image 
						rendering, javasound, general Java architecture and design, media formats, FFMPEG, DirectShow, 
						Quicktime, GStreamer, Theora, native coding, JNI, JNA, etc, etc, etc... 
						Please don't be intimidated by the long list of complicated technologies that FMJ integrates with,
						nobody on the team is an expert in all of these. There is an optimal niche for everyone, regardless of 
						breadth and depth of experience. And even without any particular multimedia experience, there are 
						interesting tasks to be done.
					</li>
				</ol>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center" style="height: auto; vertical-align: top;"><img src="../images/worldmap.png" /></td>
					</tr>
				</table>
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
