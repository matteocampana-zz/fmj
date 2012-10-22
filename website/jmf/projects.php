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
	});
</script>

<title>JMF Projects - FMJ</title>
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
				<h1>Existing JMF Projects</h1>
				<p>We have sorted existing JMF projects into several categories listed below. Feel free to browse and look up whatever you may find interesting : 
				</p>
				
				<div id="numberedmenu"><!-- empty --></div>
				<p>&nbsp;</p>
				
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="right" style="height: auto; padding: 50px; vertical-align: top;"><img align="right" src="../images/webcameyes256.png" /></td>
					</tr>
					
					<?php 
						//this is a "stretch". dont remove until there's enough text to get the page stretched by itself
						insertStretchText(400);
					?>
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
