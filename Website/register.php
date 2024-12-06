<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1.DTD/html1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang ="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
<link rel="stylesheet" href="styles.css">

<title>Register page</title>
</head>

<body>

<?php include "header.php";?>

<div class = "container">
    <div class = "search-container">
<p> Register </p>
<p> -Password must be exactly 6 characters - </p>
<p> -Phone numbers must be numeric and 10 characters maximum -</p>
<p> -Every field must have something in it -</p>
<form method = "post" action = "registerhandler.php">
    <p>Username:
        <input type="text" name="Username">
    </p>
    <p>Password:
        <input type="password" name="Password">
    </p>
    <p>Confirm Password:
        <input type="password" name="ConfirmPassword">
    </p>
    <p>First Name:
        <input type="text" name="FirstName">
    </p>
    <p>Surname:
        <input type="text" name="Surname">
    </p>
    <p>Address Line1:
        <input type="text" name="AddressLine1">
    </p>
    <p>Address Line2:
        <input type="text" name="AddressLine2">
    </p>
    <p>City:
        <input type="text" name="City">
    </p>
    <p>Telephone:
        <input type="text" name="Telephone">
    </p>
    <p>Mobile:
        <input type="text" name="Mobile">
    </p>
    <p>
        <input type="submit" name="Add_New" value = "Register"/>
    </p>
   
</form>
</div>

<p>Already have an account? <a href="login.php">Log in here</a>.</p>
    
   
<?php
    if (!isset($_SESSION))
    {
        // Restart session
        session_start();
        unset($_SESSION['user_id']);
    }
    else 
    {
    
    
        // Display success or error message if it exists in session
        if (isset($_SESSION['message'])) 
        {
            // Display and clear message
            echo $_SESSION['message'];
            unset($_SESSION['message']); 
        }
        else
        {
            echo "Please Fill in Form.";
        }
    }
?>

</div>
<?php include "footer.php";?>



