<?php
$hostname = "localhost";
$username = "root";
$password = "cosc210";
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

$insert = sprintf("insert into locations (buildingid, description) " . 
	"values('%d','%s')", $bid, "Outside - Northside of building");
$result = $connect->query($insert);
if (!$result) die ($connect->error);
$newid = $connect->insert_id;
echo "The id of the newly inserted location is $newid\n";
?>
