
<?php
session_start();
require '../vendor/autoload.php';
$mydb = new \App\Database();
$alert = new \App\Alert();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

$errors_discount = ['name' => '', 'email' => '', 'mobile' => '', 'message' => '', 'book_id' => ''];

if (isset($_POST['discount'])) {
    $name = mysqli_real_escape_string($mydb->con, $_POST['name']);
    $mobile = mysqli_real_escape_string($mydb->con, $_POST['mobile']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = mysqli_real_escape_string($mydb->con, $_POST['message']);
    $book_id = mysqli_real_escape_string($mydb->con, $_POST['book_id']);

    if (empty($name)) {
        $errors_discount['name'] = "Please enter your name.";
    }

    if (empty($email)) {
        $errors_discount['email'] = "Please enter a valid email address.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors_discount['email'] = "Invalid email format.";
    } else {
        if ($email != $_SESSION['email']) {
            $errors_discount['email'] = "User not found with the provided email.";
        }
    }

    if (empty($mobile)) {
        $errors_discount['mobile'] = "Please enter your mobile.";
    } elseif (!preg_match('/^[0-9]{11}$/', $mobile)) {
        $errors_discount['mobile'] = "Invalid phone number. Must be 11 digits.";
    }

    if (empty($message)) {
        $errors_discount['message'] = "Please enter your message.";
    }

    if (empty($book_id)) {
        $errors_discount['book_id'] = "Please choose the book.";
    }

    if (empty(array_filter($errors_discount))) {
        $query = "INSERT INTO discount_requests (user_id, book_id, reason, status) VALUES (?, ?, ?, 'pending')";
        $stmt = $mydb->con->prepare($query);
        $stmt->bind_param("iis", $_SESSION['user_id'], $book_id, $message);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Discount request submitted successfully!";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $_SESSION['failed_message'] = "Discount request submission failed.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}

$errors_contact = ['firstName' => '', 'lastName' => '', 'email' => '', 'phone' => '', 'message' => ''];
if (isset($_POST['contact'])) {
    $firstName = mysqli_real_escape_string($mydb->con, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($mydb->con, $_POST['lastName']);
    $email = mysqli_real_escape_string($mydb->con, $_POST['email']);
    $phone = mysqli_real_escape_string($mydb->con, $_POST['phone']);
    $message = mysqli_real_escape_string($mydb->con, $_POST['message']);
    if (empty($firstName)) {
        $errors_contact['firstName'] = "First Name is required.";
    }
    if (empty($lastName)) {
        $errors_contact['lastName'] = "Last Name is required.";
    }
    if (empty($email)) {
        $errors_contact['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors_contact['email'] = "Invalid email format.";
    } else {
        if ($email != $_SESSION['email']) {
            $errors_contact['email'] = "User not found with the provided email.";
        }
    }
    if (empty($phone)) {
        $errors_contact['phone'] = "Phone is required.";
    } elseif (!preg_match('/^[0-9]{11}$/', $phone)) {
        $errors_contact['phone'] = "Invalid phone number. Must be 11 digits.";
    }
    if (empty($message)) {
        $errors_contact['message'] = "Message cannot be empty.";
    }
    if (empty($errors_contact['firstName']) && empty($errors_contact['lastName']) && empty($errors_contact['email']) && empty($errors_contact['phone']) && empty($errors_contact['message']) && empty($errors_contact['userId'])) {
        $stmt = $mydb->con->prepare("INSERT INTO `contact_us` (`message`, `user_id`) VALUES (?, ?)");
        $stmt->bind_param("si", $message, $_SESSION['user_id']);
        if ($stmt->execute()) {
            $_SESSION['success_contact'] = "Message sent successfully!";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $_SESSION['failed_contact'] = "Contact us submission failed.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="shortcut icon" href="../images/2.png" type="image/x-icon">

    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css">
</head>

<body>
    <?php include 'navbar.php' ?>
    <div class="container">
        <h1>Book <span>Categories</span></h1>
        <div class="wrap">
            <img src="../images/left btn.png" id="btn1">
            <div class="bookTypes">
                <div class="type">
                    <?php
                    $query = "SELECT c.category_id, c.category_title, COUNT(b.book_id) AS NumberOfBooks 
                FROM categories c 
                LEFT JOIN books b ON c.category_id = b.category_id 
                WHERE status = 'accepted'
                GROUP BY c.category_id, c.category_title";

                    $stmt = $mydb->con->prepare($query);

                    if ($stmt) {
                        $stmt->execute();
                        $result = $stmt->get_result();

                        $category_icons = [
                            "artistic" => "fa-solid fa-palette",
                            "science" => "fa-sharp fa-solid fa-flask",
                            "horror" => "fa-solid fa-ghost",
                            "history" => "fa-solid fa-book-atlas",
                            "coding" => "fa-solid fa-code",
                            "romance" => "fa-solid fa-heart"
                        ];

                        while ($row = $result->fetch_assoc()) {
                            $category_id = htmlspecialchars($row['category_id']);
                            $category_title = htmlspecialchars($row['category_title']);
                            $icon_class = isset($category_icons[$category_title]) ? htmlspecialchars($category_icons[$category_title]) : "";
                            $num_books = htmlspecialchars($row['NumberOfBooks']);

                            echo '<div class="book">';
                            echo '<i class="' . $icon_class . '"></i>';
                            echo '<a href="booklist.php?category_id=' . $category_id . '">' . $category_title . '</a>';
                            echo '<p>' . $num_books . ' items</p>';
                            echo '</div>';
                        }

                        $stmt->close();
                    } else {
                        // Handle database error
                        echo "Error executing query: " . htmlspecialchars($mydb->con->error);
                    }
                    ?>
                </div>
            </div>
            <img src="../images/right btn .png" id="btn2">
        </div>
    </div>
    <div class="new" id="new">
        <h2 class="main-title">Recently Added</h2>
        <div class="container">
            <?php
            $query = "SELECT * FROM books WHERE status = 'accepted' ORDER BY publication_date DESC LIMIT 4 ";
            $stmt = $mydb->con->prepare($query);

            if ($stmt) {
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $book_id = htmlspecialchars($row['book_id']);
                        $image = htmlspecialchars($row['image']);
                        $title = htmlspecialchars($row['title']);
                        $type = htmlspecialchars($row['type']);
                        $price = htmlspecialchars($row['price']);


                        ?>
                        <div class="box">
                            <img src="<?php echo '../images/books_images/' . $image; ?>" alt="<?php echo $title; ?>">
                            <div class="content">
                                <h3><?php echo $title; ?></h3>
                                <p class="Free">$ <?php echo $price . " ";
                                echo $type; ?></p>
                            </div>
                            <div class="info">
                                <a href="bookprofile.php?book_id=<?php echo $book_id; ?>">Read More</a>
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<p>No new arrivals found.</p>';
                }
                $stmt->close();
            } else {
                // Handle database error
                echo "Error executing query: " . htmlspecialchars($mydb->con->error);
            }
            ?>
        </div>
    </div>
    <h2 class="main-title">DISCOUNT</h2>
    <div class="discount" id="discount">
        <div class="image">
            <div class="content">
                <h2>We Have A Discount</h2>
                <p>
                    Are you looking for a great deal on our books? You're in the right place! We are offering special
                    discounts on a selection of our best-selling titles as a form of financial aid for those who may not
                    have enough money to buy our books. Just fill out the form to request your discount and enjoy
                    savings on your next read. Don’t miss out on this limited-time offer!
                </p>
                <img decoding="async" src="../images/discount.png" alt="discount" />
            </div>
        </div>
        <div class="form">
            <div class="info">
                <h2>Request A Discount</h2>
                <?php
                if (isset($_SESSION['success_message'])) {
                    $alert->printMessage($_SESSION['success_message'], "Success");
                    unset($_SESSION['success_message']);
                } elseif (isset($_SESSION['failed_message'])) {
                    $alert->printMessage($_SESSION['failed_message'], "Danger");
                    unset($_SESSION['failed_message']);
                }
                ?>
                <form action="home.php" method="POST">
                    <input class="input" type="text" placeholder="Your Name" name="name" />
                    <?php if (!empty($errors_discount['name'])) {
                        $alert->printMessage($errors_discount['name'], "Danger");
                    } ?>
                    <input class="input" type="text" placeholder="Your Email" name="email" />
                    <?php if (!empty($errors_discount['email'])) {
                        $alert->printMessage($errors_discount['email'], "Danger");
                    } ?>
                    <input class="input" type="text" placeholder="Your Phone" name="mobile" />
                    <?php if (!empty($errors_discount['mobile'])) {
                        $alert->printMessage($errors_discount['mobile'], "Danger");
                    } ?>
                    <select class="input" name="book_id">
                        <option value="">Select a Book</option>
                        <?php
                        $query = "SELECT book_id, title FROM books WHERE status = 'accepted'";
                        $result = $mydb->con->query($query);
                        while ($row = $result->fetch_assoc()) {
                            $selected = isset($_POST['book_id']) && $_POST['book_id'] == $row['book_id'] ? 'selected' : '';
                            echo '<option value="' . $row['book_id'] . '"' . $selected . '>' . $row['title'] . '</option>';
                        }
                        ?>
                    </select>
                    <?php
                    if (!empty($errors_discount['book_id'])) {
                        $alert->printMessage($errors_discount['book_id'], "Danger");
                    }
                    ?>
                    <textarea class="input" placeholder="Tell Us About Your Needs" name="message"> </textarea>
                    <?php if (!empty($errors_discount['message'])) {
                        $alert->printMessage($errors_discount['message'], "Danger");
                    } ?>
                    <input type="submit" value="Send" name="discount" />
                </form>
            </div>
        </div>
    </div>
    <div class="new" id="new">
        <h2 class="main-title">BEST SELLER</h2>
        <div class="container">
            <?php
            $sql = "SELECT b.book_id, b.title, b.image, b.type, b.price, SUM(od.quantity)  AS total_sold
                FROM orderdetails od
                INNER JOIN books b ON od.book_id = b.book_id
                GROUP BY b.book_id, b.title, b.image
                ORDER BY total_sold DESC
                LIMIT 4";
            $stmt = $mydb->con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $book_id = htmlspecialchars($row["book_id"]);
                $title = htmlspecialchars($row["title"]);
                $image = htmlspecialchars($row["image"]);
                $type = htmlspecialchars($row['type']);
                $price = htmlspecialchars($row['price']);


                ?>
                <div class="box">
                    <img src="<?php echo '../images/books_images/' . $image; ?>" alt="<?php echo $title; ?>">
                    <div class="content">
                        <h3><?php echo $title; ?></h3>
                        <p class="Free">$ <?php echo $price . " ";
                        echo $type; ?></p>
                    </div>
                    <div class="info">
                        <a href="bookprofile.php?book_id=<?php echo $book_id; ?>">Read More</a>
                        <i class="fas fa-long-arrow-alt-right"></i>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <!--<div class="simple-heading">
            <h2>Contact Us</h2>
        </div>-->
    <section id="section-wrapper">
        <div class="box-wrapper">
            <h2 class="main-title">CONTACT US</h2>
            
            <div class="info-wrapper">
                <h2 class="info-title">contact information</h2>
                <p class="info-sub-title">Fill up the form and our team will get back to you within 24 hours</p>
                <ul class="info-details">
                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <span></span><a href="tel:01024730733">01024730733</a>
                    </li>
                    <li>
                        <i class="fas fa-paper-plane"></i>
                        <span></span><a href="mailto:writerscorner.76@gmail.com">writerscorner.77@gmail.com</a>
                    </li>
                    <li>
                        <i class="fas fa-globe"></i>
                        <span></span><a href="https://yoursite.com">yoursite.com</a>
                    </li>
                </ul>
                <ul class="social-icons">
                    <li>
                        <a href="#">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="form-wrap">
                <h2 class="form-title">Send us a message</h2>
                <?php if (!empty($errors_contact['firstName'])) {
                                $alert->printMessage($errors_contact['firstName'], "Danger");
                            }
                            ?>
                            <?php if (!empty($errors_contact['lastName'])) {
                                $alert->printMessage($errors_contact['lastName'], "Danger");
                            }
                            ?>
                            <?php if (!empty($errors_contact['email'])) {
                                $alert->printMessage($errors_contact['email'], "Danger");
                            }
                            ?>
                            <?php if (!empty($errors_contact['phone'])) {
                                $alert->printMessage($errors_contact['phone'], "Danger");
                            }
                            ?>
                            <?php if (!empty($errors_contact['message'])) {
                                $alert->printMessage($errors_contact['message'], "Danger");
                            }
                            ?>
                <?php
                if (isset($_SESSION['success_contact'])) {
                    $alert->printMessage($_SESSION['success_contact'], "Success");
                    unset($_SESSION['success_contact']);
                } elseif (isset($_SESSION['failed_contact'])) {
                    $alert->printMessage($_SESSION['failed_contact'], "Danger");
                    unset($_SESSION['failed_contact']);
                }
                ?>

                <form action="home.php" method="post">
                    <div class="form-fields">
                        <div class="form-group">
                            <input type="text" class="fname" placeholder="First Name" name="firstName">
                            
                        </div>
                        <div class="form-group">
                            <input type="text" class="lname" placeholder="Last Name" name="lastName" >
                            
                        </div>
                        <div class="form-group">
                            <input type="text" class="email" placeholder="Email" name="email" >
                            
                        </div>
                        <div class="form-group">
                            <input type="tel" class="phone" placeholder="Phone" name="phone" >
                            
                        </div>
                        <div class="form-group">
                            <textarea  placeholder="Write your message" name="message" > </textarea>
                            
                        </div>
                    </div>
                    <input type="submit" value="Send message" class="submit-button" name="contact">
                </form>
            </div>
        </div>
    </section>
    <script src="../assets/js/lo.js"></script>
    <?php include 'footer.php' ?>

</body>

</html>