<?php
function roll() {
	$faces = array(0, 1, 2, 3, 4, 5, 6);
	return $faces[rand(1,6)];
	}
	
// arrays are passed by value in PHP, if you want it to change use & before it
function rollAll(& $dice ){
	for ($index = 0; $index < count($dice); $index++ ){
		$dice[$index] = roll();
		}
	}
	
function display( $dice ){
	echo "Die    Value\n";
	echo "---    -----\n";
	for ($i = 0; $i < 5; $i++) {
		echo ($i+1)."    ".$dice[$i]."\n";
		}
	}
	
function frequency( $dice ) {
	$tally = array(0,0,0,0,0,0,0);
	foreach ($dice as $die) {
		$tally[$die] += 1;
		}
	return $tally;
	}
	
function fiveOfAKind( $dice ){
	$tally = frequency($dice);
	if (in_array(5, $tally)){
		return True;
		}
	else {
		return False;
		}
	}
	
function fourOfAKind($dice){
	$tally = frequency($dice);
	if (in_array(4, $tally)){
		return True;
		}
	else {
		return False;
		}
	}

function threeOfAKind($dice){
	$tally = frequency($dice);
	if (in_array(3, $tally)){
		return True;
		}
	else {
		return False;
		}
	}

function fullHouse($dice){
	$tally = frequency($dice);
	if (in_array(3, $tally) && in_array(2, $tally)){
		return True;
		}
	else {
		return False;
		}
	}

function twoPair($dice){
	$tally = frequency($dice);
	$count = 0;
	foreach( $tally as $t){
		if ( $t == 2 ){
			$count += 1;
			}
		}
	if ($count == 2) {
		return True;
		}
	else {
		return False;
		}
	}
	
function evaluate( $dice ) {
	if (fiveOfAKind($dice)) {
		echo "Five of a kind\n";
		}
	elseif (fourOfAKind($dice)) {
		echo "Four of a kind\n";
		}
	elseif (fullHouse($dice)) {
		echo "Full House\n";
		}
	elseif (threeOfAKind($dice)) {
		echo "Three of a kind\n";
		}
	elseif (twoPair($dice)) {
		echo "Two pair\n";
		}
	else {
		echo "nothing\n";
		}
	}

//main
	
$dice = array(0,0,0,0,0);
echo "roll 5 dice\n";
rollAll($dice);
display($dice);
evaluate($dice);
	
?>
