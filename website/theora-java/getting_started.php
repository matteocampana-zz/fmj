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

<title>Getting Started with Theora-Java - FMJ</title>
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
				<h1>Getting Started with Theora-Java</h1>
				<p>
					Theora-Java contains 2 approaches to using theora in Java :
				</p>
				<ol>
					<li><strong>theora-jna :</strong> using JNA to call the native libraries or</li>
					<li><strong>Patched version of jheora </strong> and a <strong>sample program</strong> to use jheora, jogg, and jorbis.</li>
				</ol>
				<p>&nbsp;</p>
				
				<h3>theora-jna</h3>
				
				<p>
					theora-jna is a Java wrapper around theora, using JNA. It assumes that dynamic libraries for ogg, vorbis, and theora have been compiled, and are in your library path. It does not require jheora, jogg, or jorbis to be in your classpath.
				</p>
					
					
				<p>
					<strong>Step 1 : </strong> Get Ogg, Vorbis and Theora sources from <a href="http://www.theora.org/" title="Go to Theora main page" target="_blank">http://www.theora.org/</a>
				</p>
				<p>
					This library was built/tested with :
					<ul>
						<li><strong>libtheora-1.0alpha7</strong></li>
						<li><strong>libogg-1.1.3</strong></li>
						<li><strong>libvorbis-1.1.2</strong></li>
					</ul>
				</p>
				<p>&nbsp;</p>
				
				<p>
					<strong>Step 2 : </strong> Build/install by running the standard build procedure in each of the 3 directories :
				</p>
				<blockquote>
					./configure<br /><br />
					make<br /><br />
					sudo make install
				</blockquote>
				<p>&nbsp;</p>
				
				<p>
					<strong>Step 3 : </strong>Run the sample program with a URL to a media file (<strong>file://</strong>, <strong>http://</strong>, etc.) as the first parameter, example :
				</p>
				<blockquote>
					java -cp ./theora-java.jar:./lib/jna.jar net.sf.theora_java.jna.example.PlayerExample <br />
					http://upload.wikimedia.org/wikipedia/commons/d/d0/Apollo_15_liftoff_from_inside_LM.ogg
				</blockquote>
				<p>&nbsp;</p>
				
				<p>
					This should show the video and/or play the audio. You may also need to set your library path in order to find the installed theora dynamic libraries, for example :
				</p>
				<blockquote>
					export LD_LIBRARY_PATH=/usr/local/lib
				</blockquote>
				<p>&nbsp;</p>
					
				<h3>jheora (patched)</h3>
				<p>
					jheora is part of the Cortado streaming applet available from <a href="http://www.flumotion.net/cortado/" target="_blank">here</a>. And while the Cortado applet is GPL, jheora is LGPL.
					Fluomotion does not distribute a jheora jar, so the sources are included in theora-java. Additionally, 
					a few minor changes have been made to make private structure members public, to make the functionality
					closer to what theora-jna has.
				</p>
				<p>
					jheora is dependent on jogg and jorbis from jcraft, available from <a href="http://www.jcraft.com/jorbis/" target="_blank">here</a>. The sources and jars are included here as a convenience.
				</p>
				<p>
					The same <strong>PlayerExample</strong> used for theora-jna has been modified to work with jheora. It takes a URL
					as a parameter. To run it:
				</p>
				<blockquote>
					java -cp ./theora-java.jar:./lib/jheora-patch.jar:./lib/jogg-0.0.7.jar:./lib/jorbis-0.0.15.jar<br /> 
					net.sf.theora_java.jheora.example.PlayerExample<br /> 
					http://upload.wikimedia.org/wikipedia/commons/d/d0/Apollo_15_liftoff_from_inside_LM.ogg
				</blockquote>
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
