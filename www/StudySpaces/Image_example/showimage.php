<!DOCTYPE html>
<html>
<head>
<title>Upload Image into Images Folder</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/custom.css">
</head>

<body>

<?php

$loc = $_GET['location'];
$bldg = $_GET['building'];
$imagepath = $_GET['imagepath'];
echo "<p>The image file associated with building: $bldg and location: $loc</p>\n";
echo "<img src='/StudySpaces/Images/$imagepath'>\n";
?>
</body>
</htmL>
