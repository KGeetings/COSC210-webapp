<?php
$tableList = array("Desktop","Laptop","Printer");

	$hostname = 'db'; // normally it will be 'localhost' but docker has the container db
	$database = 'computer';
	$username = 'root';
	$password = 'password';
	$connect = new mysqli($hostname, $username, $password, $database);
	if ($connect->connect_error) die ($connect->connect_error);

print "Which table do you want?\n";
for ($i=0;$i< count($tableList); $i++) {
	echo $i.": ".$tableList[$i]."\n";
}
$index = (int) trim(fgets(STDIN));
print "What is the largest price amount? $";
$amount = trim(fgets(STDIN));
$query = "select model, price from $tableList[$index] where price <= $amount";

$result = $connect->query($query);
if (!$result) die ($connect->error);
$rows = $result->num_rows;
print $tableList[$index]." which cost at most \$$amount\n";
print "model     price\n";
for ($r = 0; $r < $rows; ++$r){
	$result->data_seek($r);
	$columns = $result->fetch_array(MYSQLI_NUM);
	print "$columns[0] and \$$columns[1]\n";
}

?>
