<?php
require '../vendor/autoload.php';

$auth = new \App\Auth();
$alert = new \App\alert();

$errors_signup = $auth->register("author_id", "authors");


$errors_signin = $auth->login("authors");

?>

<?php

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
            <form method="POST" action="sign_author.php">

                <h1> Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-instagram"></i></a>
                    <!-- <a href="#" class="icon"><i class="fa-brands fa-facebook"></i></a> -->
                    <a href="" class="icon"><i class="fa-brands fa-google"></i></a>
                </div>
                <span> or use your email for registeration </span>
                <input type="text" placeholder="Name" name="signup_name" required>
                <?php if (!empty($errors_signup['name'])) {
                    $alert->printMessage($errors_signup['name'], "Danger");
                }
                ?>

                </span> <!-- Display name error -->
                <input type="email" placeholder="Email" name="signup_email" required>
                <?php if (!empty($errors_signup['email'])) {
                    $alert->printMessage($errors_signup['email'], "Danger");
                }
                ?>
                </span> <!-- Display email error -->
                <input type="password" placeholder="Password" name="signup_password" required>
                <?php if (!empty($errors_signup['password'])) {
                    $alert->printMessage($errors_signup['password'], "Danger");
                } ?>
                <input type="number" placeholder="Phone number" name="signup_phone">
                <?php if (!empty($errors_signup['phone'])) {
                    $alert->printMessage($errors_signup['phone'], "Danger");
                } ?>
                <input type="date" placeholder="Birthday" name="signup_birthday">
                <?php if (!empty($errors_signup['birthday'])) {
                    $alert->printMessage($errors_signup['birthday'], "Danger");
                } ?>
                </span> <!-- Display password error -->
                <button name="register">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form class="signin" method="POST" action="sign_author.php">

                <h1> Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-instagram"></i></a>
                    <!-- <a href="#" class="icon"><i class="fa-brands fa-facebook"></i></a> -->
                    <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>
                </div>
                <span> or use your email and password</span>
                <input type="email" placeholder="Email" name="signin_email">
                <?php if (!empty($errors_signin['email'])):
                    $alert->printMessage($errors_signin['email'], "Danger");
                endif; ?>

                <input type="password" placeholder="Password" name="signin_password">
                <?php if (!empty($errors_signin['password'])):
                    $alert->printMessage($errors_signin['password'], "Danger");
                endif; ?>
                
                <a href="#">Forgot your password?</a>
                <button name="signin">Sign In</button>
            </form>


        </div>
        <div class="toogle-container">
            <div class="toogle">
                <important>
                    <div class="toogle-panel toogle-left">
                        <h1>Welcome back!</h1>
                        <p> Ready to captivate your audience? Sign in now to share your latest creations with them and
                            leave a lasting impression. </p> <button class="hidden" id="login">Sign
                            In</button>
                </important>
            </div>
            <div class="toogle-panel toogle-right">
                <h1>Hello, friend!</h1>
                <p>We are excited to offer you a hassle-free way to publish and review all your books. By signing up for
                    an account, you can effortlessly share your work and connect with readers who will provide valuable
                    feedback to help you improve. You will get access to a platform where you can see all the comments
                    and reactions from your readers. Don't wait any longer! Create an account now and start sharing your
                    literary creations with the world!</p>
                <button class="hidden" id="register">Sign Up</button>
            </div>
        </div>
    </div>
    </div>
    <script src="../assets\js\al.js"></script>

</body>

</html>