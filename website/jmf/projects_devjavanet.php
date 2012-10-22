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

<title>dev.java.net JMF Projects - FMJ</title>
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
				<h1>Projects from dev.java.net</h1>
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
					  <td><a href="https://jmds.dev.java.net/" target="_blank">jmds</a></td>
					  <td>JMDS provides a Java wrapper around Microsoft's DirectShow Capture API's and exposes them as a Java Media Framework DataSource.</td>
					  <td>LGPL</td>
					  <td>Running the example program with my Quickcam Pro 4000 eventually gets an exception under JMF. However the output is exactly the same under FMJ, so it is probably working as expected. Needed internal class com.sun.media. vfw.BitMapInfo to be implemented, this is done. <br /> This seems like it could be a useful beginning of a DirectShow implementation for capture devices and/or codecs. <br /> According to the owner of the project, he hasn't worked on it in a couple of years because JMF was basically abandoned by Sun. </td>
					</tr>
					<tr class="jmfprojectsrow colortoggle1">
					  <td><a href="https://media4j.dev.java.net/" target="_blank">media4j</a></td>
					  <td>Media4j aims to make life easier to java programmers who want to include media features in their applications. It is a framework built on top of the Java Media Framework (JMF) for simplifying its use. </td>
					  <td>BSD</td>
					  <td>Compiles, Media4jPlayer works as well as any other media player works with FMJ (which is not completely, and requires FMJ demux/codec). Need to test other applications (Media4jWebcam, Media4jAudioChat)</td>
					</tr>
					<tr class="jmfprojectsrow colortoggle0">
					   <td><a href="https://sip-communicator.dev.java.net/" target="_blank">sip-communicator</a></td>
					   <td>JMF and JAIN-SIP 1.2 API VoIP application.</td>
					   <td>Apache</td>
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
