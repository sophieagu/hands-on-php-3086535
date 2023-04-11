<?php

function print_array($a) {
	echo '<pre>';
	var_dump( $a );
	echo '</pre>';
}

$dir = 'files';

$files = scandir($dir);
$extensions = array();

foreach( $files as $file ) {
	$ext = pathinfo($file, PATHINFO_EXTENSION);
	if ( ! empty( $ext ) ) {
		$extensions[$ext] = ($extentions[$ext] ?? 0) + 1;
	}
}

print_array( $extensions );

$dir = 'files';