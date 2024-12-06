<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
	// Set values 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "labDb";
	
	// Create connection 
	$conn = new mysqli ($servername, $username, $password, $dbname);
	
	// Check connection 
	if ($conn->connect_error)
	{
		// Basically echo, but when an error fails 
		die("Connection failed: ". $conn->connect_error);
	}
	
	// SQL select statement
	$sql = "SELECT * FROM Product";
	
	// Attempt query
	$result = $conn->query($sql);
	
	// If data is returned
	if ($result->num_rows > 0) 
	{
		echo "<br><br>All The Product Info: <br>";
		
		// Output data of each row in product
		while($row = $result->fetch_assoc()) 
		{
			echo 	"Product ID: " . $row["ProductID"].
					" - PName: " . $row["PName"].
					" - Description: " . $row["Description"].#
					"- Price: " . $row["Price"].
					" - Stock: " . $row["Stock"].
					"<br>";
		} 
	}
	// Output no data
	else 
	{
		echo "0 results";
	}
	
	echo "<br><br><br>";
	
?>

<p>Go back to index<a href="index.php">Go here</a>.</p>
</body>
</html>