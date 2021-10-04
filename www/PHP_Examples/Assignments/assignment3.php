<?php //Assignment 3: What is the total number of seating in study spaces in the "user supplied building"? 
	$hostname = 'db';
	$database = 'StudySpaces';
	$username = 'root';
	$password = 'password';
	$connect = new mysqli($hostname, $username, $password, $database);
	if ($connect->connect_error) die ($connect->connect_error);

print "Which building do you want? ";
$table = trim(fgets(STDIN));
$query = "SELECT SUM(seating) FROM spaces, buildings 
WHERE spaces.building_id = buildings.id AND buildings.name = '$table'";
$result = $connect->query($query);
if (!$result) die ($connect->error);
$rows = $result->num_rows;
print "The total seating of $table is: ";
for ($r = 0; $r < $rows; ++$r){
	$result->data_seek($r);
	$columns = $result->fetch_array(MYSQLI_NUM);
	print "$columns[0]\n";
}
?>
