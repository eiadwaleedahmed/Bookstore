<?php
session_start();

// Ensure session is started properly
require '../vendor/autoload.php';
require '../vendor1/autoload.php';
use App\Alert;
use App\Database;
use Stripe\Stripe;
use Stripe\Exception\ApiErrorException;

$alert = new Alert();
$mydb = new Database();

// Check if total price is valid
if (!isset($_SESSION['total_price']) || !is_numeric($_SESSION['total_price']) || $_SESSION['total_price'] < 0) {
    $_SESSION['failed'] = "Invalid price amount.";
    header('Location: cart-payment.php');
    exit();
}

// Process payment if form fields are set
if (isset($_POST['email'], $_POST['username'], $_POST['stripeToken'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Validate username and email
    if (empty($username) || empty($email)) {
        $_SESSION['failed'] = "Please enter both username and email.";
        header('Location: cart-payment.php');
        exit();
    } else {
        try {
            // Set Stripe API key
            Stripe::setApiKey('sk_test_51PF2gXP3auuwP0Crp527NNKx3lCWTOw7eDtGhnAhikp9hWMhgWxu6NCwGmFcKJYL9nwyppgQwndopv0EQizisWfy00zO6bMyUK');

            // Create Stripe charge if total price is greater than zero
            if ($_SESSION['total_price'] > 0) {
                $charge = \Stripe\Charge::create([
                    'source' => $_POST['stripeToken'],
                    'amount' => $_SESSION['total_price'] * 100, // Amount in cents
                    'currency' => 'usd',
                ]);

                // Payment successful message
                $_SESSION['success'] = "Paid";
            } else {
                // If total price is zero, treat as paid without Stripe charge
                $_SESSION['success'] = "Paid (Total price is zero)";
            }

            // Assign variables for order insertion
            $price = $_SESSION['total_price'];
            $token = $_POST['stripeToken'];
            $user_id = $_SESSION['user_id'];
            $status = 'completed';
            $order_date = date('Y-m-d H:i:s');

            // Fetch cart items
            $stmt = $mydb->con->prepare("SELECT c.book_id, c.quantity, b.price, b.file FROM cart c JOIN books b ON c.book_id = b.book_id WHERE c.user_id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Initialize session variables for payment and files
            $_SESSION['payment'] = [];
            $_SESSION['files'] = [];

            // Store payment and files data from cart
            while ($row = $result->fetch_assoc()) {
                $_SESSION['payment'][] = ['book_id' => $row['book_id'], 'quantity' => $row['quantity']];
                $_SESSION['files'][] = "files/" . $row['file'];
            }
            $stmt->close();

            // Insert order data
            $insertOrder = $mydb->con->prepare("INSERT INTO orders (user_id, username, email, price, token, status, order_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $insertOrder->bind_param("issssss", $user_id, $username, $email, $price, $token, $status, $order_date);
            $insertOrder->execute();
            $order_id = $insertOrder->insert_id; // Get the last inserted order ID
            $insertOrder->close();

            // Insert order details
            foreach ($_SESSION['payment'] as $payment_item) {
                $book_id = $payment_item['book_id'];
                $quantity = $payment_item['quantity'];
                $insertDetails = $mydb->con->prepare("INSERT INTO orderdetails (order_id, book_id, quantity) VALUES (?, ?, ?)");
                $insertDetails->bind_param("iii", $order_id, $book_id, $quantity);
                $insertDetails->execute();
                $insertDetails->close();

                // Insert into purchased_books table
                $insertPurchased = $mydb->con->prepare("INSERT INTO purchased_books (user_id, book_id) VALUES (?, ?)");
                $insertPurchased->bind_param("ii", $user_id, $book_id);
                $insertPurchased->execute();
                $insertPurchased->close();
            }

            // Clear the cart
            $clearCart = $mydb->con->prepare("DELETE FROM cart WHERE user_id = ?");
            $clearCart->bind_param("i", $user_id);
            $clearCart->execute();
            $clearCart->close();

            $_SESSION['success'] = "Payment is completed successfully";
            header('Location: cart-payment.php');
            exit();
        } catch (ApiErrorException $e) {
            $alert->printMessage("Error: " . $e->getMessage(), "Danger");
        } catch (Exception $e) {
            $alert->printMessage("Error: " . $e->getMessage(), "Danger");
        }
    }
} else {
    // Print message if form fields are empty
    $_SESSION['failed'] = "One or more inputs are empty";
    header('Location: cart-payment.php');
    exit();
}
?>
