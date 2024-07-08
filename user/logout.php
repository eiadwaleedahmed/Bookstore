<?php
if (isset($_GET['user_id'])) {
    unset($_SESSION['user_id']);
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
}
if (isset($_GET['author_id'])) {
    unset($_SESSION['author_id']);
    session_unset();
    session_destroy();
    header("Location: sign_author.php");
    exit();
}
?>