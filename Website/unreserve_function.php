<?php
require_once "connect_db.php";
session_start();

    if (isset($_POST['unreserve_book'])) 
    {
        $isbn = $_POST['unreserve_book'];

        // Prepare the SQL query to update the "Reserved" status in the Books table
        $ReservedStatus = "UPDATE books SET Reserved = 'N' WHERE ISBN = '$isbn';";

        $RemoveFromReserve =  "DELETE FROM Reservations WHERE ISBN = '$isbn';";

        // Execute the query
        if ($conn->query($ReservedStatus) === TRUE && $conn->query($RemoveFromReserve) === TRUE  ) {
            // If the removal of reservation is successful, show a confirmation message
            header("Location: View_reservation.php?page=". $_SESSION['page']); // Redirect
            exit(); // stop execution of this script
        } else 
        {
            // If there was an error executing the query, show an error message
            echo "Error unreserving the book: " . $conn->error;
        }
    }
?>
