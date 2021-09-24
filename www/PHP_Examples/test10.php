<?php
  $temp = explode(' ', "This is a sentence with seven words");
  print_r($temp);

  $temp = explode('***', "A***sentence***with***asterisks");
  print_r($temp);

  $fname         = "Doctor";
  $sname         = "Who";
  $planet        = "Gallifrey";
  $system        = "Gridlock";
  $constellation = "Kasterborous";

  $contact = compact('fname', 'sname', 'planet', 'system', 'constellation');

  print_r($contact);
?>

