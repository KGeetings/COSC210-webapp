<!DOCTYPE html>
<html>
<head>
<title>Display the Locations in a building</title>
</head>
<body>
<h1>Form to get a building locations</h1>
<?php

$hostname = "localhost";
$username = "root";
$password = "cosc210";
$database = "StudySpaces";
$connect = new mysqli($hostname, $username, $password, $database); 
if ($connect -> connect_error) die ($connect -> connect_error);
if(isset($_POST['buildingid'])){
	$id = $_POST["buildingid"];
	$query = "select id, description from locations where buildingid = '$id'";
	$result = $connect->query($query);
	if (!$result) die ($connect->error);
	$rows = $result->num_rows;
	print "<p>Building $name has these locations</p>";
	print "<table border=1";
	print "<tr><th>id</th><th>description</th></tr>";
	for ($r = 0; $r < $rows; ++$r){
		$result->data_seek($r);
		$columns = $result->fetch_array(MYSQLI_NUM);
		print "<tr><td>$columns[0]</td><td> $columns[1]</td></tr>";
		}
	print "</table>";	
	}

else {

	echo <<<HTML
	<form method="POST" action="">
	<label>Enter building name</label>
HTML;
	$query = "select id, name from buildings";
	$result = $connect->query($query);
	if (!$result) die ($connect->error);
	$rows = $result->num_rows;
	print "<select name='buildingid'>\n";

	for ($r = 0; $r < $rows; ++$r){
		$result->data_seek($r);
		$columns = $result->fetch_array(MYSQLI_NUM);
		print "<option value='$columns[0]'>$columns[1]</option>\n";
		}
	print "</select><br>\n";
	print <<<HTML2
	<input type="submit" value="Send"><br>
	<input type="reset" value="Clear">
	</form>
HTML2;
}
?>
</body>
</html>

