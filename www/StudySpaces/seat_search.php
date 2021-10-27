<!DOCTYPE html>
<html>
<head>
<title>Form to find study seating on campus</title>
</head>
<body>
<h1>Study Spaces</h1>
<?php
$hostname = "db";
$username = "root";
$password = "password";
$database = "StudySpaces";
$connect = new mysqli($hostname, $username, $password, $database);
if ($connect -> connect_error) die ($connect -> connect_error);

if (isset($_POST['name'])){	
	$name = $_POST['name'];
	$seatcode = $_POST['number'];
	$lower = array(0, 1, 6, 11, 26);
	$upper = array(1, 5, 10, 25, 100);
	$low = $lower[$seatcode];
	$up = $upper[$seatcode];
	$query = "select name, description FROM buildings,locations WHERE buildings.id = locations.buildingid".
	" AND name = '$name' AND (buildings.id, locations.id) IN ".
	"(SELECT building_id, location_id from spaces where seating >= $low and seating <= $up)";
	$result = $connect->query($query);
	if (!$result) die ($connect->error);
	$rows = $result->num_rows;
	print "<p>Building $name has these locations has from $low up to $up seats</p>";
	print "<table border=1";
	print "<tr><th>name</th><th>description</th></tr>";
	for ($r = 0; $r < $rows; ++$r){
		$result->data_seek($r);
		$columns = $result->fetch_array(MYSQLI_NUM);
		print "<tr><td>$columns[0]</td><td> $columns[1]</td></tr>";
		}
	print "</table>";

}
else {
	echo <<<_HTML
	<form action='' method='POST'>
	<table> <tr><td>
	<label>Builing</label>
	<select name='name'>
_HTML;
	$query = "select name from buildings";
	$result = $connect->query($query);
	if (!$result) die ($connect->error);
	$rows = $result->num_rows;
	for ($r = 0; $r < $rows; ++$r){
		$result->data_seek($r);
		$columns = $result->fetch_array(MYSQLI_NUM);
		echo "<option value='$columns[0]'>". $columns[0]."</option>";
		}
	echo <<<_HTML2
	</select></td>	
	<td><label>Number of seats</label>
	<select name="number">
	<option value='0'>1</option>
	<option value='1'>5</option>
	<option value='2'>10</option>
	<option value='3'>25</option>
	<option value='4'>more than 25</option>
	</select>
	</td>	
	</tr><tr></tr>
	<tr><td><input type='submit' value='send'></td>
	<td><input type='reset' value='clear'></td>
	</tr></table>
	</form>
_HTML2;

}
?>
</body>
</html>

