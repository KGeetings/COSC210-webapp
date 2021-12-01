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
  <script>
  labels = ["Number of seats?",
  				"Number of computers?",
  				"Food availability",
  				"Rate how noisy the location is (1 to 10-high).",
  				"What type of lighting?",
  				"Overall rating of the location as a place to study (1 to 10-high)?"]
  widgets = ['<input type="number" name="seats" min="1" max="50" id="seats"><br>',
  				'<input type="number" name="computers" min="1" max="50" id="computers"><br>',
  				'<textarea name="food" rows="3" cols="40" id="food"></textarea><br>',
  				'<input type="number" name="noise" min="1" max="10" id="noise"><br>',
  				'<input type="text" name="lighting" id="lighting"><br>',
  				'<input type="number" name="rating" min="1" max="10" id="rating"><br>']
  list = ["seats","computers","food","noise","lighting","rating"]
  index = 0
  function doit(){
  		if ( index < labels.length) {
  			if (index != 0) {
  				O(list[index-1]+"_hide").value = O(list[index-1]).value
  			}
  			O('label').innerHTML = labels[index]
  			O('widget').innerHTML = widgets[index]
  			index++
  			}
  		else {
  			O('label').innerHTML = ""
  			O('widget').innerHTML = ""
  			S('submit').visibility = "visible"
  			S('reset').visibility = "visible"
  			S('next').visibility = "hidden"
  		}
  }
 </script>
 </head>
 <body>
		<h1>Central College Study Spaces</h1>
		<form method='POST' action=''>
		<p>Please complete the following information about the location</p>
		<label id='label'></label>
		<div id="widget"></div>
		<input type="button" value="next" id="next" onclick="doit()"><br>
		<input type="submit" id="submit"><br>
		<input type="reset" id="reset">
		<input type="hidden" name="seats" id="seats_hide" value="">
		<input type="hidden" name="computers" id="computers_hide" value="">
		<input type="hidden" name="food" id="food_hide" value="">
		<input type="hidden" name="noise" id="noise_hide" value="">
		<input type="hidden" name="lighting" id="lighting_hide" value="">
		<input type="hidden" name="rating" id="rating_hide" value="">
		<input type="hidden" name="buildingid" value="$bid">
		<input type="hidden" name="description" value="spaces">
		<input type="hidden" name="locid" value="$locid">
		</form>
 </body>
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