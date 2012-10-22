<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'include/metas.php'; ?>
<?php include 'include/globals.php'; ?>

<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="styles/styles.css" />
<script type="text/javascript" language="JavaScript1.2" src="js/stmenu.js"></script>

<title>Home - FMJ</title>
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
				<h1>FMJ Project</h1>
				<p>
					<strong>FMJ is</strong> an open-source project with the goal of providing <strong>an alternative to Java Media Framework (JMF)</strong>,
					while remaining API-compatible with JMF. It aims to produce a single API/Framework which can be used to capture,
					playback, process, and stream media across multiple platforms.
				</p>
				<p>
					Since FMJ is API-compatible with latest JMF, you may use existing JMF codes and run them. However, several areas of 
					the project are 
					<a href="roadmap.php" title="View our current development status, roadmap and goals">under development</a>, and sometimes you may have to find workarounds, if your existing JMF codes do not work. At any time feel free
					to ask us questions on our 
					<a href="http://sourceforge.net/forum/forum.php?forum_id=546432" target="_blank" title="Get help for FMJ">help forum</a>. 
					You can also browse through our 
					<a href="fmj/getting_started.php" title="Getting started with FMJ">getting started</a>, 
					<a href="fmj/troubleshooting.php" title="Troubleshooting FMJ">troubleshooting</a> and 
					<a href="doc/fmj/index.html" title="FMJ's javadoc">javadoc</a> pages. This documentation will help you 
					undestand the difference and similarities between JMF and FMJ. 				
				</p>
				<p>
					FMJ also has two sub-projects and one sister project. The sub-projects, <a href="ffmpeg-java/getting_started.php" title="More information on FFMPEG-Java">FFMPEG-Java</a> and <a href="theora-java/getting_started.php" title="More information on Theora-Java">Theora-Java</a>, are Java wrappers for FFMPEG and Vorbis respectively. Our sister project is <a href="http://lti-civil.org" target="_blank" title="Visit LTI-CIVIL's website">LTI-CIVIL</a> and it is used as the primary video capture device library.
				</p>
				<p>
					FMJ can be <a href="downloads.php" title="Download FMJ">downloaded here</a> in <strong>ZIP or TAR</strong> bundles, or you can directly pull the latest source from <strong>CVS</strong>.
				</p>
				<p>
					You are always welcome to <a href="fmj/join_team.php" title="Join FMJ Team">join the team</a>, because this is a big project with lots to do!
				</p>
				<p>
					By the way, do not forget to check out <a href="screenshots.php" title="Screenshots of FMJ in action">screenshots</a> and <a href="live_demo.php" title="FMJ's showcase">live demo</a> sections!
				</p>
				
				<h2>License</h2>
				<p>
					<a href="http://www.gnu.org/licenses/lgpl.html" target="_blank" title="LGPL agreement">LGPL</a>
				</p>
				
				<h2>Default JRE</h2>
				<p>
					<a href="http://java.sun.com/javase/downloads/index_jdk5.jsp" target="_blank" title="JRE 5.0 download page">Java Runtime Environment 5.0</a> 
				</p>
				
				<h2>Supported Formats</h2>
				<p>
					Visit our <a href="fmj/supported_formats.php" title="Media formats supported by FMJ">supported media formats</a> page.		
				</p>
				
				<h2>Supported Platforms</h2>
				<p>
					<table border="0" cellpadding="5" cellspacing="0">
						
						<tr>
							<td align="center" style="width: 200px;"><strong>GNU/Linux 32/64-bit<br />Kernel 2.4+</strong></td>
							<td align="center" style="width: 200px;"><strong>Windows 2000/XP/Vista</strong></td>
							<td align="center" style="width: 200px;"><strong>Mac OS X</strong></td>
						</tr>
						
						<tr>
							<td align="center"><img src="images/linux.png" height="128" width="128" /></td>
							<td align="center"><img src="images/windows.png" height="128" width="128" /></td>
							<td align="center"><img src="images/macos.png" height="128" width="128" /></td>
						</tr>
					</table>
				</p>
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
