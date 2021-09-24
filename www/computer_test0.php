
<?php
	$hostname = 'db';
	$database = 'mysql';
	$username = 'root';
	$password = 'password';

	$connect = new mysqli($hostname, $username, $password, $database);
	if ($connect->connect_error) die ($connect->connect_error);
	echo "Connection made\n";
?>
