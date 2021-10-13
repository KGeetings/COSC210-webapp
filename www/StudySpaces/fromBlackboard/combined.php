<!DOCTYPE html>
<html>
<head>
<title>Display the Locations in a building</title>
</head>
<body>
<h1>Form to get a building name</h1>
<?php
if(isset($_POST['building'])){

$hostname = "localhost";
$username = "root";
$password = "cosc210";
$database = "StudySpaces";
$connect = new mysqli($hostname, $username, $password, $database); 
if ($connect -> connect_error) die ($connect -> connect_error);
$name = $_POST["building"];
$query = "select id, name from buildings";
$result = $connect->query($query);
if (!$result) die ($connect->error);
$rows = $result->num_rows;
print "<p>Building ";
$building_id = -1;
for ($r = 0; $r < $rows; ++$r){
	$result->data_seek($r);
	$columns = $result->fetch_array(MYSQLI_NUM);
	if (strcmp($columns[1],$name) == 0) {
		$building_id = $columns[0];
		print "$name was found.</p>";
		}
	}
if ($building_id == -1) {
	print "$name was not found in the database</p>";
	}
else {
	$query = "select id, description from locations where buildingid = '$building_id'";
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
}

else {

echo <<<HTML
<form method="POST" action="">
<label>Enter building name</label>
<input type="text" name="building" value="Enter building name"><br>
<input type="submit" value="Send"><br>
<input type="reset" value="Clear">

</form>
HTML;
}
?>
</body>
</html>

