<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1.DTD/html1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang ="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
<title> Cities Question 1</title>
</head>

<body>

	
	
<?php
	// Create array of ten largest Cities
	$largestCities = ["Tokyo", "Mexico City", "New York City",
"Mumbai", "Seoul", "Shanghai", "Lagos", "Buenos Aires", "Cairo", "London"];

	echo "Original Order: <br>";
	$index = 0;
	foreach ($largestCities as $item) 
	{
		if ($index == sizeof($largestCities) - 1) echo $item;
		else echo $item . ", ";
		$index++;
	}
	
	sort($largestCities);
	
	echo "<br>";
	echo "<br>";
	echo "<br>";
	
	echo "Sorted Order: <br>";
	$index = 0;
	foreach ($largestCities as $element) 
	{
		if ($index == sizeof($largestCities) - 1) echo $element;
		else echo $element . ", ";
		$index++;
	}
	
	echo "<br>";
	echo "<br>";
	echo "<br>";
	
	echo "Added new elements: <br>";
	
	$newElements = ["Los Angeles", "Calcutta", "Osaka", "Beijing"];
	
	$largestCities[] = "Los Angeles";
	$largestCities[] = "Calcutta";
	$largestCities[] = "Osaka";
	$largestCities[] = "Beijing";
	
	$index = 0;
	foreach ($largestCities as $element) 
	{
		if ($index == sizeof($largestCities) - 1) echo $element;
		else echo $element . ", ";
		$index++;
	}
	
	echo "<br>";
	echo "<br>";
	echo "<br>";
	
	
	echo "Resorted with new elements: <br>";
	
	sort($largestCities);
	
	$index = 0;
	foreach ($largestCities as $element) 
	{
		if ($index == sizeof($largestCities) - 1) echo $element;
		else echo $element . ", ";
		$index++;
	}
?>



</body>
</html>