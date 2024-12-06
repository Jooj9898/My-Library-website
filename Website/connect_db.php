<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "reservebook";

    // Create connection 
    $conn = new mysqli ($servername, $username, $password, $dbname);

    // Check connection 
    if ($conn->connect_error)
    {
        // Basically echo, but when an error fails 
        die("Connection failed: ". $conn->connect_error);
    }
?>