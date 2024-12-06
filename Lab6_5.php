<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1.DTD/html1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang ="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
<title> Question 4</title>
</head>

<body>

	
	
<?php
	$ceu = array( "Italy"=>"Rome", "Luxembourg"=>"Luxembourg", "Belgium"=>
	"Brussels", "Denmark"=>"Copenhagen", "Finland"=>"Helsinki", "France" => "Paris",
	"Slovakia"=>"Bratislava", "Slovenia"=>"Ljubljana", "Germany" => "Berlin", "Greece"
	=> "Athens", "Ireland"=>"Dublin", "Netherlands"=>"Amsterdam",
	"Portugal"=>"Lisbon", "Spain"=>"Madrid", "Sweden"=>"Stockholm", "United
	Kingdom"=>"London", "Cyprus"=>"Nicosia", "Lithuania"=>"Vilnius", "Czech
	Republic"=>"Prague", "Estonia"=>"Tallin", "Hungary"=>"Budapest", "Latvia"=>"Riga",
	"Malta"=>"Valetta", "Austria" => "Vienna", "Poland"=>"Warsaw") ;

	asort($ceu);
	
	$index = 0;
	foreach ($ceu as $key => $value) 
	{
		if ($index == sizeof($ceu) - 1) echo $value . " is the Capital of " . $key;
		else echo $value . " is the Capital of " . $key . ", " . "<br>";
		$index++;
	}
	
?>



</body>
</html>