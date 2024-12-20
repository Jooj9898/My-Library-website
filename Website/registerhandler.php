
<?php
// Start the session
session_start(); 

// Connect to database
require_once "connect_db.php";

// Check if POST method used to access page
if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
	// Get POST data and place into variables
	$u = $_POST['Username'];
	$p = $_POST['Password'];
	$v = $_POST['ConfirmPassword'];
	$f = $_POST['FirstName'];
	$l = $_POST['Surname'];
	$h = $_POST['AddressLine1'];
	$i = $_POST['AddressLine2'];
	$c = $_POST['City'];
	$t = $_POST['Telephone'];
	$m = $_POST['Mobile'];
	
	// Check if user filled in all the data
	if (empty($u) || empty($p) || empty($v) || empty($f) || empty($l) || empty($h) || empty($i) || empty($c) || empty($t) || empty($m))
	{
		$_SESSION['message'] = "Registration Failed: Form not Complete";
			
		// Redirect to register
		header("Location: ../webd/register.php");
		exit(); // Stop further script execution
	}
	
	// Check if password is the same as confirm Password
	if ($p !== $v)
	{
		$_SESSION['message'] = "Registration Failed: Passwords do not match";
			
		header("Location: ../webd/register.php");
		exit(); // Stop further script execution
	}
	
	// Validate that both entered passwords are of length 6 or more (both are confirmed to be the same)
	if(strlen($p) != 6)
	{
		$_SESSION['message'] = "Registration Failed: Password must be 6 characters long";
			
		header("Location: ../webd/register.php");
		exit(); // Stop further script execution
	}
	
	// Validate that numbers is numeric and at least 10 characters
	if(!is_numeric($t) || !is_numeric($m))
	{
		$_SESSION['message'] = "Registration Failed: Numbers must be numeric";
			
		header("Location: ../webd/register.php");
		exit(); // Stop further script execution
	}
	if(strlen($t) != 10 || strlen($m) != 10)
	{
		$_SESSION['message'] = "Registration Failed: Numbers must be 10 characters long";
			
		header("Location: ../webd/register.php");
		exit(); // Stop further script execution
	}

	// Check if user already exists
	$check_sql = "SELECT * FROM users WHERE Username = '$u'";
	$result = $conn->query($check_sql);

	// Username duplicate
	if ($result->num_rows > 0) 
	{
		// If username exists, set the message and redirect to avoid resubmission
		$_SESSION['message'] = "Registration Failed: Username '" . $u . "'" . " already exists. Please enter a different username";
		
		// Redirect after unsuccessful insertion
		header("Location: ../webd/register.php");
		exit();
	} 
	
	// If username does not exist, proceed to insert
	else 
	{
		// Insert statement
		$sql = "INSERT INTO users (Username, Passkey, FirstName, Surname, AddressLine1, AddressLine2, City, Telephone, Mobile) VALUES ('$u', '$p', '$f', '$l', '$h', '$i','$c','$t','$m')";

		// Insert successful
		if ($conn->query($sql) === TRUE) 
		{
			//$_SESSION['message'] = "Successfully Registered User: " . $u;
			
			// Set user_id session variable for later validation
			$_SESSION['user_id'] = $u;
			
			// Redirect after successful insertion
			header("Location: ../webd/index.php");
			exit(); // Stop further script execution
			
		} 
		
		// Error with insert
		else 
		{
			$_SESSION['message'] = "<br><br> Error: " . $sql . "<br>" . $conn->error;
		}
	}
}

else
{
	$_SESSION['message'] = "Page access Denied.";
	
	// Redirect to register page after setting message
	header("Location: ../webd/register.php");
	exit(); // Stop further script execution
}

// Close connection
$conn->close();
?>
