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
	// Container 1 is the heading above
	$hostname = "db";
	$username = "root";
	$password = "password";
	$database = "StudySpaces";
	$connect = new mysqli($hostname, $username, $password, $database); 
	if ($connect -> connect_error) die ($connect -> connect_error);
	if (!isset($_POST['building'])) {
		echo "<h2>For which building do you wish to search?</h2>\n";
	
		$buildings = array();
		// get the buidling names - Container 2
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
		// Container 2
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
		// Prints the location and once finished prints the location and building Container 2
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
		echo "<h2>You are now looking at Building: $bldg, <br>Location: $columns[0]";
		
		// adding previous and next buttons to navigate through the locations
		if ($loc == 1){
			echo "<form action='' method='POST'>\n";
			echo "<input type='submit' value='Next'>\n";
			echo "<input type='hidden' value='$bldg' name='building'>\n";
			echo "<input type='hidden' value='$loc' name='location'>\n";
			echo "</form>\n";
		}
		else if ($loc == $rows) {
			echo "<form action='' method='POST'>\n";
			echo "<input type='submit' value='Previous'>\n";
			echo "<input type='hidden' value='$bldg' name='building'>\n";
			echo "<input type='hidden' value='$loc' name='location'>\n";
			echo "</form>\n";
		}
		else {
			echo "<form action='' method='POST'>\n";
			echo "<input type='submit' value='Previous'>\n";
			echo "<input type='hidden' value='$bldg' name='building'>\n";
			echo "<input type='hidden' value='$loc' name='location'>\n";
			echo "</form>\n";
			echo "<form action='' method='POST'>\n";
			echo "<input type='submit' value='Next'>\n";
			echo "<input type='hidden' value='$bldg' name='building'>\n";
			echo "<input type='hidden' value='$loc' name='location'>\n";
			echo "</form>\n";
		}
		echo "</h2>\n";
		
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
		
		// Prints the images for Container 3
		print <<<IMAGES
			<div class="images">
				<img src="$newcolumn0" id="image0">
				<img src="$newcolumn1" id="image1">
				<img src="$newcolumn2" id="image2">
			</div>
		IMAGES;
		
		// Create Resources and Spaces data Container 4
		echo "<div class = 'res_space'>";
		
		echo "<table><tr><td>";
		echo "Available Resources:</td>";
		$query3 = "select description from resources where id in (select resource_id from loc_res where loc_id = '$loc' AND building_id = (select id from buildings where name = '$bldg'))";
		$result3 = $connect->query($query3);
		if (!$result3) die ($connect->error);
		$rows3 = $result3->num_rows;
		echo "<td>";
		for ($r = 0; $r < $rows3; ++$r){
			$result3->data_seek($r);
			$columns3 = $result3->fetch_array(MYSQLI_NUM);
			echo "$columns3[0], ";
			}
		echo "</td></tr><tr><td>";
		echo "Seating:</td><td>";
		$query4 = "select seating from spaces where location_id = '$loc' AND building_id = (select id from buildings where name = '$bldg')";
		$result4 = $connect->query($query4);
		if (!$result4) die ($connect->error);
		$rows4 = $result4->num_rows;
		for ($r = 0; $r < $rows4; ++$r){
			$result4->data_seek($r);
			$columns4 = $result4->fetch_array(MYSQLI_NUM);
			echo "$columns4[0]";
			}
		echo "</td></tr><tr><td>";
		echo "Computers:</td><td>";
		$query5 = "select computers from spaces where location_id = '$loc' AND building_id = (select id from buildings where name = '$bldg')";
		$result5 = $connect->query($query5);
		if (!$result5) die ($connect->error);
		$rows5 = $result5->num_rows;
		for ($r = 0; $r < $rows5; ++$r){
			$result5->data_seek($r);
			$columns5 = $result5->fetch_array(MYSQLI_NUM);
			echo "$columns5[0]";
			}
		echo "</td></tr><tr><td>";
		echo "Food:</td><td>";
		$query6 = "select food from spaces where location_id = '$loc' AND building_id = (select id from buildings where name = '$bldg')";
		$result6 = $connect->query($query6);
		if (!$result6) die ($connect->error);
		$rows6 = $result6->num_rows;
		for ($r = 0; $r < $rows6; ++$r){
			$result6->data_seek($r);
			$columns6 = $result6->fetch_array(MYSQLI_NUM);
			echo "$columns6[0]";
			}
		echo "</td></tr><tr><td>";
		echo "Noise level:</td><td>";
		$query7 = "select noise from spaces where location_id = '$loc' AND building_id = (select id from buildings where name = '$bldg')";
		$result7 = $connect->query($query7);
		if (!$result7) die ($connect->error);
		$rows7 = $result7->num_rows;
		for ($r = 0; $r < $rows7; ++$r){
			$result7->data_seek($r);
			$columns7 = $result7->fetch_array(MYSQLI_NUM);
			echo "$columns7[0]";
			}
		echo "</td></tr><tr><td>";
		echo "Lighting:</td><td>";
		$query8 = "select lighting from spaces where location_id = '$loc' AND building_id = (select id from buildings where name = '$bldg')";
		$result8 = $connect->query($query8);
		if (!$result8) die ($connect->error);
		$rows8 = $result8->num_rows;
		for ($r = 0; $r < $rows8; ++$r){
			$result8->data_seek($r);
			$columns8 = $result8->fetch_array(MYSQLI_NUM);
			echo "$columns8[0]";
			}
		echo "</td></tr><tr><td>";
		echo "Rating:</td><td>";
		$query9 = "select rating from spaces where location_id = '$loc' AND building_id = (select id from buildings where name = '$bldg')";
		$result9 = $connect->query($query9);
		if (!$result9) die ($connect->error);
		$rows9 = $result9->num_rows;
		for ($r = 0; $r < $rows9; ++$r){
			$result9->data_seek($r);
			$columns9 = $result9->fetch_array(MYSQLI_NUM);
			echo "$columns9[0]";
			}
		echo "</td></tr></table>";
		echo "</div>";

		// Container 5 - Footer with my design credits
		print <<<FOOTER
			<div class="footer">
				<p>
					This page was designed and developed by Kenyon Geetings, a student at Central College
					in the Department of Computer Science for COSC-210: Database and the Web.
				</p>
			</div>
		FOOTER;
	}
	?>
 </body>
</html>