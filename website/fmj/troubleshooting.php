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

<title>Troubleshooting - FMJ</title>
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
				<h1>Troubleshooting Tips</h1>
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td style="height: auto; vertical-align: top;"><img src="../images/troubleshooting.png" /></td>
					</tr>
				</table>
				<p>&nbsp;</p>
				
				<hr style="border: 1px solid #CCCCCC;" />
				<h3>FMJ and JMF classpath warnings</h3>
				<blockquote>
					Cannot find a DataSource for: civil ...<br />&nbsp;<br />
					
					WARNING: net.sf.fmj not found in PackageManager.getContentPrefixList() and PackageManager.getProtocolPrefixList(); 
					is JMF ahead of FMJ in the classpath? <br />&nbsp;<br />
					
					WARNING: javax.media.Manager is JMF's implementation, not FMJ's; is JMF ahead of FMJ in the classpath?
				</blockquote>
				
				<p>
					One very common problem is to have JMF ahead of FMJ in the classpath.  If this is the case, then 
					you will be using the JMF registry, in which case nothing from FMJ will be registered. The
					FMJ applications will generally work (that is, you'll be able to open and play media, etc.), but anything
					that requires FMJ will not work.  The FMJ apps will output a warning to the logger (which generally
					goes to the console) if this is the case.
				</p>
				<p>
					To aid with troubleshooting, it is recommended that you change your logging.properties (in the root
					directory of FMJ bundle) to use debug-level logging. To do so, change <strong>fmj.level=INFO</strong> to <strong>fmj.level=FINE</strong>.
				</p>
				<p>&nbsp;</p>
				<hr style="border: 1px solid #CCCCCC;" />
				
				<h3>java.lang.UnsatisfiedLinkError  (jdshow)</h3>
				<blockquote>
					WARNING: java.lang.UnsatisfiedLinkError: [...]\jdshow.dll: Can't find dependent libraries
				</blockquote>
				<p>
					<strong>jawt.dll</strong> probably is not in your PATH.  See platform-specific notes for Windows.
				</p>
				<p>&nbsp;</p>
				<hr style="border: 1px solid #CCCCCC;" />
				
				<h3>java.lang.UnsatisfiedLinkError (JNA)</h3>
				<p>
					<strong>Note :</strong> you will only get this error for the first JNA-based plugin that is loaded, 
					the other ones will fail with a different exception, which by default does not get logged.
				</p>
				<blockquote>
						java.lang.UnsatisfiedLinkError: /tmp/jna44845.so: /lib64/tls/libc.so.6: version `GLIBC_2.4' not 
						found (required by /tmp/jna44845.so)
				</blockquote>
 
 				<p>
					This is because JNA was built on a newer system than yours.  You'll have to build JNA from scratch.  
					We are currently using the <strong>jnalib-v3</strong> branch of JNA :
				</p>
				<blockquote>
					svn checkout https://jna.dev.java.net/svn/jna/branches/jnalib-v3 jna --username yourjavanetusername
				</blockquote>
				<p>&nbsp;</p>
				<hr style="border: 1px solid #CCCCCC;" />
				
				<h3>net.sf.jdshow.ComException on Windows</h3>
				<p>
					On Windows, when trying to play media : 
				</p>
				<blockquote>
					net.sf.jdshow.ComException: hr=-2146697203 
				</blockquote>
				<p>
					This is a <a href="http://support.microsoft.com/kb/234292" title="Get more information regarding this error" target="_blank">Windows error</a> pertaining to the URL or path specified.
				</p>
				<p>
					In particular, Windows is pickier than FMJ about slashes in the URL.  For example, the following URL does 
					not work with Windows (when DirectShow is being used for the playback): <strong>file:///F:\safexmas.mov</strong>. 
					However, if you remove one forward slash from the URL - <strong>file://F:\safexmas.mov</strong> - it will work, 
					assuming everything else is correct.
				</p>
				<p>&nbsp;</p>
				<hr style="border: 1px solid #CCCCCC;" />
				
				<h3>Problems with jdshow on Windows</h3>
				<p>
					To disable jdshow, you can either remove jdshow.dll from your library path, 
					or you can remove this code from <strong>RegistryDefaults.java</strong> :
				</p>
				<blockquote>
					contentPrefixList.add("net.sf.fmj.ds");
				</blockquote>
				<p>
					Or you can run the registry tool, remove <strong>net.sf.fmj.ds</strong> from the content prefix list, and then 
					run FMJ studio. This stores your registry settings in a file <strong>.fmj.registry.xml</strong>. 
					The danger of doing this is that this will now override any future changes to RegistryDefaults, 
					so you might want to delete that file, if RegistryDefaults is changed in CVS.
				</p>
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
