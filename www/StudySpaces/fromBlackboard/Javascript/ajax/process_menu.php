<!DOCTYPE html>
<html>
<head>
<title>Ajax place locations</title>
<link href="css/main.css" rel="stylesheet">
</head>
<body>
<?php
	$hostname = "localhost";
	$username = "root";
	$password = "Fall2019";
	$database = "StudySpaces";
	$connect = new mysqli($hostname, $username, $password, $database); 
	if ($connect -> connect_error) die ($connect -> connect_error);

	$bldg = $_POST['building'];
	echo "<p>Building is $bldg</p>\n";
	$query = "select id, description from locations ".
		"where buildingid = (select id from buildings where name = '$bldg')";
	$result = $connect->query($query);
	if (!$result) die ($connect->error);
	
	$rows = $result->num_rows;
	for ($r = 0; $r < $rows; ++$r){
		$result->data_seek($r);
		$columns = $result->fetch_array(MYSQLI_NUM);
		echo "<option value='$columns[0]'>$columns[1]</option>\n";
		}

?>
</body>
</html>
