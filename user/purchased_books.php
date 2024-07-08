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
$sql = "SELECT books.* FROM books 
        INNER JOIN purchased_books ON books.book_id = purchased_books.book_id 
        WHERE purchased_books.user_id = ?";
$stmt = $mydb->con->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>purchased books</title>
    <link rel="shortcut icon" href="../images/2.png" type="image/x-icon">

    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css">
</head>

<body>
    <?php include 'navbar.php' ?>

    <div class="new" id="new">
    <h2 class="main-title">Purchased Books</h2>
    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $title = htmlspecialchars($row['title']);
                $image = htmlspecialchars('../images/books_images/' . $row['image']); 
                $book_id = $row['book_id'];
        ?>
                <div class="box">
                    <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
                    <div class="content">
                        <h3><?php echo $title; ?></h3>
                    </div>
                    <div class="info">
                        <a href="read_more.php?book_id=<?php echo $book_id; ?>">Read More</a>
                        <i class="fas fa-long-arrow-alt-right"></i>
                    </div>
                </div>
        <?php
            }
        } else {
            
                                $alert->printMessage("<p>You have not purchased any books yet.</p>", "Danger");

                
        }
        ?>
    </div>
</div>

<?php
$stmt->close();
?>
    <?php include 'footer.php' ?>

</body>

</html>