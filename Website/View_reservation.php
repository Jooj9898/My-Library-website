<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reservations</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include "header.php"; ?>

    <div class="container">
        <?php
        require_once "connect_db.php";

        if (!isset($_SESSION)) {
            session_start();
        }

        echo "<h2>Your Reservations</h2>";
        if (!isset($_SESSION['user_id'])) 
        {
            echo "<p>Please <a href='login.php'>login</a> to view your reservations.</p>";
        } 
        else 
        {
            $username = $_SESSION['user_id'];

            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
            $_SESSION['page'] = $page;
            $rows_per_page = 3;
            $offset = ($page - 1) * $rows_per_page;

            $total_reservations_query = "SELECT COUNT(*) as total FROM reservations WHERE Username = '$username'";
            $result_total = $conn->query($total_reservations_query);
            $total_reservations = $result_total->fetch_assoc()['total'];
            $total_pages = ceil($total_reservations / $rows_per_page);

            $sql = "SELECT r.*, b.BookTitle 
                    FROM reservations r
                    JOIN books b ON r.ISBN = b.ISBN
                    WHERE r.Username = '$username'
                    LIMIT $rows_per_page OFFSET $offset";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<div class='book-list'>";
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='book-item'>
                        <p><strong>ISBN:</strong> " . $row["ISBN"] . "</p>
                        <p><strong>Book Title:</strong> " . $row["BookTitle"] . "</p>
                        <p><strong>Date Reserved:</strong> " . $row["ReservedDate"] . "</p>
                        <form action='unreserve_function.php' method='POST'>
                            <button type='submit' name='unreserve_book' value='" . $row["ISBN"] . "' class='button'>Unreserve</button>
                        </form>
                    </div>";
                }
                echo "</div>";
            } else {
                echo "<p>No reservations found on this page.</p>";
            }
            
        ?>

        <!-- Pagination -->
        <div class="pagination">
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    echo "<span class='current-page'>$i</span>";
                } else {
                    echo "<a class='page-link' href='View_reservation.php?page=$i'>$i</a>";
                }
            }
        }
            ?>
        </div>
    </div>

    <?php include "footer.php"; ?>
</body>
</html>
