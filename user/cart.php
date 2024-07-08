<?php
session_start();
require '../vendor/autoload.php';
$auth = new \App\Auth();
$alert = new \App\Alert();
$mydb = new \App\Database();
// Ensure the user is authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
$user_id = $_SESSION['user_id'];
// Handle cart updates
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['remove'])) {
        $cart_id = $_POST['cart_id'];
        $stmt = $mydb->con->prepare("DELETE FROM cart WHERE cart_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $cart_id, $user_id);
        if($stmt->execute()){
            $_SESSION['success_message_delete'] = "Book deleted from cart successfully!";

        }        $stmt->close();
    }  elseif (isset($_POST['checkout_all'])) {
        header("Location: cart-payment.php");
        exit();
    } elseif (isset($_POST['continue'])) {
        header("Location: home.php");
        exit();
    }
    header("Location: cart.php");
    exit();
}
// Fetch cart items for display
$stmt = $mydb->con->prepare("SELECT c.cart_id, c.book_id, c.quantity, b.price, b.title, b.author_id, b.image, a.username FROM cart c JOIN books b ON c.book_id = b.book_id JOIN authors a ON b.author_id = a.author_id WHERE c.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$total_price = 0;
$cart_items = [];
while ($row = $result->fetch_assoc()) {
    $total_price += $row['price'] * $row['quantity'];
    $cart_items[] = $row;
    // Append an associative array containing price and quantity to $_SESSION['payment']
    $_SESSION['payment'][] = ['book_id' => $row['book_id'], 'quantity' => $row['quantity']];
}
$_SESSION['total_price'] = $total_price;
$stmt->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link rel="shortcut icon" href="../images/2.png" type="image/x-icon">

    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css">
</head>
<body>
<?php include 'navbar.php'?>
    <div class="cart-page">
    <?php
            if (empty($cart_items)) {
                $alert->printMessage("<p>Your cart is empty.</p>", "Danger");

            }
            ?>
        <table>
            <?php
            if (isset($_SESSION['success_message_delete'])) {
                $alert->printMessage($_SESSION['success_message_delete'], "Success");
                unset($_SESSION['success_message_delete']);
            }
            ?>
            <tr>
                <th>Book</th>
                <th>Price</th>
            </tr>
            
            <?php foreach ($cart_items as $item): 
                ?>
            <tr>
                <td>
                    <div class="cart-info">
                    <img src="<?php echo '../images/books_images/' . htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                        <div>
                        <p><?php echo htmlspecialchars($item['title']); ?></p>
                            <p>By: <?php echo htmlspecialchars($item['username']); ?></p>
                            <br>
                            
                        </div>
                    </div>
                </td>
                
                                <td>$<?php echo htmlspecialchars($item['price']); ?></td>
                
                <td>
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="cart_id" value="<?php echo htmlspecialchars($item['cart_id']); ?>">
                        <button type="submit" name="remove">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        
        <p>Total price: <?php echo $total_price?></p>
        <div class="main-button">
        <form method="POST">
            <button type="submit" name="checkout_all">Checkout</button>
            <button name="continue">Continue Shooping</button>
        </form>
        </div>
    </div>
    <?php include 'footer.php'?>
</body>
</html>



