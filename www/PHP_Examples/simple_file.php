<?php
	$filename = "data.txt";
	$file_handle = fopen($filename, 'r') or die("Cannot open $filename");
	$text = fgets($file_handle);
	while (!feof($file_handle)) {
		echo $text;
		$text = fgets($file_handle);
		}
	echo "The last line is--> $text\n";
	fclose($file_handle);	
?>