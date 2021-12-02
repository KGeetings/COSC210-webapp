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
		$query1 = "select description from locations where buildingid = (select id from buildings where name = '$bldg') AND id = '$loc'";
		$result1 = $connect->query($query1);
		if (!$result1) die ($connect->error);
		$rows = $result1->num_rows;
		for ($r = 0; $r < $rows; ++$r){
			$result1->data_seek($r);
			$columns = $result1->fetch_array(MYSQLI_NUM);
			}
		echo "<h2>You are now looking at Building: $bldg, <br>Location: $columns[0]</h2>\n";
		
		$result2img = array();
		$query2 = "select path from images where id in (select image_id from loc_image where loc_id = '$loc' AND building_id = (select id from buildings where name = '$bldg'))";
		$result2 = $connect->query($query2);
		if (!$result2) die ($connect->error);
		$rows2 = $result2->num_rows;
		for ($r = 0; $r < $rows2; ++$r){
			$result2->data_seek($r);
			$columns2 = $result2->fetch_array(MYSQLI_NUM);
			array_push($result2img, $columns2[0]);
			}
		$newcolumn0 = strstr($result2img[0], '/Images');
		$newcolumn1 = strstr($result2img[1], '/Images');
		$newcolumn2 = strstr($result2img[2], '/Images');
		
		print <<<IMAGES
		<body>
			<div id = "holderImages">
				<div class='image0'>
					<img src='$newcolumn0'>
				</div>
				<div class='image1'>
					<img src='$newcolumn1'>
				</div>
				<div class='image2'>
					<img src='$newcolumn2'>
				</div>
			</div>
		</body>
		
	IMAGES;

	}
	?>
 </body>
</html>