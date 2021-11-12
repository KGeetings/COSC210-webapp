<!DOCTYPE html>
<html>
<head>
<title>Display Json data</title>
<link href="css/main_3.css" rel="stylesheet">
</head>
</head>
<body>

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
	print "<tr>";
	$columns = $result->fetch_array(MYSQLI_ASSOC);
	$spacesarray[] = $columns;
}
echo json_encode($spacesarray);

?>
</body>
</htmL>
