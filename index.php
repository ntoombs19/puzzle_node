<?php
	$dir    = '.';
	$files = array_diff(scandir($dir), array('..', '.', 'index.php'));

	echo "<p><a href='..'>< Back</a></p><p></p>";
	foreach($files as $file){
		echo "<a href='{$file}'>{$file}</a><br/>";
	}
?>