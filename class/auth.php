<?php
namespace App;
class Auth
{
    public function register($fieldID, $table)
    {
        require '../vendor/autoload.php';
        $mydb = new \App\database();
        $alert = new \App\alert();
        $errors_signup = ['name' => '', 'email' => '', 'password' => '', 'phone' => '', 'birthday' => ''];
        if (isset($_POST['register'])) {
            $name = mysqli_real_escape_string($mydb->con, $_POST['signup_name']);
            $email = mysqli_real_escape_string($mydb->con, $_POST['signup_email']);
            $password = mysqli_real_escape_string($mydb->con, $_POST['signup_password']);
            $phone = mysqli_real_escape_string($mydb->con, $_POST['signup_phone']);
            $birthday = mysqli_real_escape_string($mydb->con, $_POST['signup_birthday']);
            if (empty($name)) {
                $errors_signup['name'] = "Please enter your name.";
            } elseif (strlen($name) < 3) {
                $errors_signup['name'] = "Name must be at least 3 characters long.";
            } elseif (strlen($name) > 50) {
                $errors_signup['name'] = "Name cannot exceed 20 characters.";
            } else {
                $selectname = "SELECT `$fieldID` FROM `$table` WHERE username = ?";
                $queryname = $mydb->con->prepare($selectname);
                $queryname->bind_param('s', $name);
                $queryname->execute();
                $resultname = $queryname->get_result();
                if ($resultname->num_rows > 0) {
                    $errors_signup['name'] = "Name already exists.";
                }
            }
            if (empty($email)) {
                $errors_signup['email'] = "Please enter your email.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors_signup['email'] = "Invalid email format.";
            } else {
                $selectemail = "SELECT `$fieldID` FROM `$table` WHERE email = ?";
                $queryemail = $mydb->con->prepare($selectemail);
                $queryemail->bind_param('s', $email);
                $queryemail->execute();
                $resultemail = $queryemail->get_result();
                if ($resultemail->num_rows > 0) {
                    $errors_signup['email'] = "Email already exists.";
                }
            }
            if (empty($password)) {
                $errors_signup['password'] = "Please enter a password.";
            } elseif (strlen($password) < 8) {
                $errors_signup['password'] = "Password must be at least 8 characters long.";
            } elseif (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/\d/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
                $errors_signup['password'] = "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
            }
            if (empty($phone)) {
                $errors_signup['phone'] = "Phone number is required.";
            } elseif (!preg_match('/^[0-9]{11}$/', $phone)) {
                $errors_signup['phone'] = "Invalid phone number format. Must be 11 digits.";
            }
            if (empty($birthday)) {
                $errors_signup['birthday'] = "Birthday is required.";
            }
            if (empty($errors_signup['email']) && empty($errors_signup['name']) && empty($errors_signup['password']) && empty($errors_signup['phone']) && empty($errors_signup['birthday'])) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $insert = "INSERT INTO `$table` (username, email, password, phone, birth_date) VALUES (?, ?, ?, ?, ?)";
                $query = $mydb->con->prepare($insert);
                $query->bind_param('sssss', $name, $email, $hashedPassword, $phone, $birthday);
                if ($query->execute()) {
                    $alert->printMessage("Registration successful.", "Success");
                } else {
                    $alert->printMessage("Registration failed. Please try again later.", "Danger");
                }
            }
            $mydb->closeConnection();
        }
        return $errors_signup;
    }
    public function login($table)
{
    session_start();
    require '../vendor/autoload.php';
    $mydb = new \App\database();
    $alert = new \App\alert();
    $errors_signin = ['email' => '', 'password' => ''];
    if (isset($_POST['signin'])) {
        $email = mysqli_real_escape_string($mydb->con, $_POST['signin_email']);
        $password = mysqli_real_escape_string($mydb->con, $_POST['signin_password']);
        if (!empty($email) && !empty($password)) {
            $select = "SELECT * FROM `$table` WHERE email = ?";
            $query = $mydb->con->prepare($select);
            $query->bind_param('s', $email);
            $query->execute();
            $result = $query->get_result();
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    
                    if ($table == 'users' && $user['type'] == 'user') {
                        $_SESSION['user_id'] = $user['user_id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['email'] = $user['email'];
                        header("Location: ../user/home.php");
                        exit;
                    } elseif ($table == 'users' && $user['type'] == 'admin') {
                        $_SESSION['user_id'] = $user['user_id'];
                        $_SESSION['type'] = $user['type'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['email'] = $user['email'];
                        header("Location: ../admin/homeadmin.php");
                        exit;
                    } elseif ($table == 'authors') {
                        $_SESSION['author_id'] = $user['author_id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['email'] = $user['email'];
                        header("Location: ../user/writer.php");
                        exit;
                    }
                } else {
                    $errors_signin['password'] = "Incorrect password. Please try again.";
                }
            } else {
                $errors_signin['email'] = "Incorrect email. Please try again.";
            }
        } else {
            $alert->printMessage("Please fill in all the fields.", "Danger");
        }
        $mydb->closeConnection();
    }
    return $errors_signin;
}
}
