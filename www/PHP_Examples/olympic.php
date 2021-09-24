<?php

echo "Please enter a score (1-10):";
$score = trim(fgets(STDIN));
$high = $score;
$low = $score;
$total = $score;
for ($r = 0; $r < 8; ++$r){
	echo "Please enter a score (1-10):";
	$score = trim(fgets(STDIN));
	while ($score < 1 || $score > 10) {
		echo "Scores must be from 1 thru 10\n";
		echo "Please enter a score (1-10):";
		$score = trim(fgets(STDIN));
		}
	if ($score > $high) {
		$high = $score;
		}
	if ($score < $low) {
		$low = $score;
		}
	$total += $score;
	}
$ave = ($total - $high - $low) / 7;
$distro = ($high - $low);
echo "The average score is $ave\n";
echo "The range of values is $distro from a high of $high to a low of $low\n";

?>
