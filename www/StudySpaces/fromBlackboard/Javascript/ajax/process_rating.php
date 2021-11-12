<?php

 	$hostname = 'localhost';
	$database = 'RatingDB';
	$username = 'root';
	$password = 'cosc210';
	
// connect to database computer

	$connect = new mysqli($hostname, $username, $password, $database);
	if ($connect->connect_error) die("<p>Error connecting to database: " . $connect->connect_error . "</p>");
	$rating = $_POST['rating'];
	$comment = $_POST['comment'];
	$query = "INSERT INTO rating_table (rating, date_submitted, comment) VALUES('{$rating}', CURDATE(), '{$comment}')";

	if (!$connect->query($query)) die("<p>Error selecting to database: " . $connect->connect_error . "</p>");

	$query = "SELECT avg(rating), count(rating) FROM rating_table";
	$result = $connect->query($query);
	if (!$result) die("<p>Error selecting to database: " .$connect->connect_error . "</p>");
	$result->data_seek(0);
	$answer = $result->fetch_array(MYSQLI_NUM);
	$average = $answer[0];
	$total = $answer[1];

	echo "<strong> $rating</strong> <br> comment: <strong>$comment</strong>";
	echo "<br> average $average out of $total ratings";
?>
