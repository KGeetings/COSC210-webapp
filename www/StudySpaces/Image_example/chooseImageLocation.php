<!DOCTYPE html>
<html>
<head>
<title>Choose a location image to upload</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/custom.css">
</head>
<body>

<?php
$hostname = "db";
$username = "root";
$password = "password";
$database = "StudySpaces";
$connect = new mysqli($hostname, $username, $password, $database); 
if ($connect -> connect_error) die ($connect -> connect_error);
if (!isset($_POST['building'])) {
	echo "<h2>For which building do you wish to submit an image?</h2>\n";

	$buildings = array();
	// get the buidling names
	$query = "select name from buildings ";
	$result = $connect->query($query);
	if (!$result) die ($connect->error);
	$rows = $result->num_rows;

	for ($r = 0; $r < $rows; ++$r){
		$result->data_seek($r);
		$columns = $result->fetch_array(MYSQLI_NUM);
		array_push($buildings, $columns[0]);
		}
	
	echo "<form action='' method='POST'>\n";
	echo "<select name='building'>\n";
	foreach( $buildings as $b){
		echo "<option value='$b'>$b</option>\n";
	}
	echo "</select>\n";
	echo "<input type='submit' value='Press me'>\n";
	echo "</form>\n";
}
else if (!isset($_POST['location'])){
	echo "<h2>For which location do you wish to submit an image?</h2>\n";
	$bldg = $_POST['building'];
	$query = "select id, description from locations ".
		"where buildingid = (select id from buildings where name = '$bldg')";
	$result = $connect->query($query);
	if (!$result) die ($connect->error);
	echo "<form action='' method='POST'>\n";
	echo "<select name='location'>\n";
	
	$rows = $result->num_rows;
	for ($r = 0; $r < $rows; ++$r){
		$result->data_seek($r);
		$columns = $result->fetch_array(MYSQLI_NUM);
		echo "<option value='$columns[0]'>$columns[1]</option>\n";
		}
		echo "</select>\n";
	echo "<input type='submit' value='Press me'>\n";
	echo "<input type='hidden' value='$bldg' name='building'>";
	echo "</form>\n";
	}
else { 
	$bldg = $_POST['building'];
	$loc = $_POST['location'];
	echo "<form action='upload_insert.php' method='post' enctype='multipart/form-data'>\n";
    	echo "Select image to upload:";
    	echo "<input type='file' name='fileToUpload' id='fileToUpload'>\n";
    	echo "<input type='submit' value='Upload Image' name='submit'>\n";
	echo "<input type='hidden' value='$bldg' name='building'>";
	echo "<input type='hidden' value='$loc' name='location'>";
	echo "</form>\n";
}
?>
</body>
</html>

