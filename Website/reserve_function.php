<?php

session_start();

require_once "connect_db.php";


    if (isset($_POST['reserve_book'])) {

    // Get the ISBN from the POST request
    $isbn = $_POST['reserve_book'];
    $username = $_SESSION['user_id'];


    // Prepare the SQL query to update the "Reserved" status in the Books table
    $ReservedStatus = "UPDATE books SET Reserved = 'Y' WHERE ISBN = '$isbn'";

    $addToReserve =  "INSERT INTO Reservations (Username, ISBN, ReservedDate) VALUES ('$username', '$isbn', CURDATE());";

    // Execute the query
    if ($conn->query($ReservedStatus) === TRUE && $conn->query($addToReserve) === TRUE  ) {
        // If the update is successful, show a confirmation message
       //$_SESSION['message'] = "Book successfully reserved";
       header("Location: reserve.php?page=". $_SESSION['page']);
        exit();
    } else {
        // If there was an error executing the query, show an error message
        echo "Error reserving the book: " . $conn->error;
    }
}

include "footer.php";
?>