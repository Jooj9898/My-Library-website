<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1.DTD/html1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
    <title>Book Search</title>
    <link rel="stylesheet" href="styles.css"> <!-- Reference to external stylesheet -->
</head>

<?php include "header.php";?>

<div class="container">
    <div class="search-container">
        <h2>Search for a book</h2>
        <?php
        if (!isset($_SESSION['user_id'])) 
        {
            echo "<p>Please <a href='login.php'>login</a> to search for books.</p>";
        } else {?>



        <form method="post" class="search-form">
            <div class="form-group">
                <label for="book-title">Book Title:</label>
                <input type="text" id="book-title" name="BookTitle" class="input-field" placeholder="Enter book title">
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" id="author" name="Author" class="input-field" placeholder="Enter author name">
            </div>
            <div class="form-group">
                <label for="categories">Category:</label>
                <select id="categories" name="Category" class="input-field">
                    <option value="">-- Please Select --</option>
                    <option value="001">Health</option>
                    <option value="002">Business</option>
                    <option value="003">Biography</option>
                    <option value="004">Technology</option>
                    <option value="005">Travel</option>
                    <option value="006">Self-Help</option>
                    <option value="007">Cookery</option>
                    <option value="008">Fiction</option>
                </select>
            </div>
            <div class="search-form">
                <button type="submit" name="Add_New" class="search-button">Search</button>
                <br></br>
            </div>
        </form>

    </div>

    <?php
    require_once "connect_db.php";

    if (!isset($_SESSION)) {
        // Restart session
        session_start();
    }
    if (isset($_SESSION['message'])) {
        // Display the message with a red background and error styling
        echo "<div class='handler-message' style='color: #d8000c; background-color: #ffbaba; border: 1px solid #d8000c; padding: 10px; border-radius: 5px;'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']); // Clear the message after displaying it
    }

    else 
    {
        if (isset($_POST['Add_New'])) {
            $u = $_POST['BookTitle'] ?? '';
            $p = $_POST['Author'] ?? '';
            $f = $_POST['Category'] ?? '';

            $_SESSION['BookTitle'] = $u;
            $_SESSION['Author'] = $p;
            $_SESSION['Category'] = $f;

            $page = 1;
        } else {
            $u = $_SESSION['BookTitle'] ?? '';
            $p = $_SESSION['Author'] ?? '';
            $f = $_SESSION['Category'] ?? '';
        }

        if (empty($u) && empty($p) && empty($f)) {
            // This part will trigger the session message if no search criteria are entered
            echo "Fill out at least one part of the form</p>"; 
        } else {
            $rows = 3;
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $rows;

            $count_sql = "SELECT COUNT(*) as total FROM books WHERE 
                ('$u' = '' OR lower(BookTitle) LIKE lower('%$u%')) 
                AND ('$p' = '' OR lower(Author) LIKE lower('%$p%')) 
                AND ('$f' = '' OR lower(Category) LIKE lower('%$f%'))";
            $count_result = $conn->query($count_sql);
            $row = $count_result->fetch_assoc();
            $total_rows = $row['total'];
            $total_pages = ceil($total_rows / $rows);

            $sql = "SELECT books.*, categories.CategoryDescription AS CategoryName 
                FROM books
                LEFT JOIN categories ON books.category = categories.CategoryID
                WHERE ('$u' = '' OR lower(BookTitle) LIKE lower('%$u%')) 
                AND ('$p' = '' OR lower(Author) LIKE lower('%$p%')) 
                AND ('$f' = '' OR lower(Category) LIKE lower('%$f%'))
                LIMIT $rows OFFSET $offset";

            $result = $conn->query($sql);

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
                    <p><strong>Reserved:</strong> " . $row["Reserved"] . "</p>";
                    

                    if ($row["Reserved"] == "N") {
                        echo "<form action='reserve_function.php' method='POST' style='display:inline;'>
                                <button type='submit' name='reserve_book' value='" . $row["ISBN"] . "' class='button'>Reserve Book</button>
                              </form><br><br>";
                    } else {
                        echo "<br><br>";
                    }
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "<p class='info-message'>No results found.</p>";
            }

            
            echo '<div class="pagination">';
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    echo "<span class='current-page'>$i</span>";
                } else {
                    echo "<a class='page-link' href='reserve.php?page=$i'>$i</a>";
                }
            }
            echo '</div>';
        }
    }

$conn->close();
}
?>

</div>

<?php include "footer.php"; ?>
</body>
</html>
