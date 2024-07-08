<?php
session_start();
require '../vendor/autoload.php';
$mydb = new \App\Database();
$alert = new \App\Alert();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user data using MySQLi prepared statement
$stmt = $mydb->con->prepare("SELECT `username`, `email`, `image`, `birth_date` FROM `users` WHERE `user_id` = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    die("User not found.");
}

if (isset($_POST['upload_image'])) {
    // Validate uploaded file
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['upload_message_failed'] = "No file selected or error uploading file.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Validate file type
    $allowedImageTypes = array('image/jpeg', 'image/png', 'image/gif');
    if (!in_array($_FILES['image']['type'], $allowedImageTypes)) {
        $_SESSION['upload_message_failed'] = "Invalid file type. Only JPEG, PNG, and GIF images are allowed.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Move uploaded file to destination directory
    $image = $_FILES['image']['name'];
    $temp_image = $_FILES['image']['tmp_name'];
    if (move_uploaded_file($temp_image, "../images/users_images/$image")) {
        // Update database with new image path
        $stmt_update = $mydb->con->prepare("UPDATE `users` SET `image` = ? WHERE `user_id` = ?");
        $stmt_update->bind_param("si", $image, $user_id);
        if ($stmt_update->execute()) {
            $_SESSION['upload_message_success'] = "Image uploaded successfully.";
        } else {
            $_SESSION['upload_message_failed'] = "Error updating image in database.";
        }
        $stmt_update->close();
    } else {
        $_SESSION['upload_message_failed'] = "Error moving uploaded file.";
    }

    // Redirect back to the page
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="shortcut icon" href="../images/2.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css">
</head>
<body>
<?php include 'navbar.php'?>
    <div class="Profile-container">
    <?php
if (isset($_SESSION['upload_message_success'])) {
    $alert->printMessage($_SESSION['upload_message_success'], "Success");
    unset($_SESSION['upload_message_success']);
}
if (isset($_SESSION['upload_message_failed'])) {
    $alert->printMessage($_SESSION['upload_message_failed'], "Danger");
    unset($_SESSION['upload_message_failed']);

}

?>
        <div class="writer-profile">
            <div class="left">
                <img src='../images/users_images/<?php echo htmlspecialchars($user['image']); ?>' alt="Profile Picture">
                <h5>Name: <?php echo htmlspecialchars($user['username']); ?></h5>
                <h5>Email: <?php echo htmlspecialchars($user['email']); ?></h5>
                <h5>Birth Date: <?php echo htmlspecialchars($user['birth_date']); ?></h5>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                    <h5>Lets upload from here</h5>
                    <input type="file" name="image">
                    <button type="submit" name="upload_image" class="button">Upload</button>
                </form>
                <hr>
                <a href="logout.php?user_id=<?php echo $user_id; ?>" class="log-out">Log out</a>
            </div>
        </div>
    </div>
    <?php include 'footer.php'?>
</body>
</html>