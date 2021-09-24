<?php
$frequency = array();
echo "What is the name of the input file?";
$filename = trim(fgets(STDIN));
$file_handle = fopen($filename, 'r') or die("Cannot open $filename");
$text = fgets($file_handle);
while (!feof($file_handle)) {
	$words = preg_split('/\s+/',$text); //split line text into array of words
	foreach($words as $word){
		$chars = str_split($word);	//split word into array of letters
		foreach($chars as $ch){
			if (ctype_alpha($ch)){
				$ch = strtolower($ch);	//convert text to lowercase
				if(isset($frequency[$ch])) {
					$frequency[$ch] += 1;
					}
				else {
					$frequency[$ch] = 1;
					} // endif
				} // end if
			} // end foreach $chars
		} // end foreach $words
	$text = fgets($file_handle);
	} // end while
echo "Here are the letters and their frequencies\n";
asort($frequency); // sorts values in ascending order opposite is arsort()
foreach($frequency as $key => $value) {
	echo "$key      $value\n";
	}
echo "Here are the letters and their frequencies\n";
ksort($frequency); // sorts keys in ascending order opposite is krsort()
foreach($frequency as $key => $value) {
	echo "$key      $value\n";
	}

?>
