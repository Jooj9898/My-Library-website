<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1.DTD/html1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang ="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
<title> Text File Question 3 </title>
</head>

<body>

	
	
<?php

	// Access both files
	$file1 = fopen("Lab5.1.txt", "a+") or exit("Unable to open file 1!");
	$file2 = fopen("Lab5.2.txt", "r") or exit("Unable to open file 2!");
	
	echo "Old contents of File 1: <br>";
	
	// Print old contents
	while(!feof($file1))
	{
		echo fgets($file1). "<br>";
	}
	
	// Title
	echo "New contents of File 1: <br>";
	
	// Read all of file 2
	while(!feof($file2))
	{
		// Write lines to file 1
		fwrite($file1,fgets($file2));
	}
	
	// Reset cursor to start of file 1
	rewind($file1);
	
	// Re read file 1 with new info in it
	while(!feof($file1))
	{
		// Echo each line in editted file
		echo fgets($file1). "<br>";
	}
	
	// Close files
	fclose($file1);
	fclose($file2);
	
?>



</body>
</html>