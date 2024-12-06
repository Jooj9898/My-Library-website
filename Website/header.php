<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        echo '<a class="logout" href="logout.php">Log out</a>';
        echo '<p class="username">Signed in as: ' . $_SESSION['user_id'] . '</p>';
    }
    ?>
    <h1>Justin's Library</h1>
    <nav class = navbar>
        <ul>    
            <li><a href="index.php">Homepage</a></li>
            <li><a href="reserve.php">Search</a></li>
            <li><a href="View_reservation.php">View Reservations</a></li>
        </ul>
    </nav>
</header>
</body>
</html>
