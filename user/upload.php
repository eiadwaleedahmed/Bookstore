<?php
session_start();
require '../vendor/autoload.php';
$alert = new \App\Alert();

if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

$mydb = new \App\Database();

$errors = []; // Array to store validation errors

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate Title
    if (empty($_POST['title'])) {
        $errors['title'] = "Title is required";
    } elseif (strlen($_POST['title']) > 255) {
        $errors['title'] = "Title cannot exceed 255 characters";
    }

    // Validate Price
    if (empty($_POST['price'])) {
        $errors['price'] = "Price is required";
    } elseif (!is_numeric($_POST['price'])) {
        $errors['price'] = "Price must be a valid number";
    } elseif ($_POST['price'] < 0) {
        $errors['price'] = "Price cannot be negative";
    }

    // Validate Description
    if (empty($_POST['description'])) {
        $errors['description'] = "Description is required";
    }

    // Validate Category
    if (empty($_POST['category'])) {
        $errors['category'] = "Category is required";
    } else {
        // Validate category existence in the database
        $category_name = $_POST['category'];
        $sql_category = "SELECT category_id FROM categories WHERE category_title = ?";
        $stmt_category = $mydb->con->prepare($sql_category);
        $stmt_category->bind_param('s', $category_name);
        $stmt_category->execute();
        $result_category = $stmt_category->get_result();
        if ($result_category->num_rows == 0) {
            $errors['category'] = "Invalid category.";
        } else {
            $category_id = $result_category->fetch_assoc()['category_id'];
        }
        $stmt_category->close();
    }

    // Validate Book Cover upload
if (!isset($_FILES['book_cover']) || $_FILES['book_cover']['error'] !== UPLOAD_ERR_OK) {
    $errors['book_cover'] = "Failed to upload book cover.";
} else {
    $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($_FILES['book_cover']['type'], $allowedImageTypes)) {
        $errors['book_cover'] = "Invalid file type. Only JPEG, PNG, and GIF images are allowed.";
    } else {
        $bookCoverDir = 'images/books_images/';
        $bookCoverFile = $bookCoverDir . basename($_FILES['book_cover']['name']);
        if (!move_uploaded_file($_FILES['book_cover']['tmp_name'], '../' . $bookCoverFile)) {
            $errors['book_cover'] = "Failed to move uploaded file.";
        }
    }
}

// Validate PDF upload
if (!isset($_FILES['pdf']) || $_FILES['pdf']['error'] !== UPLOAD_ERR_OK) {
    $errors['pdf'] = "Failed to upload PDF.";
} else {
    $allowedPdfTypes = ['application/pdf'];
    if (!in_array($_FILES['pdf']['type'], $allowedPdfTypes)) {
        $errors['pdf'] = "Invalid file type. Only PDF files are allowed.";
    } else {
        $pdfDir = 'files/';
        $pdfFile = $pdfDir . basename($_FILES['pdf']['name']);
        if (!move_uploaded_file($_FILES['pdf']['tmp_name'], '../' . $pdfFile)) {
            $errors['pdf'] = "Failed to move uploaded file.";
        }
    }
}

    // If there are no validation errors, proceed with database insertion
    if (empty($errors)) {
        $title = $_POST['title'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $writer_name = $_SESSION['username'];

        // Retrieve author_id from the database
        $sql_author = "SELECT author_id FROM authors WHERE username = ?";
        $stmt_author = $mydb->con->prepare($sql_author);
        $stmt_author->bind_param('s', $writer_name);
        $stmt_author->execute();
        $result_author = $stmt_author->get_result();
        $author_id = $result_author->fetch_assoc()['author_id'];
        $stmt_author->close();

        // Determine book type and set status
        $type = ($price > 0) ? 'paid' : 'free';
        $status = 'pending';

        // Insert book details into the database
$sql = "INSERT INTO books (title, author_id, category_id, description, price, publication_date, image, file, type, status)
VALUES (?, ?, ?, ?, ?, NOW(), ?, ?, ?, ?)";
$stmt = $mydb->con->prepare($sql);
$stmt->bind_param('siissssss', $title, $author_id, $category_id, $description, $price, $_FILES['book_cover']['name'], $_FILES['pdf']['name'], $type, $status);

if ($stmt->execute()) {
$_SESSION['success_message'] = "Book uploaded successfully!";
header("Location: upload.php");
exit();
} else {
echo "Error: " . $stmt->error;
}
$stmt->close();
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/2.png" type="image/x-icon">

    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css">
    <title>Upload</title>
    
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
                    <li><a href="upload.php"> Add book</a></li>

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
    <div class="upload_form">
        <?php if (isset($_SESSION['success_message'])) {
                        $alert->printMessage($_SESSION['success_message'], "Success");
                        unset($_SESSION['success_message']);
                    } 
                ?>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <h2 class="upload_title">Let's upload from here</h2>
            <div class="form_super">
                <div class="form-sub">
                    <input type="text" name="title" class="title" placeholder="Title"  >
                    <?php 
                    if (!empty($errors['title'])): 
                    $alert->printMessage($errors['title'], "Danger");
                    endif; 
                    ?>
                </div>
                <div class="form-sub">
                    <input type="text" name="price" class="price" placeholder="Price"  >
                    <?php 
                    if (!empty($errors['price'])): 
                    $alert->printMessage($errors['price'], "Danger");
                    endif; 
                    ?>
                </div>
                <div class="form-sub">
                    <input type="text" name="description" class="description" placeholder="Description" rows="4" ></input>
                    <?php 
                    if (!empty($errors['description'])): 
                    $alert->printMessage($errors['description'], "Danger");
                    endif; 
                    ?>
                </div>
                <div class="form-sub">
                    <input type="text" name="category" class="category" placeholder="Category"  >
                    <?php 
                    if (!empty($errors['category'])): 
                    $alert->printMessage($errors['category'], "Danger");
                    endif; 
                    ?>
                </div>
                <div class="form-sub">
                    <input type="text" name="writer_name" class="writer_name" placeholder="Writer Name" placeholder="Writer Name" value="<?php echo $_SESSION['username']; ?>" readonly >
                </div>
                <div class="form-sub">
                    <h2 class="upload_sub_title">Upload the book cover</h2>
                    <input type="file" name="book_cover" class="book_cover" placeholder="Book Cover" >
                    <?php 
                    if (!empty($errors['book_cover'])): 
                    $alert->printMessage($errors['book_cover'], "Danger");
                    endif; 
                    ?>
                </div>
                <div class="form-sub">
                    <h2 class="upload_sub_title">Upload the PDF</h2>
                    <input type="file" name="pdf" class="pdf" placeholder="PDF" >
                    <?php 
                    if (!empty($errors['pdf'])): 
                    $alert->printMessage($errors['pdf'], "Danger");
                    endif; 
                    ?>
                </div>
            </div>
            <input type="submit" value="Upload" class="upload_button">
        </form>
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
                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
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
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Contact Us
                        </a></li>
                </ul>
            </div>
            <div class="sec contact">
                <h2> Contact Us</h2>
                <ul class="info">
                    <li>
                        <span><i class="fa-solid fa-phone"></i></span>
                        <p><a href="tel:01285611444">0128561144</a></p>
                    </li>
                    <li>
                        <span><i class="fa-solid fa-envelope"></i></span>
                        <p><a href="mailto:writerscorner551@gmail.com">writerscorner551@gmail.com</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    <div class="copyrighttext">
        <p>©Copyright 2024 writer'scorner. All rights reserved</p>
    </div>
</body>
</html>
