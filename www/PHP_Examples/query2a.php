<?php //query.php
	$hostname = 'db'; // normally it will be 'localhost' but docker has the container db
	$database = 'computer';
	$username = 'root';
	$password = 'password';
	$connect = new mysqli($hostname, $username, $password, $database);
	if ($connect->connect_error) die ($connect->connect_error);

print "Which table do you want?";
$table = trim(fgets(STDIN));
$query = "select model, price from $table";
$result = $connect->query($query);
if (!$result) die ($connect->error);
$rows = $result->num_rows;
print "model  price\n";
for ($r = 0; $r < $rows; ++$r){
	$result->data_seek($r);
	$columns = $result->fetch_array(MYSQLI_ASSOC);
	print "$columns[model] and $columns[price]\n";
}

?>
