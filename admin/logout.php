<?php
if (isset($_GET['admin_id'])) {
    unset($_SESSION['admin_id']);
    session_unset();
    session_destroy();
    header("Location: ../user/sign_user.php");
    exit();
}
?>