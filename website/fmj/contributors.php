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

<title>Contributors - FMJ</title>
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
				<h1>Contributors</h1>
  				<p>
					<strong>Note :</strong> not everyone who has contributed to FMJ project is included here.  If you 
					have been overlooked in this list, please, do not take it personally, and just let the 
					team know. We will gladly add you.
				</p>
				
				<p>
					Thanks to many people for submitting patches, bug reports, and feedback, which helped us improve the 
					quality of FMJ project.
				</p>
				
				<p>
					Thanks to all open-source projects, books, and examples from which source has been 
					borrowed/adapted, like SIP-Communicator and EJMF.
				</p>
				
				<table width="100%" border="0" cellpadding="5" cellspacing="0">
					<tr class="contributorsheader">
						<td style="width: 150px;">Name</td>
						<td style="width: 120px;">Location</td>
						<td style="width: 120px;">Role</td>
						<td>Project Area</td>
					</tr>
					
					<tr class="contributorsrow colortoggle0">
						<td><strong>Ken Larson</strong><br />(kenlars99)</td>
						<td>USA, Germany</td>
						<td>Project leader, Developer</td>
						<td>All</td>
					</tr>
					
					<tr class="contributorsrow colortoggle1">
						<td><strong>Warren Bloomer</strong><br />(stormboy)</td>
						<td>Australia</td>
						<td>Developer</td>
						<td>FMJ Studio, FMJ Registry, audio/video renderers</td>
					</tr>
					
					<tr class="contributorsrow colortoggle0">
						<td><strong>Andrew Rowley</strong><br />(zzalsar4)</td>
						<td>England</td>
						<td>Developer</td>
						<td>RTP</td>
					</tr>
					
					<tr class="contributorsrow colortoggle1">
						<td><strong>Christian Vincenot</strong><br />(sgt_sagara)</td>
						<td>Developer</td>
						<td>RTP</td>
						<td>France</td>
					</tr>
					
					<tr class="contributorsrow colortoggle0">
						<td><strong>Andrey Kuprianov</strong><br />(andreyvk)</td>
						<td>Russia, Thailand</td>
						<td>Web designer and administrator</td>
						<td>Web technologies</td>
					</tr>
					
					<tr class="contributorsrow colortoggle1">
						<td><strong>Stephan Goetter</strong><br />(turms)</td>
						<td>Unspecified</td>
						<td>Developer</td>
						<td>FFMPEG-Java</td>
					</tr>
					
					<tr class="contributorsrow colortoggle0">
						<td><strong>Jeremy Wood</strong></td>
						<td>Unspecified</td>
						<td>Developer</td>
						<td>JPEG encoding/decoding, buffer/image conversion, optimization</td>
					</tr>
					
					<tr class="contributorsrow colortoggle1">
						<td><strong>Damian Minkov</strong></td>
						<td>Bulgaria</td>
						<td>Developer (SIP-Communicator)</td>
						<td>SIP-Communicator RTP Codecs</td>
					</tr>
					
				</table>
				<p>&nbsp;</p>
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center" style="height: auto; vertical-align: top;"><img src="../images/contributors.png" /></td>
					</tr>
				</table>
				<p>&nbsp;</p>
			</td>
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
