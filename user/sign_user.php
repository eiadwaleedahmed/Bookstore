<?php
require '../vendor/autoload.php';
$mydb = new \App\database();
$alert = new \App\alert();
$auth = new \App\auth();
$errors_signup = $auth->register("user_id", "users");
$errors_signin = $auth->login("users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="shortcut icon" href="../images/2.png" type="image/x-icon">

    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style1.css">
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="POST" action="sign_user.php">
                <h1> Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-instagram"></i></a>
                    <!-- <a href="#" class="icon"><i class="fa-brands fa-facebook"></i></a> -->
                    <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>
                </div>
                <span> or use your email for registeration </span>
                <input type="text" placeholder="Name" name="signup_name" >
                <?php
                if (!empty($errors_signup['name'])) {
                    $alert->printMessage($errors_signup['name'], "Danger");
                    unset($errors_signup['name']); // Remove the error after displaying
                }
                ?>
                <input type="text" placeholder="Email" name="signup_email" >
                <?php if (!empty($errors_signup['email'])) {
                    $alert->printMessage($errors_signup['email'], "Danger");
                    unset($errors_signup['email']); // Remove the error after displaying

                }
                ?>
                <input type="password" placeholder="Password" name="signup_password" >
                <?php if (!empty($errors_signup['password'])) {
                    $alert->printMessage($errors_signup['password'], "Danger");
                    unset($errors_signup['password']); // Remove the error after displaying

                }
                ?>
                <input type="number" placeholder="Phone number" name="signup_phone">
                <?php if (!empty($errors_signup['phone'])) {
                    $alert->printMessage($errors_signup['phone'], "Danger");
                    unset($errors_signup['phone']); // Remove the error after displaying

                } ?>
                <input type="date" placeholder="Birthday" name="signup_birthday">
                <?php if (!empty($errors_signup['birthday'])) {
                    $alert->printMessage($errors_signup['birthday'], "Danger");
                    unset($errors_signup['birthday']); // Remove the error after displaying

                } ?>
                <button name="register">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form class="signin" method="POST" action="">
                <h1> Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-instagram"></i></a>
                    <!-- <a href="#" class="icon"><i class="fa-brands fa-facebook"></i></a> -->
                    <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>
                </div>
                <span> or use your email and password</span>
                <input type="email" placeholder="Email" name="signin_email" >
                <?php if (!empty($errors_signin['email'])) {
                    $alert->printMessage($errors_signin['email'], "Danger");
                    unset($errors_signin['email']); // Remove the error after displaying

                }
                ?>
                <input type="password" placeholder="Password" name="signin_password" >
                <?php if (!empty($errors_signin['password'])) {
                    $alert->printMessage($errors_signin['password'], "Danger");
                    unset($errors_signin['password']); // Remove the error after displaying

                }
                ?>
                <a href="#">Forgot your password?</a>
                <button name="signin">Sign In</button>
            </form>
        </div>
        <div class="toogle-container">
            <div class="toogle">
                <important>
                    <div class="toogle-panel toogle-left">
                        <h1>Welcome back!</h1>
                        <p> continue reading and let yourself be inspired. </p> <button class="hidden" id="login">Sign
                            In</button>
                </important>
            </div>
            <div class="toogle-panel toogle-right">
                <h1>Hello, friend!</h1>
                <p>Embark on a journey to discover a world of literary wonders that will leave you spellbound. Sign up
                    now and unlock a treasure trove of books authored by talented writers. Immerse yourself in the magic
                    of storytelling and explore a multitude of genres that will capture your imagination.</p>
                <button class="hidden" id="register">Sign Up</button>
            </div>
        </div>
    </div>
    </div>
    <script src="../assets\js\al.js"></script>
</body>
</html>