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
if(isset($_POST['submit'])){
    $ld = $_POST["locationdesc"];
    $id = $_POST['buildingid'];
    $locid = $_POST['locationid'];
    $lresources = $_POST['lresource_list'];
    if(!empty($_POST['lresource_list'])){
        foreach($_POST['lresource_list'] as $lresource){
            $query = sprintf("insert into loc_res " .
                "values('%d','%d','%d')", $locid, $lresource, $id);
            $result = $connect -> query($query);
            if (!$result) die ($connect -> error);
        }
    }

// Study Spaces info
	print <<<LOC
<!-- top section -->
<div class="section header">
  <div class="container">
    <div class="row">
      <div class="ten columns">
        <p class="logo">Form to add study spaces info</p>
      </div>
     </div>
  </div>
</div>	
<!-- info section -->
<div class="section header">
  <div class="container">
    <div class="row">
	<form method='POST' action='page3.php'>
      	<div class="three columns">
		<label>Please complete the following.</label>
	    </div>
	<div class="rendered-form">
    <div class="formbuilder-number form-group field-seats">
        <label for="seats" class="formbuilder-number-label">How many seats are available?
            <br>
        </label>
        <input type="number" class="form-control" name="seats" access="false" id="seats">
    </div>
    <div class="formbuilder-number form-group field-computers">
        <label for="computers" class="formbuilder-number-label">How many computers are available?
            <br>
        </label>
        <input type="number" class="form-control" name="computers" access="false" id="computers">
    </div>
    <div class="formbuilder-textarea form-group field-food">
        <label for="food" class="formbuilder-textarea-label">Please describe the food availability, if any.
            <br>
        </label>
        <textarea type="textarea" class="form-control" name="food" access="false" id="food"></textarea>
    </div>
    <div class="formbuilder-select form-group field-noise">
        <label for="noise" class="formbuilder-select-label">From 1 (quiet) to 10 (very loud), please rate the noise level:
            <br>
        </label>
        <select class="form-control" name="noise" id="noise">
            <option value="1" selected="true" id="noise-0">1</option>
            <option value="2" id="noise-1">2</option>
            <option value="3" id="noise-2">3</option>
            <option value="4" id="noise-3">4</option>
            <option value="5" id="noise-4">5</option>
            <option value="6" id="noise-5">6</option>
            <option value="7" id="noise-6">7</option>
            <option value="8" id="noise-7">8</option>
            <option value="9" id="noise-8">9</option>
            <option value="10" id="noise-9">10</option>
        </select>
    </div>
    <div class="formbuilder-text form-group field-lighting">
        <label for="lighting" class="formbuilder-text-label">Please describe the lighting in this location. Natural, Artificial, other</label>
        <input type="text" class="form-control" name="lighting" access="false" id="lighting">
    </div>
    <div class="formbuilder-select form-group field-studyplace">
        <label for="studyplace" class="formbuilder-select-label">From 1 (bad) to 10 (great), please rate this a place to study:
            <br>
        </label>
        <select class="form-control" name="studyplace" id="studyplace">
            <option value="1" selected="true" id="studyplace-0">1</option>
            <option value="2" id="studyplace-1">2</option>
            <option value="3" id="studyplace-2">3</option>
            <option value="4" id="studyplace-3">4</option>
            <option value="5" id="studyplace-4">5</option>
            <option value="6" id="studyplace-5">6</option>
            <option value="7" id="studyplace-6">7</option>
            <option value="8" id="studyplace-7">8</option>
            <option value="9" id="studyplace-8">9</option>
            <option value="10" id="studyplace-9">10</option>
        </select>
    </div>
    </div>

    <div class="row">
	<div class="six columns">
		<input class="button button-primary" type="submit"><br>
		<input class="button" type="reset">
        <input type="hidden" name="buildingid" value="$id">
        <input type="hidden" name="locationdesc" value="$ld">
        <input type="hidden" name="locationid" value="$locid">
	</div
    </div>
  </div>
</div>	
LOC;	
}
else {
    $ld = $_POST["locdesc"];
    $id = $_POST['buildingid'];

    //insert location description into the database
    $insert = sprintf("insert into locations (buildingid, description) " . 
	    "values('%d','%s')", $id, $ld);
    $result = $connect->query($insert);
    if (!$result) die ($connect->error);
    $locid = $connect->insert_id;

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
    $query = "select id, description from resources";
    $result = $connect->query($query);
    if (!$result) die ($connect->error);
    $rows = $result->num_rows;
    for ($r = 0; $r < $rows; ++$r){
		$result->data_seek($r);
		$columns = $result->fetch_array(MYSQLI_NUM);
		print "<input type='checkbox' name='lresource_list[]' value='$columns[0]'><label>$columns[1]</label><br>\n";
		}
	print "<br>\n";
	print <<<HTML
	</div>
    <div class="row">
 		&nbsp;

    </div>
    <div class="row">
	<div class="two columns">
		<input class="button button-primary" type="submit" name='submit'><br>
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
        <input type="hidden" name="buildingid" value="$id">
        <input type="hidden" name="locationdesc" value="$ld">
        <input type="hidden" name="locationid" value="$locid">
	</div>
	</form>
   </div>
  </div>
</div>
HTML;
}
?>
</body>
</html>

