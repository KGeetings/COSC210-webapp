<!doctype html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Resource Inserted</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/custom.css">
</head>
<body>

<?php 
$hostname = "localhost";
$username = "root";
$password = "Fall2019";
$database = "StudySpaces";
$connect = new mysqli($hostname, $username, $password, $database); 
if ($connect -> connect_error) die ($connect -> connect_error);

$desc = $_POST['description'];

$insert_query = sprintf("INSERT INTO resources ".
		"(description) VALUES ('%s')",

		$connect->real_escape_string($desc) );
$result = $connect->query($insert_query);
if (!$result) die("<p>Error in inserting location: " . $connect->error . "</p>");
print <<<BIGPRINT
<body>
  <div class="container">
    <div class="row">
      <div class="two columns">
      <img src="imgs/centralCollegeLogo.png">
      </div>
      <div class="ten columns">
<header class="logo">The Central College Study Spaces Project
</header>
      </div>
    </div>
  </div>
<hr>
  <div class="container">
    <div class="row">
      <div class="ten columns">
<h1>Current Resources</h1>
      </div>
    </div>
  </div>
  <div class="container">
<table class="u-full-width">
<thead>
<tr>
<th>Resource Number</th>
<th>Description</th>
</tr>
</thead>
<tbody>
BIGPRINT;

$query = "select * from resources";
$result = $connect->query($query);
if (!$result) die ($connect->error);
$rows = $result->num_rows;

for ($r = 0; $r < $rows; ++$r){
	$result->data_seek($r);
	$columns = $result->fetch_array(MYSQLI_NUM);
	echo "<tr><td>$r</td><td>$columns[1]</td></tr>\n";
}

print "</tbody></table>"; 
?>
<hr>
<footer>  
<div class="container">
  <div class="row">
<p class="u-full-width">Study Spaces Database</p>
  </div>
</div>
</footer>

</body>
</html>

