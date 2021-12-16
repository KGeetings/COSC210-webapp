<!DOCTYPE html>
<html>
<head>
<title>Display the Computer Table Data</title>
</head>
<body>
<p>The table passed was
<?php
$table = $_POST['table'];


$hostname = "localhost";
$username = "root";
$password = "Fall2019";
$database = "computer";
$connect = new mysqli($hostname, $username, $password, $database); 
if ($connect -> connect_error) die ($connect -> connect_error);

// get metadata about the database
$query = "select column_name from information_schema.columns ".
	"where table_schema = 'computer' and table_name='$table'";
$result = $connect->query($query);
if (!$result) die ($connect->error);
$rows = $result->num_rows;
echo "<h1>Data from the $table table</h1>\n";
print "<table border=1>";
	print "<tr>";

for ($r = 0; $r < $rows; ++$r){
	$result->data_seek($r);
	$columns = $result->fetch_array(MYSQLI_NUM);
	foreach($columns as $column){
		print "<th>";
		print "$column";
		print "</th>";
	}
}
	print "</tr>\n";

// get Desktop data
$query = "select * from $table";
$result = $connect->query($query);
if (!$result) die ($connect->error);
$rows = $result->num_rows;
for ($r = 0; $r < $rows; ++$r){
	$result->data_seek($r);
	print "<tr>";
	$columns = $result->fetch_array(MYSQLI_NUM);
	foreach($columns as $column){
		print "<td>";
		print "$column";
		print "</td>";
	}
	print "</tr>\n";
}
print "</table>";

?>
</body>
</htmL>
