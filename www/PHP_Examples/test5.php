<?php
$courses = array('PHP', 'C', 'Java', 'Swift', 'C#', 'Scheme');
for ($i=0; $i < count($courses); $i++){
	print("$courses[$i]\n");
	}
print("Another form of looping\n");
foreach($courses as $item){
	print("$item \n");
}
?>