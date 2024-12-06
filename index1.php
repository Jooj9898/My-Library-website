<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"> <!-- Link to the external CSS file -->
    <title>Library Index</title>
</head>
<body>
<?php include "header.php"; ?>

<div class="container">
    <?php
    // Check if this is the user's first visit to index
    require_once "connect_db.php";

    if (!isset($_SESSION['user_id'])) {
        echo "<p class='login-prompt'>Please <a href='login.php'>login</a> to use the system.</p>";
    } else {
        echo "<h2>All the books in the library:</h2>";

        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $rows = 5;
        $offset = ($page - 1) * $rows;
        

        $count_sql = "SELECT COUNT(*) as total FROM books";
        $count_result = $conn->query($count_sql);
        $row = $count_result->fetch_assoc();
        $total_rows = $row['total'];
        $total_pages = ceil($total_rows /$rows);

        $sql = "SELECT books.*, categories.CategoryDescription AS CategoryName 
        FROM books
        LEFT JOIN categories ON books.category = categories.CategoryID
        LIMIT $rows OFFSET $offset";

        $result = $conn->query($sql);

        // If data is returned
        if ($result->num_rows > 0) {
            echo "<div class='book-list'>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='book-item'>
                    <p><strong>ISBN:</strong> " . $row["ISBN"] . "</p>
                    <p><strong>Book Title:</strong> " . $row["BookTitle"] . "</p>
                    <p><strong>Author:</strong> " . $row["Author"] . "</p>
                    <p><strong>Edition:</strong> " . $row["Edition"] . "</p>
                    <p><strong>Year Published:</strong> " . $row["YearPublished"] . "</p>
                    <p><strong>Category:</strong> " . $row["CategoryName"] . "</p>
                </div>";
            }
            echo "</div>";
            $conn->close();
        } else {
            echo "<p class='no-results'>No books found.</p>";
        }

        // Pagination links
        echo '<div class="pagination">';
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                echo "<span class='current-page'>$i</span>";
            } else {
                echo "<a class='page-link' href='index1.php?page=$i'>$i</a>";
            }
        }
        echo '</div>';
    }
    ?>
</div>

<?php include "footer.php"; ?>
</body>
</html>
