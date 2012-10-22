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

<title>Demo - FMJ</title>
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
				<h1>This is H1</h1>
				<h2>This is H2</h2>
				<h3>This is H3</h3>
				<p>
					FMJ is an open-source project with the goal of providing a replacement/alternative to Java Media Framework (JMF),
					while remaining API-compatible with JMF. It aims to produce a single API/Framework which can be used to capture,
					playback, process, and stream media across multiple platforms.
				</p>
				<p>
					New team members are always welcome, this is a big project with lots to do.
				</p>
				<?php insertStretchText(400); //this is a "stretch" to support full width ?>
			</td>
			<td id="rightpanel" class="rightpanel">
				<?php
				include 'include/panel/panel_default.php'; 
				include 'include/panel/template.php'; 
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
