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

<title>JMF Examples - FMJ</title>
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
				<h1>JMF Sample Codes</h1>
				<p>&nbsp;</p>
				
				<table width="100%" border="0" cellpadding="5" cellspacing="0">
					<tr class="jmfexamplesheader">
						<td>Source</td>
						<td>Examples</td>
						<td>Comments</td>
				  	</tr>  
				  
					 <tr class="colortoggle0">
						<td>EJMF</td>
						<td>Multi-image viewer</td>
						<td>Works with FMJ</td>
					 </tr>
					 
					 <tr class="colortoggle1">
						<td>EJMF</td>
						<td>Ticker-tape viewer</td>
						<td>Works with FMJ</td>
					 </tr>
					 
					 <tr class="colortoggle0">
						<td>EJMF</td>
						<td>EjmfControlPlayer</td>
						<td>Works with FMJ</td>
					 </tr>
					 
					 <tr class="colortoggle1">
						<td><a href="http://java.sun.com/products/java-media/jmf/2.1.1/solutions/index.html">JMF 2.1.1 Solutions</a></td>
						<td><a href="http://java.sun.com/products/java-media/jmf/2.1.1/solutions/SwingJMF.html">SwingJMF</a></td>
						<td>Basic playback works with FMJ, but JMF needed for codecs. Auto-repeat does not work and playback bar is missing.</td>
					 </tr>
					 
					 <tr class="colortoggle0">
						<td><a href="http://java.sun.com/products/java-media/jmf/2.1.1/solutions/index.html">JMF 2.1.1 Solutions</a></td>
						<td><a href="http://java.sun.com/products/java-media/jmf/2.1.1/solutions/ScreenGrabber.html">ScreenGrabber<a></td>
						<td>Works with FMJ as well as any video source does.</td>
					 </tr>
					 
					 <tr class="colortoggle1">
						<td><a href="http://www.dutchie.net/jmf/onlineExamples.htm">jmfapi.org</a></td>
						<td><a href="http://www.dutchie.net/jmf/example/rle3/rle3.htm">rgb2rle3</a></td>
						<td>rgb2rle3 codec (Code complies, but nothing was tested further)</td>
					 </tr>
				  </table>
				  
				<!--
					//FORMAT : source, sample, comments
				  	//		   first CSV entry is a header
					$csv_file = '../'.$DATA_ROOT.'jmf.examples.csv';
					$handle = fopen($csv_file, "r");
					
					if(($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
						echo '<tr class="jmfexamplesheader">'.
								'<td>'.$data[0].'</td>'.
								'<td>'.$data[1].'</td>'.
								'<td>'.$data[2].'</td>'.
							  '</tr>';
					}
					
					$ct=0;
					while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
						echo '<tr class="colortoggle'.(($ct++) % 2).'">'.
								'<td>'.$data[0].'</td>'.
								'<td>'.$data[1].'</td>'.
								'<td>'.$data[2].'</td>'.
							 '</tr>';
					}
					fclose($handle);
				-->
				
				
				
				
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
