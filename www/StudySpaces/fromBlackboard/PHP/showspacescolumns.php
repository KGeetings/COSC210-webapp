<!DOCTYPE html>
<html>
<head>
<title>Display the Study Spaces Table Columns</title>
</head>
<body>
<p>The table passed was
<?php
$table = $_POST['table'];


$hostname = "localhost";
$username = "root";
$password = "Fall2019";
$database = "StudySpaces";
$connect = new mysqli($hostname, $username, $password, $database); 
if ($connect -> connect_error) die ($connect -> connect_error);

// get metadata about the database
$query = "select column_name from information_schema.columns ".
	"where table_schema = 'StudySpaces' and table_name='$table'";
$result = $connect->query($query);
if (!$result) die ($connect->error);
$rows = $result->num_rows;
echo "<form action='showspacesdata.php' method='POST'>\n";
echo "<p>Check which fields from table $table to display</p>";
for ($r = 0; $r < $rows; ++$r){
	$result->data_seek($r);
	$columns = $result->fetch_array(MYSQLI_NUM);
	echo "<input type='checkbox' name='field$r' value='yes'>";
	echo "$columns[0]<br>\n";
}
echo "<input type='submit' value='Press me'>\n";
echo "<input type='hidden' value='$table' name='table'>";
echo "</form>\n";


?>
</body>
</htmL>

