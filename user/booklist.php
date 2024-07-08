<?php
require '../vendor/autoload.php';
$mydb = new \App\Database();
$alert = new \App\Alert();
$search_results = [];
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $stmt = $mydb->con->prepare("SELECT `book_id`, `title`, `author_id`, `category_id`, `description`, `price`, `publication_date`, `image`, `file`, `type`, `status` FROM `books` WHERE `title` LIKE ?");
    $search_param = "%" . $search . "%";
    $stmt->bind_param("s", $search_param);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $search_results[] = $row;
    }
    $stmt->close();
}
$mydb->con->close();
?>
<?php
session_start();
require '../vendor/autoload.php';
$mydb = new \App\database();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booklist</title>
    <link rel="shortcut icon" href="../images/2.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css">
</head>
<body>
<?php include 'navbar.php'?>
    <div class="simple-heading">
        <?php
        $category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : null;
        $sql_category = "SELECT `category_title` FROM `categories` WHERE `category_id` = ?";
        $stmt_category = $mydb->con->prepare($sql_category);
        $stmt_category->bind_param("i", $category_id);
        $stmt_category->execute();
        $result_category = $stmt_category->get_result();
        if ($result_category->num_rows > 0) {
            $row_category = $result_category->fetch_assoc();
            echo '<h2>' . $row_category['category_title'] . ' Books</h2>';
        } 
        $stmt_category->close();
        ?>
    </div>
    <div class="artist-list">
        <div class="container">
            <?php
            // Check if search results are available
            if (!empty($search_results)) {
                foreach ($search_results as $book) {
                    echo '<div class="box-list">';
                    echo '<img src="../images/books_images/' . $book['image'] . '" alt="">';
                    echo '<h3>' . $book['title'] . '</h3>';
                    echo '<p class="Free">$ ' . $book['price'] . " " . $book['type'] . '</p>';
                    echo '<div class="info">';
                    echo '<a href="bookprofile.php?book_id=' . $book['book_id'] . '">Read more</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                // Display books by category if no search results are found
                $sql_books = "SELECT book_id, image, title, type, price FROM books WHERE category_id = ? AND status = 'accepted'";
                $stmt_books = $mydb->con->prepare($sql_books);
                $stmt_books->bind_param("i", $category_id);
                $stmt_books->execute();
                $result_books = $stmt_books->get_result();
                while ($row = $result_books->fetch_assoc()) {
                    $book_id = $row['book_id'];
                    echo '<div class="box-list">';
                    echo '<img src="../images/books_images/' . $row['image'] . '" alt="">';
                    echo '<h3>' . $row['title'] . '</h3>';
                    echo '<p class="Free">$ ' . $row['price'] . " " . $row['type'] . '</p>';
                    echo '<div class="info">';
                    echo '<a href="bookprofile.php?book_id=' . $book_id . '">Read more</a>';
                    echo '</div>';
                    echo '</div>';
                }
                $stmt_books->close();
            }
            ?>
        </div>
    </div>
    <?php include 'footer.php'?>
</body>
</html>
