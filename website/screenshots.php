<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'include/metas.php'; ?>
<?php include 'include/globals.php'; ?>

<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="styles/styles.css" />
<script type="text/javascript" language="JavaScript1.2" src="js/stmenu.js"></script>

<title>Screenshots - FMJ</title>
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
				<h1>FMJ Screenshots</h1>
				<p>Screenshots of FMJ working on different platforms and different processor architectures are given below. Please,
				also visit out <a href="live_demo.php" title="Take a look at our Live Demo">live demo</a> page!</p>
				<?php

				$dirsmall = $SCREENSHOTS_ROOT.'small/';
				$dirlarge = $SCREENSHOTS_ROOT.'large/';
				
				$dh  = opendir($dirsmall);
				while (false !== ($filename = readdir($dh))) {
					if(strcmp($filename, ".") != 0 && strcmp($filename, "..") != 0) {
						$files[] = $filename;
					}
				}
				closedir($dh);
				
				$csv = array();	
				$handle = fopen($DATA_ROOT."screenshots.csv", "r");
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					$num = count($data);
					if($num == 2) {
						$csv[$data[0]] = $data[1];
					}
				}
				fclose($handle);
				
				echo '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="40">';
				$cnt = count($files);
				if($cnt == 0) {
					echo '<tr><td>No screenshots are available at the moment</td></tr>';
				}
				else {
					sort($files);
					
					echo '<tr>';
					for($i=0; $i<$cnt; $i++) {
						if($i!=0 && $i%3==0) {
							echo '</tr><tr>';
						}
						
						//getPage(\'./ajax_screenshot.php?fn='.$files[$i].'\', \'div_largess\');
						
						echo '<td width="33%" align="center" class="screenshot">'.
							 '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">'.
							 '<tr><td align="center" height="140">'.
							 	'<a href="'.$dirlarge.$files[$i].'" >'.
									'<img id="'.$files[$i].'" src="'.$dirsmall.$files[$i].'" width="150" height="120" />'.
								'</a>'.
								'<br />&raquo;&nbsp;'.
									'<a href="'.$dirlarge.$files[$i].'" >Click to enlarge</a>'.
								'&nbsp;&laquo;'.
							 '</td></tr>'.
							 '<tr><td height="80">'.
								'<div align="center">'.$csv[$files[$i]].'</div>'.
							 '</td></tr>'.
							 '</table>'.
							 '</td>'.
							 "\n";
					}
					echo '</tr>';
				}
				echo '</table>';
			
			?>
		  	<p>Several movies used for screenshot production courtesy of <a href="http://www.athompson.info/andrew/resume/projects.jsp" target="_blank">Andrew Thompson</a></p>
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
