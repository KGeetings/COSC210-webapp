<?php
$hostname = "db";
$username = "root";
$password = "password";
$database = "StudySpaces";
$connect = new mysqli($hostname, $username, $password, $database); 
if ($connect -> connect_error) die ($connect -> connect_error);
print "Which building is to have a new location?\n";
$name = array();
$query = "select id, name from buildings";
$result = $connect->query($query);
if (!$result) die ($connect->error);
$rows = $result->num_rows;
for ($r = 0; $r < $rows; ++$r){
	$result->data_seek($r);
	$columns = $result->fetch_array(MYSQLI_NUM);
	print "$columns[0]-->$columns[1]\n";
	array_push($name, $columns[1]);
	}
print "Choose the number:";

$id = trim(fgets(STDIN));
$bid = $id - 1;
print "Building $name[$bid] was chosen\n";

// insert location description into locations table

print "What is the description of the new location?\n";
print "Description:";
$desc = trim(fgets(STDIN));
$insert = sprintf("insert into locations (buildingid, description) " . 
	"values('%d','%s')", $id, $desc);
$result = $connect->query($insert);
if (!$result) die ($connect->error);
$locid = $connect->insert_id;
// insert resources into loc_res table

print "Which of the following resources are available at this location?\n";
$query = "select id, description from resources";
$result = $connect->query($query);
if (!$result) die ($connect->error);
$rows = $result->num_rows;
for ($r = 0; $r < $rows; ++$r){
	$result->data_seek($r);
	$columns = $result->fetch_array(MYSQLI_NUM);
	$res_id = $columns[0];
	print "Resource $columns[1]? Y or N";
	$reply = trim(fgets(STDIN));
	if (strcmp($reply,"Y") == 0) {
      		$insert = sprintf("insert into loc_res " . 
		"values('%d','%d','%d')", $locid, $res_id, $id );
		$res = $connect->query($insert);
		if (!$res) die ($connect->error);
		}	
	}
// insert in spaces table
print "Please complete the following information\n";
print "How many seats are available?";
$seats = trim(fgets(STDIN));
print "How many computers are available?";
$computers = trim(fgets(STDIN));
print "Please describe the food availability, if any.\n>";
$food = trim(fgets(STDIN));
print "From 1 (quiet) to 10 (very loud), please rate the noise level:";
$noise = trim(fgets(STDIN));
print "Please describe the lighting in this location. Natural, Artificial, other\n>";
$lighting = trim(fgets(STDIN));
print "From 1 (bad) to 10 (great), please rate this a place to study:";
$rating = trim(fgets(STDIN));
$insert = sprintf("insert into spaces " . 
	"values('%d','%d','%d','%d','%s','%d','%s','%d')", 
	$id, $locid, $seats, $computers, $food, $noise, $lighting, $rating);
$result = $connect->query($insert);
if (!$result) die ($connect->error);
print "Thank you for entering this data!\n";


?>
