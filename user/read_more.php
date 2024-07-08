<?php
session_start();
require '../vendor/autoload.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

$book_id = $_GET['book_id'];
$mydb = new \App\Database();
$user_id = $_SESSION['user_id'];

// Fetch book details
$sql = "SELECT * FROM books 
        INNER JOIN purchased_books ON books.book_id = purchased_books.book_id 
        WHERE books.book_id = ? AND purchased_books.user_id = ?";
$stmt = $mydb->con->prepare($sql);
$stmt->bind_param('ii', $book_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "You do not have access to this book.";
    exit();
}

$book = $result->fetch_assoc();
$title = htmlspecialchars($book['title']);
$description = htmlspecialchars($book['description']);
$file_path = "../files/" . $book['file'];  

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/2.png" type="image/x-icon">

    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css">
    <title><?php echo $title; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .book-details {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .book-details h1 {
            margin-top: 0;
            font-size: 2em;
            color: #333;
            text-align: center;
        }
        .book-details p {
            font-size: 1.1em;
            line-height: 1.6;
            color: #666;
            text-align: justify;
            width: 100%;
        }
        .pdf-viewer {
            margin-top: 20px;
            border: 1px solid #ddd;
        }
        iframe {
            border: none;
        }
    </style>
</head>
<body>
<?php include 'navbar.php' ?>

<div class="book-details">
    <h1><?php echo $title; ?></h1>
    <p><?php echo $description; ?></p>
    <div class="pdf-viewer">
        <iframe src="<?php echo $file_path; ?>" width="100%" height="500px"></iframe>
    </div>
</div>
<?php include 'footer.php' ?>

</body>
</html>