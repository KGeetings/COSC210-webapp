<?php
$wordcount = 0;
$vowelcount = 0;
$constcount = 0;
$vowels = array("a","e","i","o","u");
echo "Enter text. Press return to quit:";
$text = trim(fgets(STDIN));
while ( strlen($text) != 0){
	$text = strtolower($text);	//convert text to lowercase
	if (ctype_alpha($text)){
		$wordcount += 1;
		$chars = str_split($text);
		foreach($chars as $ch){
			if (in_array($ch,$vowels)){
				$vowelcount += 1;
				}
			else {
				$constcount += 1;
				}
			}
		}
	echo "Enter text. Press return to quit:";
	$text = trim(fgets(STDIN));
	}
$average_vowels = $vowelcount / $wordcount;
echo "The average number of vowels per word is $average_vowels\n";
$average_cons = $constcount / $wordcount;
echo "The average number of consonants per word is $average_cons\n";

?>
