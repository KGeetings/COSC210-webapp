<?php
$hostname = "db";
$username = "root";
$password = "password";
$database = "StudySpaces";
$connect = new mysqli($hostname, $username, $password, $database); 
if ($connect -> connect_error) die ($connect -> connect_error);
$id = array();
$query = "select name, id from buildings";
$result = $connect->query($query);
if (!$result) die ($connect->error);
$rows = $result->num_rows;
print "Building\n";
for ($r = 0; $r < $rows; ++$r){
	$result->data_seek($r);
	$columns = $result->fetch_array(MYSQLI_NUM);
	print "$r  $columns[0]\n";
	array_push($id, $columns[1]);
}
print "Which building do you want? (Use number): ";
$table = trim(fgets(STDIN));
$buildingid = $id[ $table ];
print "The building id is $buildingid\n";
print "Enter the location description: ";
$locationdesc = trim(fgets(STDIN));
print "What is the resource ID? ";
$resourceid = trim(fgets(STDIN));
print "What is the resouce description? ";
$resourcedesc = trim(fgets(STDIN));

$insert = sprintf("insert into locations (buildingid, description) " . 
	"values('%d','%s')", $buildingid, $locationdesc);
$result = $connect->query($insert);
if (!$result) die ($connect->error);
$newid = $connect->insert_id;

$insert = sprintf("insert into resources (id, description) " . 
	"values('%d','%s')", $resourceid, $resourcedesc);
$result = $connect->query($insert);
if (!$result) die ($connect->error);

$insert = sprintf("insert into loc_res (loc_id, resource_id, building_id) " . 
	"values('%d','%d','%d')", $newid, $resourceid, $buildingid);
$result = $connect->query($insert);
if (!$result) die ($connect->error);

echo "The id of the newly inserted location is $newid\n";
?>
