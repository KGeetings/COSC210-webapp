<?php
$table = "spaces";

$hostname = "localhost";
$username = "root";
$password = "Fall2019";
$database = "StudySpaces";
$connect = new mysqli($hostname, $username, $password, $database); 
if ($connect -> connect_error) die ($connect -> connect_error);



// get Desktop data
$query = "select * from $table";
$result = $connect->query($query);
if (!$result) die ($connect->error);
$spacesarray=array();
$rows = $result->num_rows;
for ($r = 0; $r < $rows; ++$r){
	$result->data_seek($r);
	$columns = $result->fetch_array(MYSQLI_ASSOC);
	$spacesarray[] = $columns;
}
$json = json_encode($spacesarray);
echo $json;

?>

