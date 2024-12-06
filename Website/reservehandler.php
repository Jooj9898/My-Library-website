<?php
// Start the session
session_start(); 

// Connect to the database
require_once "connect_db.php";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
    // Ensure user is logged in
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['message'] = "Please log in to search for books.";
        header("Location: login.php");
        exit();
    }

    // Get POST data and sanitize inputs
    $bookTitle = isset($_POST['BookTitle']) ? trim($_POST['BookTitle']) : '';
    $author = isset($_POST['Author']) ? trim($_POST['Author']) : '';
    $category = isset($_POST['Category']) ? trim($_POST['Category']) : '';

    // Validate input
    if (empty($bookTitle) && empty($author) && empty($category)) {
        $_SESSION['message'] = "Please enter at least one search criterion.";
        header("Location: reserve.php");
        exit();
    }

    // Build the query
    $query = "SELECT books.*, categories.CategoryDescription AS CategoryName 
        FROM books
        LEFT JOIN categories ON books.category = categories.CategoryID
        WHERE ('$bookTitle' = '' OR lower(books.BookTitle) LIKE lower('%$bookTitle%')) 
          AND ('$author' = '' OR lower(books.Author) LIKE lower('%$author%')) 
          AND ('$category' = '' OR books.Category = '$category')
    ";

    // Pagination setup
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $rowsPerPage = 5;
    $offset = ($page - 1) * $rowsPerPage;

    // Get total results count
    $countQuery = "SELECT COUNT(*) as total 
        FROM books
        WHERE ('$bookTitle' = '' OR lower(BookTitle) LIKE lower('%$bookTitle%')) 
          AND ('$author' = '' OR lower(Author) LIKE lower('%$author%')) 
          AND ('$category' = '' OR Category = '$category')
    ";
    $countResult = $conn->query($countQuery);
    $totalRows = $countResult->fetch_assoc()['total'];
    $totalPages = ceil($totalRows / $rowsPerPage);

    // Append pagination to query
    $query .= " LIMIT $rowsPerPage OFFSET $offset";

    // Execute the search query
    $result = $conn->query($query);

    // Prepare data for output
    $books = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
    }

    // Save results and pagination to session for retrieval on the reserve page
    $_SESSION['search_results'] = $books;
    $_SESSION['pagination'] = [
        'total_pages' => $totalPages,
        'current_page' => $page
    ];

    // Redirect back to the reserve page
    header("Location: reserve.php");
    exit();
} 
else 
{
    $_SESSION['message'] = "Invalid access to the search handler.";
    header("Location: reserve.php");
    exit();
}

// Close the database connection
$conn->close();
