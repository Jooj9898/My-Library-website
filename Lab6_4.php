<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1.DTD/html1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang ="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
<title> Question 4</title>
</head>

<body>

	
	
<?php
	$index = 0;
	$my_array = array("T", "h", "i", "s", "i", "s", "!", "2", "1", "3");

	shuffle($my_array);
	
	echo 'Suggested Password: ';
	
	while ($index < sizeof($my_array))
	{
		echo $my_array[$index];
		$index++;
	}
?>



</body>
</html>