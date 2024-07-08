<?php
session_start();
require '../vendor/autoload.php';
$mydb = new \App\Database();
$alert = new \App\Alert();

if (!isset($_SESSION['user_id']) || $_SESSION['type'] != 'admin') {
  header("Location: ../index.php");
  exit();
}

if (!isset($_GET['id'])) {
    die("Author ID not specified.");
}
$author_id = (int)$_GET['id']; // Sanitize author ID

// Handle deletion request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_author'])) {
    // Check if the author has any associated books
    $sql_check_books = "
        SELECT COUNT(*) as book_count
        FROM `books`
        WHERE `author_id` = ?
    ";
    $stmt_check_books = $mydb->con->prepare($sql_check_books);
    $stmt_check_books->bind_param("i", $author_id);
    $stmt_check_books->execute();
    $stmt_check_books->bind_result($book_count);
    $stmt_check_books->fetch();
    $stmt_check_books->close();

    if ($book_count > 0) {
        $_SESSION['failed_delete'] = "This author has books associated with them. Please delete the author's books first.";
    } else {
        // Delete the author
        $sql_delete_author = "
            DELETE FROM `authors`
            WHERE `author_id` = ?
        ";
        $stmt_delete_author = $mydb->con->prepare($sql_delete_author);
        $stmt_delete_author->bind_param("i", $author_id);
        if ($stmt_delete_author->execute()) {
            $_SESSION['success_delete'] = "Author deleted successfully.";
            header('Location: writerinfo.php?id=' . $author_id);
            exit();
        } else {
            echo "Error deleting author: " . $stmt_delete_author->error;
        }
        $stmt_delete_author->close();
    }
}

// Fetch the author's details
$sql_select_author = "
    SELECT `author_id`, `username`, `email`, `image`, `birth_date`
    FROM `authors`
    WHERE `author_id` = ?
";
$stmt_select_author = $mydb->con->prepare($sql_select_author);
$stmt_select_author->bind_param("i", $author_id);
$stmt_select_author->execute();
$result_select_author = $stmt_select_author->get_result();

if ($result_select_author->num_rows === 0) {
    die("Author not found.");
}
$author = $result_select_author->fetch_assoc();
// Count the number of books by the author
$sql_count_books = "
    SELECT COUNT(*) as book_count
    FROM `books`
    WHERE `author_id` = ?
";
$stmt_count_books = $mydb->con->prepare($sql_count_books);
$stmt_count_books->bind_param("i", $author_id);
$stmt_count_books->execute();
$result_count_books = $stmt_count_books->get_result();
$book_count = $result_count_books->fetch_assoc()['book_count'];
$stmt_select_author->close();
$stmt_count_books->close();
$mydb->con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Writer's information</title>
  <link rel="shortcut icon" href="../images/2.png" type="image/x-icon">

  <link rel="stylesheet" href="../assets/css/writerinfo.css">
  <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css">
</head>

<body>
  
  <div class="wrapper">
    <div class="user-card">
      <div class="user-card-img">
      <img src="<?php echo '../images/authors_images/' . htmlspecialchars($author['image']); ?>" alt="<?php echo htmlspecialchars($author['username']); ?>">
      </div>
      <div class="user-card-info">
        <?php
        if(isset($_SESSION['success_delete'])){
          $alert->printMessage($_SESSION['success_delete'], "success");
          unset($_SESSION['success_delete']);
        }
        if(isset($_SESSION['failed_delete'])){
          $alert->printMessage($_SESSION['failed_delete'], "danger");
          unset($_SESSION['failed_delete']);
        }
            ?>
        <br>
        <h2><?php echo htmlspecialchars($author['username']) ?></h2>
        <p><span>Email:</span> <?php echo htmlspecialchars($author['email']) ?></p>
        <p><span>Birthdate:</span> <?php echo htmlspecialchars($author['birth_date']) ?></p>
        <p><span>Age:</span> <?php echo date_diff(date_create($author['birth_date']), date_create('today'))->y ?> Years old</p>
        <p><span>Books:</span> <?php echo $book_count ?> Books</p>
        
        <form method="post" action="">
          <input type="hidden" name="delete_author" value="1">
          <button type="submit" class="submit-btn">Delete</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
