<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1.DTD/html1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang ="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
<link rel="stylesheet" href="styles.css">
<title>Blank</title>
</head>

<body>

<?php include "header.php";?>

<div class = "container">
    <div class = "search-container">

<p> Login </p>
<form method = "post" action = "purelogin.php"  class = "search-form">
    <p>Username:
        <input type="text" name="Username">
    </p>
    <p>Password:
        <input type="password" name="Password">
    </p>
    <p>
        <input type="submit" name="Add_New" value = "Login"/>
        <p>Don't have an account?<a href="register.php">Register here</a></p>
    </p>
   
</form>
</div>
    
<?php
    if (!isset($_SESSION))
    {
        // Restart session
        session_start();
        unset($_SESSION['user_id']);
    }
    
    // Display success or error message if it exists in session
    if (isset($_SESSION['message'])) 
    {
        // Display and clear message
        echo $_SESSION['message'];
        unset($_SESSION['message']); 
    }
    else
    {
        echo "Enter login details.";
    }
?>
</div>

<?php include "footer.php";?>

</body>
</html>