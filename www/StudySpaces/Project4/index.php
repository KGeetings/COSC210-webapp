<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Central College Study Spaces</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/custom_alt.css">
  <script src="js/script.js"></script>
  </script>
  
 <body>
	 <h1>Central College Study Spaces</h1>
	<?php
	$hostname = "db";
	$username = "root";
	$password = "password";
	$database = "StudySpaces";
	$connect = new mysqli($hostname, $username, $password, $database); 
	if ($connect -> connect_error) die ($connect -> connect_error);
	if (!isset($_POST['building'])) {
		echo "<h2>For which building do you wish to search?</h2>\n";
	
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
		echo "<h2>For which location do you wish to search?</h2>\n";
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
		echo "Loc is $loc\n";
		echo "bldg is $bldg\n";
		$query1 = "select description from locations where buildingid = (select id from buildings where name = '$bldg') AND id = '$loc'";
		$result1 = $connect->query($query1);
		if (!$result1) die ($connect->error);
		$rows = $result1->num_rows;
		for ($r = 0; $r < $rows; ++$r){
			$result1->data_seek($r);
			$columns = $result1->fetch_array(MYSQLI_NUM);
			}
		echo "<h2>You are now looking at Building: $bldg, Location: $columns[0]</h2>\n";
		$query2 = "select path from images where id in (select image_id from loc_image where loc_id = '$loc' AND building_id = (select id from buildings where name = '$bldg'))";
		$result2 = $connect->query($query2);
		if (!$result2) die ($connect->error);
		$rows2 = $result2->num_rows;
		echo "$rows2";
		for ($r = 0; $r < $rows2; ++$r){
			$result2->data_seek($r);
			$columns2 = $result2->fetch_array(MYSQLI_NUM);
			}
		echo "<br> result2 array";
		print_r($result2);
		echo "<br> Columns2 array";
		print_r($columns2);
		echo "<br> $columns2[0]";
		echo "$columns2[1]";
		echo "$columns2[2]";
		$newcolumn0 = strstr($columns2[0], '/Images');
		echo "$newcolumn0";
		$newcolumn1 = strstr($columns2[1], '/Images');
		echo "$newcolumn1";
		$newcolumn2 = strstr($columns2[2], '/Images');
		echo "$newcolumn2";

		echo "<img src='$newcolumn0' alt='image0'>";

	}
	?>
 </body>
</html>