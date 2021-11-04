<!DOCTYPE html>
<html>
<head>
<title>Project 3 - Form Complete</title>
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

// submit the study space info
    $ld = $_POST["locationdesc"];
    $id = $_POST['buildingid'];
    $locid = $_POST['locationid'];
    $seats = $_POST['seats'];
    $computers = $_POST['computers'];
    $food = $_POST['food'];
    $noise = $_POST['noise'];
    $lighting = $_POST['lighting'];
    $rating = $_POST['studyplace'];

    $insert = sprintf("insert into spaces " . 
	"values('%d','%d','%d','%d','%s','%d','%s','%d')", 
	$id, $locid, $seats, $computers, $food, $noise, $lighting, $rating);
    $result = $connect->query($insert);
    if (!$result) die ($connect->error);
	print <<<HTML
<!-- top section -->
<div class="section header">
  <div class="container">
    <div class="row">
      <div class="ten columns">
        <p class="logo">Form complete</p>
      </div>
     </div>
  </div>
</div>
HTML;
?>
</body>
</html>