<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1.DTD/html1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang ="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
<title> Cities Question 2 </title>
</head>

<body>

	
	
<?php
	// Create array of ten largest Cities
	$largestCities = 
	["Japan" => "Tokyo", "Mexico" => "Mexico City", "USA" => "New York City",
"India" => "Mumbai", "Korea" => "Seoul", "China" => "Shanghai", "Nigeria" => "Lagos", "Argentina" => "Buenos Aires", "Egypt" => "Cairo", "England" => "London"];

	echo "Original Order: <br>";
	$index = 0;
	foreach ($largestCities as $key => $value) 
	{
		if ($index == sizeof($largestCities) - 1) echo $value . " is in " . $key;
		else echo $value . " is in " . $key . ", " . "<br>";
		$index++;
	}
	
?>



</body>
</html>