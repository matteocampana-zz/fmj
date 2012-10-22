<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'include/metas.php'; ?>
<?php include 'include/globals.php'; ?>

<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="styles/styles.css" />
<script type="text/javascript" language="JavaScript1.2" src="js/stmenu.js"></script>

<title>Downloads - FMJ</title>
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
			<td id="rightpanel" class="rightpanel">
				<?php include 'include/panel/panel_default.php'; ?>
			</td>
			<td id="maincontent" class="maincontent">
				<h1>Download FMJ</h1>
				<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<p>
							FMJ is available for download in <a href="http://sourceforge.net/project/showfiles.php?group_id=161490" target="_blank" title="Download FMJ">ZIP and TAR</a> bundles
							from SourceForge.net. You can also download previous releases from the same location. However, 
							we still recommend to use the latest version of FMJ.
						</p>
						<p>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://sourceforge.net/project/showfiles.php?group_id=161490" target="_blank" title="Download FMJ"><img src="images/downloadfmj128.png" width="128" height="128" /></a></p>
					</td>
					<td align="right" style="width: 400px;">
						<script type="text/javascript"><!--
						google_ad_client = "pub-3404523735448812";
						google_ad_width = 336;
						google_ad_height = 280;
						google_ad_format = "336x280_as";
						google_ad_type = "text_image";
						//2007-10-18: FMJ_JMFProjects
						google_ad_channel = "3286330128";
						google_color_border = "FFFFFF";
						google_color_bg = "FFFFFF";
						google_color_link = "215EA0";
						google_color_text = "232323";
						google_color_url = "000000";
						//-->
						</script>
						<script type="text/javascript"
						  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
						</script>
					</td>
				</tr>
				</table>
				
				<p>
					You can directly get the latest source from CVS :
				</p>
				<blockquote>
					# cvs -d:pserver:anonymous@fmj.cvs.sourceforge.net:/cvsroot/fmj login<br /><br />
					CVS password: <strong>&lt;Hit Enter&gt;</strong><br /><br />
					# cvs -z3 -d:pserver:anonymous@fmj.cvs.sourceforge.net:/cvsroot/fmj co -P fmj<br />
				</blockquote>
				
				<h2>Sample Media</h2>
				<p>
					Use <a href="fmj/media_library.php" title="Download sample media files for testing">media library</a> in order 
					to test your FMJ applications or FMJ Studio.
				</p>
				<p>&nbsp;</p>
				
				<h2>Download FFMPEG-Java</h2>
				<p>
					FFMPEG-Java is available for download in <a href="http://sourceforge.net/project/showfiles.php?group_id=161490" target="_blank" title="Download FFMPEG-Java">ZIP and TAR</a> bundles
					from SourceForge.net. Or directly get the latest source from CVS (FFMPEG-Java is <strong>not</strong> the same project as JFFMPEG) : 
				</p>
				<blockquote>
					# cvs -d:pserver:anonymous@fmj.cvs.sourceforge.net:/cvsroot/ffmpeg-java login<br /><br />
					CVS password: <strong>&lt;Hit Enter&gt;</strong><br /><br />
					# cvs -z3 -d:pserver:anonymous@fmj.cvs.sourceforge.net:/cvsroot/ffmpeg-java co -P ffmpeg-java<br />
				</blockquote>
				<p>&nbsp;</p>
				
				<h2>Download Theora-Java</h2>
				<p>
					Theora-Java is available for download in <a href="http://sourceforge.net/project/showfiles.php?group_id=161490" target="_blank" title="Download Theora-Java">ZIP and TAR</a> bundles
					from Sourceforge.net. Or directly get the latest source from CVS :
				</p>
				<blockquote>
					# cvs -d:pserver:anonymous@fmj.cvs.sourceforge.net:/cvsroot/theora-java login<br /><br />
					CVS password: <strong>&lt;Hit Enter&gt;</strong><br /><br />
					# cvs -z3 -d:pserver:anonymous@fmj.cvs.sourceforge.net:/cvsroot/theora-java co -P theora-java<br />
				</blockquote>
				<p>&nbsp;</p>
				
				<h2>Download LTI-CIVIL</h2>
				<p>
					LTI-CIVIL is a library capable of detecting available capture devices and returning
					a <strong>civil:</strong> datasource. Visit <a href="http://lti-civil.org/" target="_blank" title="Go to LTI-CIVIL's website">LTI-CIVIL's website</a> for more details and downloads.
				</p>
				<p>&nbsp;</p>
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
