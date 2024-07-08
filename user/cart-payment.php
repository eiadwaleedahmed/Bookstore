<?php
session_start();
require '../vendor/autoload.php';
require '../vendor1/autoload.php';
$mydb = new \App\database();
$auth = new \App\auth();
$alert = new \App\alert();
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
	<title>payment</title>
	<link rel="shortcut icon" href="../images/2.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css">
</head>
<body>
	<?php include 'navbar.php' ?>
<?php
if (isset($_SESSION['failed'])) {
    $alert->printMessage($_SESSION['failed'], "Danger");
    unset($_SESSION['failed']);
}
if (isset($_SESSION['success'])) {
    $alert->printMessage($_SESSION['success'], "success");
    unset($_SESSION['success']);
}
?>
	<div class="header">
	
		<div class="payment-container">
			<div class="left">
				<h3>Online Payment</h3>
				<form action="charge.php" method="post">
				<p>user name</p> 
				<input type="text" name="username" placeholder="Enter username">
					<p>email</p>
					<input type="text" name="email" placeholder="Enter Email">
					<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
						data-key="pk_test_51PF2gXP3auuwP0Cr9RKoxi1QXEPJht04h6fuvox7QsxxZvtEnO6iZDNbeqabgnaa67cCKpqqPNW4zpk8ZyeaNhHF00UTzbd2Lx"
						data-currency="usd" data-label="pay now">
						</script>
				</form>
			</div>
		</div>
	</div>
	<?php include 'footer.php' ?>
</body>
</html>