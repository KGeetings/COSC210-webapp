<?php
$hostname = "db";
$username = "root";
$password = "password";
$database = "StudySpaces";
$connect = new mysqli($hostname, $username, $password, $database); 
if ($connect -> connect_error) die ($connect -> connect_error);
$id = array();
$query = "select name, id from buildings";
$result = $connect->query($query);
if (!$result) die ($connect->error);
$rows = $result->num_rows;
print "Building\n";
for ($r = 0; $r < $rows; ++$r){
	$result->data_seek($r);
	$columns = $result->fetch_array(MYSQLI_NUM);
	print "$r  $columns[0]\n";
	array_push($id, $columns[1]);
}
print "Which building do you want? (Use number)";
$table = trim(fgets(STDIN));
$bid = $id[ $table ];
print "The building id is $bid\n";

$query = "select avg(noise) from spaces where building_id " . 
	"= $bid and seating > 5";
?>
