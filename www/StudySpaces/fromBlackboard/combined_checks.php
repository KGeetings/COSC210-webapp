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
if(isset($_POST['submit'])){
   if(!empty($_POST['check_list'])){
   //loop to display locations for each building checked
   	foreach($_POST['check_list'] as $selected) {
		$id = $selected;
	
		$getname = "select name from buildings where id = '$id'";
		$name_result = $connect->query($getname);
		if (!$name_result) die ($connect->error);
		$name_result->data_seek(0);
		$name = $name_result->fetch_array(MYSQLI_NUM);
		print "<p><b> $name[0]</b> has these locations</p>";
	
		$query = "select id, description from locations where buildingid = '$id'";
		$result = $connect->query($query);
		if (!$result) die ($connect->error);
		$rows = $result->num_rows;
		print "<table border=1";
		print "<tr><th>id</th><th>description</th></tr>";
		for ($r = 0; $r < $rows; ++$r){
			$result->data_seek($r);
			$columns = $result->fetch_array(MYSQLI_NUM);
			print "<tr><td>$columns[0]</td><td> $columns[1]</td></tr>";
			}
		print "</table><br><hr><br>";
		
		}	
	}
    }
else {

	echo <<<HTML
	<form method="POST" action="">
	<label>Which building?</label><br>
HTML;
	$query = "select id, name from buildings";
	$result = $connect->query($query);
	if (!$result) die ($connect->error);
	$rows = $result->num_rows;

	for ($r = 0; $r < $rows; ++$r){
		$result->data_seek($r);
		$columns = $result->fetch_array(MYSQLI_NUM);
		print "<input type='checkbox' name='check_list[]' value='$columns[0]'><label>$columns[1]</label><br>\n";
		}
	print "<br>\n";
	print <<<HTML2
	
	<input type="submit" name="submit" value="Send"><br>
	<input type="reset" value="Clear">
	</form>
HTML2;
}
?>
</body>
</html>

