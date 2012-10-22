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
<script language="javascript">

	$(document).ready(function(){
		$("table[@id~=nlibtable_]").hide();
	});

	
	function toggleNativeLibTable(id) {
		if( $("#nlibtable_"+id).attr('class')=='ishidden' ) {
			$("a[@id=nlibtoggle_"+id+"]").html("less");
			$("#nlibtable_"+id).fadeIn("normal", function() { 
												$("#nlibtable_"+id).attr('class', ''); 
												});
		}
		else {
			$("a[@id=nlibtoggle_"+id+"]").html("more");
			$("#nlibtable_"+id).fadeOut("normal", function() { 
												$("#nlibtable_"+id).attr('class', 'ishidden');  
												});
		}
	}
</script>
<title>Getting Started - FMJ</title>
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
				<h1>Getting Started with FMJ</h1>
				<p>
					Here you can find some good tips about FMJ and it's dependencies.
				</p>
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td style="height: auto; vertical-align: top;"><img src="../images/fmjgettingstarted.png" /></td>
					</tr>
				</table>
				<h3>FMJ from CVS and Release Bundles</h3>
				<p>
					There are several .sh/.bat applications included into FMJ release: 
				</p>
				<ul>
					<li>
						<strong>fmjstudio</strong> - lets you play media, and has dropdowns already
						for the sample media included with FMJ.  If you have a video camera
						installed on your system, you should be able to view it using the
						appropriate tool button.
					</li>
					<li>
						<strong>fmjplay</strong> - a no-frills player. Requires the media parameter as a 
						URL as a command-line argument. Files must begin with <strong>file://</strong> prefix.
					</li>
					<li>
						<strong>fmjtranscode</strong> - a command-line transcoding application.  Run it with no 
						arguments to get example usage.  
					</li>
					<li>
						<strong>fmjregistry</strong> - is similar to the JMFRegistry application.  It is <strong>not 
						necessary</strong> to run this application to view the samples. It is useful if
						you are using external codecs, etc., which need to be registered
						(e.g. JFFMPEG). In particular, FMJStudio can do dynamic capture
						device detection, so there is no need to do this in the registry.
					</li>
				</ul>
				<p>
					There is an example of how to use FMJ in an applet in <strong>applet.example</strong>. Please, read the comments in the HTML files.
				</p>
				<p>&nbsp;</p>
				
				<h3>Adding Native External Libraries</h3>
				<p>
					FMJ can take advantage of a number of native, dynamic libraries, if they 
					are present, and in your library path. Currently supported are : 
				</p>
				<ol>
					<li>
						<h4>FFMPEG</h4>
						<table width="100%" cellpadding="5" cellspacing="0">
							<tr>
								<td>
									<p>
										<strong>Note :</strong> mmx is disabled in this example, as it has caused problems in the past.
									</p>
									<p>
										<strong>Step 1 :</strong> Get FFMPEG sources from <a href="http://ffmpeg.mplayerhq.hu/" title="Go to FFMPEG main" target="_blank">http://ffmpeg.mplayerhq.hu/</a><br />
									</p>
									<p>
										
										<strong>Step 2 :</strong> Build / install FFMPEG :
									</p>

									<blockquote>
										./configure --disable-mmx --enable-shared<br /><br />
										make<br /><br />
										sudo make install
									</blockquote>
								</td>

							</tr>
						</table>		
					</li>
					<li>
						<h4>Ogg/Theora/Vorbis</h4>
						<table width="100%" cellpadding="5" cellspacing="0">
							<tr>
								<td>
									<p>
										<strong>Step 1 :</strong> Get Ogg, Vorbis and Theora sources from <a href="http://www.theora.org/" title="Visit Theora project page" target="_blank">http://www.theora.org/</a>. Check README file from your distribution bundle. 
										It contains versions of libraries used for a particular FMJ build. 
									</p>
									<p>
										<strong>Step 2 :</strong> Build / install the libraries by running the standard build 
										procedure :
									</p>
									<blockquote>
										./configure<br /><br />
										make<br /><br />
										sudo make install
									</blockquote>
								</td>

							</tr>
						</table>		
					</li>
					<li>
						<h4>GStreamer</h4>
						<table width="100%" cellpadding="5" cellspacing="0">
							<tr>
								<td>
									Please, follow the instructions found on <a href="http://gstreamer.freedesktop.org/" title="Visit GStreamer main project page" target="_blank">http://gstreamer.freedesktop.org/</a>.		
								</td>
							</tr>
						</table>
					</li>
				</ol>
				<p>&nbsp;</p>
				<p>
					In several *nix systems, sometimes have to set your library path explicitly. For example :
				</p>
				<blockquote>
					export LD_LIBRARY_PATH=/usr/local/lib
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
