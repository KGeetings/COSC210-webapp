<!DOCTYPE html>
<html>
<head>
<title>Choose a location</title>
<link href="css/normalize.css" rel="stylesheet">
<script src="js/jquery-3.3.1.min.js"></script>
<script>
$(function() {

 $('#building').click(function(){
	$('#comment_area').hide();
	var num = $('#building').val();
	var querystring = "building="+num;
	$.post('process_menu.php',querystring,processResponse);

  }); // end click
 $('#location').hide();
}); // end ready

function processResponse(data) {
	$('#message').html('Which location do you want?');
	$('#location').show();
	$('#location').html(data);
	$('#building').hide();
	$('#banner').html($('#building').val());
	}

</script>
</head>
<body>
<?php
$hostname = "localhost";
$username = "root";
$password = "Fall2019";
$database = "StudySpaces";
$connect = new mysqli($hostname, $username, $password, $database); 
if ($connect -> connect_error) die ($connect -> connect_error);

	echo "<h2 id='banner'>For which building do you wish to view?</h2>\n";

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
	echo "<select id='building' name='building'>\n";
	foreach( $buildings as $b){
		echo "<option value='$b'>$b</option>\n";
	}
	echo "</select><br>\n";
	echo "<p id='message'></p>\n";
	echo "<select id='location'><option>one</option></select><br>\n";
	echo "</form>\n";

?>
</body>
</html>

