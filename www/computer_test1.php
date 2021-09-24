
<?php
	$hostname = 'db';
	$database = 'computer';
	$username = 'root';
	$password = 'password';

	$connect = new mysqli($hostname, $username, $password, $database);
	if ($connect->connect_error) die ($connect->connect_error);
	print "The average price of laptops is $";
	$query = "SELECT avg(price) name FROM Laptop";
	$result = $connect->query($query);
	if (!$result) die ($connect->error);
	$rows = $result->num_rows;
	for ($j = 0; $j < $rows; ++$j )
	{
		$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_NUM);
		print "$row[0]";
	}
	echo "\n";
?>
