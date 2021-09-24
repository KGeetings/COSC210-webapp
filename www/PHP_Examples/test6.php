<?php
$meals['breakfast'] = 'Walnut Bun';
$meals['lunch'] = 'Eggplant with Chili Sauce';
$amounts = array(3, 6);

print "For breakfast, I'd like $meals[breakfast] and for lunch, ";
print "I'd like $meals[lunch]. I want $amounts[0] at breakfast and ";
print "$amounts[1] at lunch.";
print '--------------\n';
$meals['Walnut Bun'] = '$3.95';
$hosts['www.example.com'] = 'web site';

print "A Walnut Bun costs {$meals['Walnut Bun']}.";
print "www.example.com is a {$hosts['www.example.com']}.";
?>