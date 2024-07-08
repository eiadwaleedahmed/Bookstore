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

$book_id = isset($_GET['book_id']) ? (int) $_GET['book_id'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : null;
    if (isset($_POST['book_id_wishlist']) && $user_id && $book_id) {
    
        // Check if the book is already in the wishlist
        $check_sql_wishlist = "SELECT COUNT(*) as count FROM wishlist WHERE user_id = ? AND book_id = ?";
        $check_stmt_wishlist = $mydb->con->prepare($check_sql_wishlist);
        $check_stmt_wishlist->bind_param('ii', $user_id, $book_id);
        $check_stmt_wishlist->execute();
        $check_result_wishlist = $check_stmt_wishlist->get_result();
        $check_row_wishlist = $check_result_wishlist->fetch_assoc();
    
        if ($check_row_wishlist['count'] > 0) {
            $_SESSION['failed_message_wishlist'] = "This book is already in your wishlist.";
        } else {
            // Insert the book into the wishlist
            $sql = "INSERT INTO wishlist (user_id, book_id) VALUES (?, ?)";
            $stmt_wishlist = $mydb->con->prepare($sql);
            $stmt_wishlist->bind_param('ii', $user_id, $book_id);
            if ($stmt_wishlist->execute()) {
                $_SESSION['success_message_wishlist'] = "Book added to wishlist successfully.";
            } else {
                $_SESSION['failed_message_wishlist'] = "Please try again.";
            }
            $stmt_wishlist->close();
        }
    
        $check_stmt_wishlist->close();
    

        
        // Redirect to the same page to avoid form resubmission
        header("Location: " . $_SERVER['PHP_SELF'] . "?book_id=$book_id");
        exit();
    }

    if (isset($_POST['book_id_save']) && $user_id && $book_id) {
// Check if the book is already in the save
$check_sql_save = "SELECT COUNT(*) as count FROM save WHERE user_id = ? AND book_id = ?";
$check_stmt_save = $mydb->con->prepare($check_sql_save);
$check_stmt_save->bind_param('ii', $user_id, $book_id);
$check_stmt_save->execute();
$check_result_save = $check_stmt_save->get_result();
$check_row_save = $check_result_save->fetch_assoc();

if ($check_row_save['count'] > 0) {
    $_SESSION['failed_message_save'] = "This book is already in your save.";
} else {
    // Insert the book into the save
    $sql_save = "INSERT INTO save (user_id, book_id) VALUES (?, ?)";
    $stmt_save = $mydb->con->prepare($sql_save);
    $stmt_save->bind_param('ii', $user_id, $book_id);
    if ($stmt_save->execute()) {
        $_SESSION['success_message_save'] = "Book added to save successfully.";
    } else {
        $_SESSION['failed_message_save'] = "Please try again.";
    }
    $stmt_save->close();
}

$check_stmt_save->close();
    // Redirect to the same page to avoid form resubmission
    header("Location: " . $_SERVER['PHP_SELF'] . "?book_id=$book_id");
    exit();
}
    if (isset($_POST['add_to_cart']) && $user_id && $book_id) {
        // Check if the book is already in the cart
        $sql_check_cart = "SELECT COUNT(*) FROM cart WHERE user_id = ? AND book_id = ?";
        $stmt_check_cart = $mydb->con->prepare($sql_check_cart);
        $stmt_check_cart->bind_param("ii", $user_id, $book_id);
        $stmt_check_cart->execute();
        $stmt_check_cart->bind_result($count);
        $stmt_check_cart->fetch();
        $stmt_check_cart->close();

        if ($count > 0) {
            $_SESSION['info_message_cart'] = "This book is already in your cart.";
        } else {
            // Insert the book into the cart
            $quantity = 1;
            $sql_insert_cart = "INSERT INTO cart (user_id, book_id, quantity, added_at) VALUES (?, ?, ?, NOW())";
            $stmt_insert_cart = $mydb->con->prepare($sql_insert_cart);
            $stmt_insert_cart->bind_param("iii", $user_id, $book_id, $quantity);
            if ($stmt_insert_cart->execute()) {
                $_SESSION['success_message_cart'] = "Book added to cart successfully!";
            } else {
                $_SESSION['failed_message_cart'] = "Error adding book to cart. Please try again later.";
            }
            $stmt_insert_cart->close();
        }

        header("Location: " . $_SERVER['PHP_SELF'] . "?book_id=$book_id");
        exit();
    }

    if (isset($_POST['send_feedback']) && $user_id && $book_id) {
        $feedback = trim($_POST['feedback']);
        if (empty($feedback)) {
            $alert->printMessage("Please enter your feedback.", "Danger");
        } else {
            $sql_feedback = "INSERT INTO feedback (user_id, book_id, comment) VALUES (?, ?, ?)";
            $stmt_feedback = $mydb->con->prepare($sql_feedback);
            $stmt_feedback->bind_param('iis', $user_id, $book_id, $feedback);
            if ($stmt_feedback->execute()) {
                $_SESSION['success_message_feedback'] = "We have received your feedback.";
            } else {
                $_SESSION['failed_message_feedback'] = "We couldn't receive your feedback. Please try again.";
            }
            header("Location: " . $_SERVER['PHP_SELF'] . "?book_id=$book_id");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/2.png" type="image/x-icon">

    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css">
    <title>Book Profile</title>
</head>

<body>

    <?php include 'navbar.php' ?>

    <div class="book-profile">
        <div class="container">
            <?php
            if ($book_id) {
                $sql_books = "SELECT book_id, image, title, author_id, description FROM books WHERE book_id = ?";
                $stmt_books = $mydb->con->prepare($sql_books);
                $stmt_books->bind_param("i", $book_id);
                $stmt_books->execute();
                $result_books = $stmt_books->get_result();
                if ($row = $result_books->fetch_assoc()) {
                    echo '<div class="book-image">
                                <img src="../images/books_images/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['title']) . '">
                        </div>';
                    echo '<div class="book-details">
                            <h1 class="book-title">' . htmlspecialchars($row['title']) . '</h1>';

                    $sql_authors = "SELECT author_id, username FROM authors WHERE author_id = ?";
                    $stmt_authors = $mydb->con->prepare($sql_authors);
                    $stmt_authors->bind_param("i", $row['author_id']);
                    $stmt_authors->execute();
                    $result_authors = $stmt_authors->get_result();
                    if ($author_row = $result_authors->fetch_assoc()) {
                        echo '<p>By: ' . htmlspecialchars($author_row['username']) . '</p>';
                    }

                    echo '<hr>';
                    
                    echo '<div class="order">
                                    <div class="cart-button">
                                    <form action="" method="POST">
                                        <button name="add_to_cart">Add to cart</button>
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </form>
                                    </div>
                                </div>';
                                if (isset($_SESSION['success_message_cart'])) {
                                    $alert->printMessage($_SESSION['success_message_cart'], "Success");
                                    unset($_SESSION['success_message_cart']);
                                } elseif (isset($_SESSION['failed_message_cart'])) {
                                    $alert->printMessage($_SESSION['failed_message_cart'], "Danger");
                                    unset($_SESSION['failed_message_cart']);
                                } elseif (isset($_SESSION['info_message_cart'])) {
                                    $alert->printMessage($_SESSION['info_message_cart'], "Danger");
                                    unset($_SESSION['info_message_cart']);
                                }
                    
                    echo '<div class="wish-list">
                        <form action="" method="post">
                            <input type="hidden" name="book_id_wishlist" value="<?php echo $book_id; ?>">
                            <button type="submit">
                                <i class="fa-solid fa-heart-circle-plus"></i>
                                Add to wishlist
                            </button>
                        </form>
                    </div>';
                    if (isset($_SESSION['success_message_wishlist'])) {
                        $alert->printMessage($_SESSION['success_message_wishlist'], "Success");
                        unset($_SESSION['success_message_wishlist']);
                    } elseif (isset($_SESSION['failed_message_wishlist'])) {
                        $alert->printMessage($_SESSION['failed_message_wishlist'], "Danger");
                        unset($_SESSION['failed_message_wishlist']);
                    }
                    
                    echo '<div class="save">
                        <form action="" method="post">
                            <input type="hidden" name="book_id_save" value="<?php echo $book_id; ?>">
                            <button type="submit">
                                <i class="fa-solid fa-bookmark"></i>
                                Add to save page
                            </button>
                        </form>
                    </div>';
                    if (isset($_SESSION['success_message_save'])) {
                        $alert->printMessage($_SESSION['success_message_save'], "Success");
                        unset($_SESSION['success_message_save']);
                    } elseif (isset($_SESSION['failed_message_save'])) {
                        $alert->printMessage($_SESSION['failed_message_save'], "Danger");
                        unset($_SESSION['failed_message_save']);
                    }
                    echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                } else {
                    echo "Book not found.";
                }
            }
            
            ?>

            <form action="" method="POST">
                <input type="text" class="email"
                    value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>"
                    readonly name="email">
                <textarea name="feedback" required></textarea>
                <input type="submit" value="Send your feedback" class="sent" name="send_feedback">
            </form>
            <?php
            if (isset($_SESSION['success_message_feedback'])) {
                $alert->printMessage($_SESSION['success_message_feedback'], "Success");
                unset($_SESSION['success_message_feedback']);
            } elseif (isset($_SESSION['failed_message_feedback'])) {
                $alert->printMessage($_SESSION['failed_message_feedback'], "Danger");
                unset($_SESSION['failed_message_feedback']);
            }
            ?>
        </div>
    </div>
    </div>
    <?php
    if ($book_id) {
        $sql_feedback = "SELECT u.username AS user_name, f.comment FROM feedback f INNER JOIN users u ON f.user_id = u.user_id WHERE f.book_id = ? LIMIT 8";
        $stmt_feedback = $mydb->con->prepare($sql_feedback);
        $stmt_feedback->bind_param("i", $book_id);
        $stmt_feedback->execute();
        $result_feedback = $stmt_feedback->get_result();
        echo '<div class="testimonials">';
        echo '<h2 class="main-title">Feedback</h2>';
        echo '<div class="container">';
        while ($row = $result_feedback->fetch_assoc()) {
            echo '<div class="box">';
            echo '<h3>' . htmlspecialchars($row['user_name']) . '</h3>';
            echo '<p>' . htmlspecialchars($row['comment']) . '</p>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    }


    ?>
    <?php include 'footer.php' ?>

</body>

</html>