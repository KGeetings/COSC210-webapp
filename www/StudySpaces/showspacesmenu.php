<!DOCTYPE html>
<html>
<head>
<title>Display the Study Spaces Tables</title>
</head>
<body>
<?php
$tables = array();
$hostname = "db";
$username = "root";
$password = "password";
$database = "StudySpaces";
$connect = new mysqli($hostname, $username, $password, $database); 
if ($connect -> connect_error) die ($connect -> connect_error);

if (isset($_REQUEST['table'])) {
	$name = $_REQUEST['table'];
	echo "<p>Thanks for pressing the button and selecting <b>$name</b></p>";
	}
else{
echo "<p>Which table?</p>\n";
$query = "select table_name from information_schema.tables ".
	"where table_schema = 'StudySpaces' ".
	"and table_type = 'BASE TABLE'";
$result = $connect->query($query);
if (!$result) die ($connect->error);
$rows = $result->num_rows;

for ($r = 0; $r < $rows; ++$r){
	$result->data_seek($r);
	$columns = $result->fetch_array(MYSQLI_NUM);
	array_push($tables, $columns[0]);
	}
	
echo "<form action='' method='POST'>\n";
echo "<select name='table'>\n";
foreach( $tables as $t){
	echo "<option value='$t'>$t</option>\n";
	}
echo "</select>\n";
echo "<input type='submit' value='Press me'>\n";
echo "</form>\n";
}
?>
</body>
</html>

