<?php
session_start();
require '../vendor/autoload.php';
$mydb = new \App\Database();
$alert = new \App\Alert();

if (!isset($_SESSION['author_id'])) {
    die("Unauthorized access.");
}

if (isset($_POST['upload_image'])) {
    // Validate uploaded file
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['failed'] = "No file selected or error uploading file.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Validate file type
    $allowedImageTypes = array('image/jpeg', 'image/png', 'image/gif');
    if (!in_array($_FILES['image']['type'], $allowedImageTypes)) {
        $_SESSION['failed'] = "Invalid file type. Only JPEG, PNG, and GIF images are allowed.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Move uploaded file to destination directory
    $image = $_FILES['image']['name'];
    $temp_image = $_FILES['image']['tmp_name'];
    if (move_uploaded_file($temp_image, "../images/authors_images/$image")) {
        $author_id = $_SESSION['author_id'];
        $stmt_update = $mydb->con->prepare("UPDATE `authors` SET `image` = ? WHERE `author_id` = ?");
        $stmt_update->bind_param("si", $image, $author_id);
        if ($stmt_update->execute()) {
            $_SESSION['success'] = "Image uploaded successfully.";
        } else {
            $_SESSION['failed'] = "Error updating image in database.";
        }
        $stmt_update->close();
    } else {
        $_SESSION['failed'] = "Error moving uploaded file.";
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
    <title>Writer Profile</title>
    <link rel="shortcut icon" href="../images/2.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css">

</head>

<body>
    <main>
        <header>
            <div class="logo">

                <span> W</span>riter's Corner
            </div>
            <nav>
                <ul class="sidebar">
                    <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26px"
                                viewBox="0 -960 960 960" width="26px" fill="#5f6368">
                                <path
                                    d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                            </svg> </a></li>
                    <li><a href="writer.php"> Home</a></li>

                    </li>
                    <li><a href="user/upload.php"> Add book</a></li>

                    <li><a href="#"> Contact us</a></li>
                </ul>
                <ul>
                    <li class="hideOnMobile"><a href="writer.php"> Home</a></li>
                    <li class="hideOnMobile"><a href="upload.php"> Add book</a></li>

                    </li>
                    <li class="hideOnMobile"><a href="#"> Contact us</a></li>
                    <li class="menu-button" onclick="showSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg"
                                height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                                <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                            </svg></a></li>
                </ul>
            </nav>
        </header>
    </main>
    
    <div class="Profile-container">
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
        <div class="writer-profile">
            <div class="left">
                <?php
                $author_id = $_SESSION['author_id'];
                $stmt = $mydb->con->prepare("SELECT `username`, `email`, `birth_date`, `image` FROM `authors` WHERE `author_id` = ?");
                $stmt->bind_param("i", $author_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<img src='../images/authors_images/" . $row['image'] . "' alt=''>";
                    echo "<h5>Name: " . $row['username'] . "</h5>";
                    echo "<h5>Email: " . $row['email'] . "</h5>";
                    echo "<h5>Birthdate: " . $row['birth_date'] . "</h5>";
                }
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                    <h5>Lets upload from here</h5>
                    <input type="file" name="image">
                    <button type="submit" name="upload_image" class="button">Upload</button>

                </form>
                <hr>
                <a href="logout.php?author_id=<?php echo $author_id; ?>" class="log-out">Log out</a>
            </div>
        </div>
    </div>
    <div class="simple-heading">
        <h2>Book List</h2>
    </div>
    <div class="new" id="new">
        <div class="container">
            <?php
            $stmt_books = $mydb->con->prepare("SELECT * FROM `books` WHERE `author_id` = ? AND status = 'accepted'");
            $stmt_books->bind_param("i", $author_id);
            $stmt_books->execute();
            $result_books = $stmt_books->get_result();
            if ($result_books->num_rows > 0) {
                while ($book = $result_books->fetch_assoc()) {
                    echo "<div class='box'>";
                    echo "<img src='../images/books_images/" . $book['image'] . "' alt='image'>";
                    echo "<div class='content'>";
                    echo "<h3>" . $book['title'] . "</h3>";
                    echo "</div>";
                    echo "<div class='info'>";
                    echo '<a href="bookprofile.php?book_id=' . $book['book_id'] . '">Read more</a>';
                    echo "<i class='fas fa-long-arrow-alt-right'></i>";
                    echo "</div>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="sec quicklinks">
                <h2> About US</h2>
                <p>Here on our website, we offer a comprehensive platform that not only meets the users' need to read
                    their favorite books but also provides support for writers to promote and share their work with a
                    wider audience.</p>
                <ul class="sci">
                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="https://www.instagram.com/writerscorner66?igsh=aW56cTlpb2x4YTU0"><i
                                class="fa-brands fa-instagram"></i></a></li>
                    <!-- <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li> -->
                </ul>
            </div>
            <!-- <div class="sec quicklinks">
                <h2> Support</h2>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Cart</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">contact Us
                    </a></li>
                </ul>
            </div> -->
            <div class="sec quicklinks">
                <h2> Shop</h2>
                <ul>
                    <li><a href="writer.php">Home</a></li>
                    <li><a href="writer.php">Profile</a></li>
                    <li><a href="#">Contact Us
                        </a></li>
                </ul>
            </div>
            <div class="sec contact">
                <h2> Contact Us</h2>
                <ul class="info">
                    <li>
                        <span><i class="fa-solid fa-phone"></i></span>
                        <p><a href="tel:01024730733">01024730733</a></p>
                    </li>
                    <li>
                        <span><i class="fa-solid fa-envelope"></i></span>
                        <p><a href="mailto:writerscorner.77@gmail.com">writerscorner.77@gmail.com</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    <div class="copyrighttext">
        <p>©Copyright 2024 writer'scorner. All rights reserved</p>
    </div>
    <script>
        function showSidebar() {
            const sidebar = document.querySelector('.sidebar')
            sidebar.style.display = 'flex'
        }
        function hideSidebar() {
            const sidebar = document.querySelector('.sidebar')
            sidebar.style.display = 'none'
        }
    </script>
</body>

</html>