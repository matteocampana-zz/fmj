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

<title>Commercial JMF Projects - FMJ</title>
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
				<h1>Commercial Projects</h1>
				<div id="numberedmenu"><!-- empty --></div>
				<p>&nbsp;</p>
				
				<table width="100%" border="0" cellpadding="5" cellspacing="0">
					<tr class="jmfprojectsheader">
						<td width="10%">Name</td>
						<td width="40%">Description</td>
						<td width="10%">License</td>
						<td width="40%">Comments</td>
				  	</tr>  

					<tr  class="jmfprojectsrow colortoggle0">
					  <td><a href="http://www.humatic.de/htools/dsj.htm" target="_blank">dsj - DirectShow &lt;&gt; Java wrapper</a></td>
					  <td>dsj is an ongoing project to provide a java wrapper around Microsoft's DirectShow API. It offers a set of high level classes that give java easy access to functionality widely missed by java programmers and also lets you dive deeper into the interiors of Windows' core api for 2D media. On the java side dsj tries to keep things open as possible - you may use it standalone or let it feed data into JMF or other APIs.</td>
					  <td>Commercial</td>
					  <td>None</td>
					</tr>
					
					<tr class="jmfprojectsrow colortoggle1">
					  <td><a href="http://www.alphaworks.ibm.com/tech/mpeg-4" target="_blank">IBM MPEG-4 Video for JMF</a></td>
					  <td>A plug-in that enables decoding of MPEG-4 video in Java and that can be used on any JMF-enabled platform.</td>
					  <td>Commercial</td>
					  <td>This only contains a codec, and no demultiplexer. So the MPEG-4 movie can't be in an MPEG-4 file, it has to be in another container format, AVI for example. This codec relies on an internal IBM JMF class, com.ibm.media. codec.video.VideoCodec, which was updated in FMJ to ensure compatibility. <br /> Still trying to find a suitable test media file.</td>
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
