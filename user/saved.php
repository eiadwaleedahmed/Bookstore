<?php
session_start();
require '../vendor/autoload.php';

$mydb = new \App\database();
$auth = new \App\auth();
$alert = new \App\alert();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT books.book_id, books.title, books.image 
        FROM save 
        JOIN books ON save.book_id = books.book_id 
        WHERE save.user_id = ?";

if ($stmt = $mydb->con->prepare($sql)) {
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $books = [];
    while ($row = $result->fetch_assoc()) {
            $books[] = $row;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Books</title>
    <link rel="shortcut icon" href="../images/2.png" type="image/x-icon">

    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css">
</head>

<body>
        
<?php include 'navbar.php'?>
<div class="new" id="new">
        <h2 class="main-title">Saved books</h2>
        <div class="container">
            <?php if (count($books) > 0): ?>
                <?php foreach ($books as $book): ?>
                    <div class="box">
                        <img src="<?php echo htmlspecialchars('../images/books_images/' . $book['image']); ?>" alt="image">
                        <div class="content">
                            <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                        </div>
                        <div class="info">
                            <a href="bookprofile.php?book_id= <?php echo $book['book_id'] ?>">Read more</a>
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?php
$alert->printMessage("<p>No books in Free books</p>", "Danger");
                ?>
            <?php endif; ?>
        </div>
    </div>
    
    <?php include 'footer.php'?>

</body>

</html>