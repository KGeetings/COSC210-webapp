<!DOCTYPE html>
<html>
<head>
<title>Project 3 - Form to add study spaces info</title>
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
if(isset($_POST['lresources'])){

// location description form
	$ld = $_POST["locdesc"];
    $id = $_POST['id'];
	print <<<LOC
<!-- top section -->
<div class="section header">
  <div class="container">
    <div class="row">
      <div class="ten columns">
        <p class="logo">Form to provide the location description</p>
      </div>
     </div>
  </div>
</div>	
<!-- info section -->
<div class="section header">
  <div class="container">
    <div class="row">
	<form method='POST' action=''>
      	<div class="three columns">
		<label>What is the location description?</label>
	</div>
	<div class="nine columns">
		<textarea name="description" rows="3" cols="40">Description goes here
		</textarea><br>
	</div>
    </div>
    <div class="row">
	<div class="six columns">
		<input class="button button-primary" type="submit"><br>
		<input class="button" type="reset">
		<input type="button" name="buildingid" value="$id">
        <input type="button" name="locationddesc" value="$ld">
	</div
     </div>
  </div>
</div>	
LOC;	
}
else {
    $ld = $_POST["locdesc"];
    $id = $_POST['id'];
// choose location resources form
	echo <<<HTML
<!-- top section -->
<div class="section header">
  <div class="container">
    <div class="row">
      <div class="ten columns">
        <p class="logo">Form to get location resources</p>
      </div>
     </div>
  </div>
</div>
<!-- info section -->
<div class="section header">
  <div class="container">
    <div class="row">
	<form method='POST' action=''>
      	<div class="three columns">
		<label>Choose location resources from the list</label>
	</div>
	<div class="nine columns">

HTML;
	$query = "select id, name from buildings";
	$result = $connect->query($query);
	if (!$result) die ($connect->error);
	$rows = $result->num_rows;
	print "<select name='lresources'>\n";

	for ($r = 0; $r < $rows; ++$r){
		$result->data_seek($r);
		$columns = $result->fetch_array(MYSQLI_NUM);
		print "<option value='$columns[0]'>$columns[1]</option>\n";
		}
	print "</select><br>\n";
	print <<<HTML
	</div>
    <div class="row">
 		&nbsp;

    </div>
    <div class="row">
	<div class="two columns">
		<input class="button button-primary" type="submit"><br>
	</div>
    </div>
   <div class="row">
	&nbsp;
   </div>
   <div class="row">
	<div class="two columns">
		<input class="button" type="reset">
	</div>
    <div class="row">
	<div class="two columns">
		<input type="button" name="buildingid" value="$id">
        <input type="button" name="locationddesc" value="$ld">
	</div>
	</form>
   </div>
  </div>
</div>
HTML;
} // else building id
?>
</body>
</html>

