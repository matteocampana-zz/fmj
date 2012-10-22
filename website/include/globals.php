<?php

//root folder for this website
$WEB_ROOT = 					  '/';

//some main sub-folders of this website
$DATA_ROOT = 					  'data/';

$IMAGES_ROOT = 					  'images/';
$SCREENSHOTS_ROOT = $IMAGES_ROOT. 'screenshots/';

//Last updated text date at the footer
$LAST_UPDATED = 'Oct, 2007';

function insertStretchText($times) {

	for($i=0; $i<$times; $i++) {
		echo "&nbsp; ";
	}
}

?>
