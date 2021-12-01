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
$hostname = "db";
$username = "root";
$password = "password";
$database = "StudySpaces";
$loc = $_POST['location'];
$bldg = $_POST['building'];
echo "<p>The image file associated with building: $bldg and location: $loc</p>\n";
$target_dir = "/var/www/html"."/Images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "<p>"."File is an image - " . $check["mime"] . "."."</p>";
        $uploadOk = 1;
    } else {
        echo "<p>"."File is not an image."."</p>";
        $uploadOk = 0;
    }
}

// Check if file already exists
$now = time();
while (file_exists($target_file = $target_dir . $now . basename($_FILES["fileToUpload"]["name"]))){
	$now++;
	}

// Check file size  
$size = $_FILES['fileToUpload']['size'];
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "<p>"."Sorry, your file is too large."."</p>";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<p>"."Sorry, only JPG, JPEG, PNG & GIF files are allowed."."</p>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<p>"."Sorry, your file was not uploaded."."</p>";
// if everything is ok, try to upload file
} else {
    if (@move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<p>"."The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded."."</p>";
// insert into the database
/*	$connect = new mysqli(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME); 
	if ($connect -> connect_error) die ($connect -> connect_error); */
$hostname = "db";
$username = "root";
$password = "password";
$database = "StudySpaces";
$connect = new mysqli($hostname, $username, $password, $database); 
if ($connect -> connect_error) die ($connect -> connect_error);
// get building id
	$query = "select id from buildings where name='$bldg'";
	$result = $connect->query($query);
	if (!$result) die ($connect->error);
	$result->data_seek(0);
	$columns = $result->fetch_array(MYSQLI_NUM);
	$bldg_id = $columns[0];
// insert image data into image table
	$insert_image_sql = sprintf("INSERT INTO images ".
		"( path, filename, mime_type ) "."VALUES( '%s', '%s', '%s' )", 
		$target_file, basename( $_FILES["fileToUpload"]["name"]), $check['mime']);
	echo "<p>$insert_image_sql</p>";
	$result = $connect->query($insert_image_sql);
	if (!$result) die ($connect->error);

	$image_id = $connect->insert_id;	//last entered auto_incremented value from the table insert
// insert relational data into loc_image table
	$insert_loc_image_sql = sprintf("INSERT INTO loc_image ". "( building_id, loc_id, image_id ) ".
		"VALUES( '%d', '%d', '%d' )", $bldg_id, $loc, $image_id ); 
	$result = $connect->query($insert_loc_image_sql);
	if (!$result) die ($connect->error);	
	
	$imagepath = "/Images/".$now.basename($_FILES["fileToUpload"]["name"]);
	echo "<p>The image file associated with building: $bldg and location: $loc</p>\n";
	echo "<img src='$imagepath'>\n";
	
    } else {
        echo "<p>"."Sorry, there was an error uploading your file"."</p>";
    }
}
?>
</body>
</htmL>
