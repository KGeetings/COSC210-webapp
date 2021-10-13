<!DOCTYPE html>
<html>
<head>
<title>Display the Study Spaces Tables</title>
</head>
<body>
<p>Which table:</p>
<?php
$tables = array();
$hostname = "localhost";
$username = "root";
$password = "Fall2019";
$database = "StudySpaces";
$connect = new mysqli($hostname, $username, $password, $database); 
if ($connect -> connect_error) die ($connect -> connect_error);

// get metadata about the database
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
	
echo "<form action='showspacescolumns.php' method='POST'>\n";
echo "<select name='table'>\n";
foreach( $tables as $t){
	echo "<option value='$t'>$t</option>\n";
	}
echo "</select>\n";
echo "<input type='submit' value='Press me'>\n";
echo "</form>\n";
?>
</body>
</html>

