<?php
$tableList = array();

$hostname = "localhost";
$username = "root";
$password = "cosc210";
$database = "computer";
$connect = new mysqli($hostname, $username, $password, $database); 
if ($connect -> connect_error) die ($connect -> connect_error);

$query = "select table_name from information_schema.tables ".
	"where table_schema = 'computer' ".
	"and table_type = 'BASE TABLE'";
$result = $connect->query($query);
if (!$result) die ($connect->error);
$rows = $result->num_rows;
for ($r = 0; $r < $rows; ++$r){
	$result->data_seek($r);
	$columns = $result->fetch_array(MYSQLI_NUM);
	$tableList[] = $columns[0];
}

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
