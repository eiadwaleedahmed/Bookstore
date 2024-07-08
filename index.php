<?php
session_start();
require 'vendor/autoload.php';
$mydb = new \App\Database();
$alert = new \App\Alert();
$auth = new \App\auth();
$is_logged_in = isset($_SESSION['user_id']);
$_SESSION['failed'] = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['restricted']) && !$is_logged_in) {
    $_SESSION['failed'] = 'You must be logged in to perform this action.';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Writer's Corner</title>
    <link rel="shortcut icon" href="images/2.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/css/homepage.css">
    <link rel="stylesheet" href="assets/fontawesome-free-6.5.1-web/css/all.min.css">
</head>

<body>
    <?php
    if (isset($_SESSION['failed'])) {
        $alert->printMessage($_SESSION['failed'], "Danger");
        unset($_SESSION['failed']);
    }
    
    
    ?>
    <section class="heads">
        <main>
            <header>
            <div class="logo">
                <img src="images/2.png" alt="" height="50px">
            </div>
                <nav>
            <ul class="sidebar">
                <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26px" viewBox="0 -960 960 960" width="26px" fill="#5f6368">
                    <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                </svg></a></li>
                <li><?php if ($is_logged_in): ?><a href="user/home.php">Home</a><?php else: ?><a href="?restricted=true">Home</a><?php endif; ?></li>
                <li>
                    <a href="user/user.php">Profile</a>
                    <?php if ($is_logged_in): ?>
                        <ul class="submenu">
                            <li><a href="user/user.php">Account</a></li>
                            <li><a href="user/saved.php">Saved books</a></li>
                            <li><a href="user/purchased_books.php">Purchased Books</a></li>
                            <li><a href="user/wishlist.php">WishList</a></li>
                        </ul>
                    <?php else: ?>
                        <ul class="submenu">
                            <li><a href="?restricted=true">Account</a></li>
                            <li><a href="?restricted=true">Saved books</a></li>
                            <li><a href="?restricted=true">Purchased Books</a></li>
                            <li><a href="?restricted=true">WishList</a></li>
                        </ul>
                    <?php endif; ?>
                </li>
                <li><?php if ($is_logged_in): ?><a href="user/cart.php">Cart</a><?php else: ?><a href="?restricted=true">Cart</a><?php endif; ?></li>
                <li><?php if ($is_logged_in): ?><a href="#">Contact us</a><?php else: ?><a href="?restricted=true">Contact us</a><?php endif; ?></li>
            </ul>

            <ul>
                <li class="hideOnMobile"><?php if ($is_logged_in): ?><a href="user/home.php">Home</a><?php else: ?><a href="?restricted=true">Home</a><?php endif; ?></li>
                <li class="hideOnMobile"><?php if ($is_logged_in): ?><a href="user/user.php">Profile</a><?php else: ?><a href="?restricted=true">Profile</a><?php endif; ?>
                    <?php if ($is_logged_in): ?>
                        <ul class="submenu">
                            <li><a href="user/user.php">Account</a></li>
                            <li><a href="user/saved.php">Saved books</a></li>
                            <li><a href="user/purchased_books.php">Purchased Books</a></li>
                            <li><a href="user/wishlist.php">WishList</a></li>
                        </ul>
                    <?php else: ?>
                        <ul class="submenu">
                            <li><a href="?restricted=true">Account</a></li>
                            <li><a href="?restricted=true">Saved books</a></li>
                            <li><a href="?restricted=true">Purchased Books</a></li>
                            <li><a href="?restricted=true">WishList</a></li>
                        </ul>
                    <?php endif; ?>
                </li>
                <li class="hideOnMobile"><?php if ($is_logged_in): ?><a href="user/cart.php">Cart</a><?php else: ?><a href="?restricted=true">Cart</a><?php endif; ?></li>
                <li class="hideOnMobile"><?php if ($is_logged_in): ?><a href="#">Contact us</a><?php else: ?><a href="?restricted=true">Contact us</a><?php endif; ?></li>
                <li class="menu-button" onclick="showSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                    <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                </svg></a></li>
            </ul>
        </nav>
            </header>
        </main>
        <div class="text-box">
            <h1>Go beyond the realms of imagination</h1><br>
            
                    <div class="fancy-bg"></div>
                    <div class="search">
                        <svg viewBox="0 0 24 24" aria-hidden="true"
                            class="r-14j79pv r-4qtqp9 r-yyyyoo r-1xvli5t r-dnmrzs r-4wgw6l r-f727ji r-bnwqim r-1plcrui r-lrvibr">
                            <g>
                                <path
                                    d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <button class="close-btn" type="reset">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </label>
            </form>
            <p>Embark on a literary journey: Explore, create, and connect at our immersive Literary Oasis & Writer's
                Haven!
            </p>
            <div class="btncol">
                <a href="user/sign_user.php" class="more"> Signup as a User</a>
                <a href="user/sign_author.php" class="more"> Signup as a Writer</a>
            </div>
        </div>
    </section>
    <!---------------- menu--------- -->
    <section class="menu">
        <!-- <h1> Our menu</h1>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi qui,
in accusamus ipsam recusandae quas adipisci quia dolor officia itaque incidunt quae distinctio quam delectus, 
similique laborum debitis quaerat vitae!</p> -->
        <div class="new" id="new">
            <h2 class="main-title">Our Services</h2>
            <!-- <h1>Our Services</h1>  -->
            <div class="row">
                <div class="menu-col">
                    <h3>Dual-purpose platform </h3>
                    <P> Our online bookstore serves as a platform for both writers and readers. Writers can publish and
                        distribute their works, including novels, poetry collections, and academic texts, effectively
                        reaching their intended audience. Meanwhile, readers can enjoy a diverse selection of published
                        books across genres, ensuring a rich and enjoyable reading experience</P>
                </div>
                <div class="menu-col">
                    <h3> Interactive website</h3>
                    <P>Our website allows users to interact with their favorite books by expressing their preferences
                        through liking and providing feedback on the published work Writers can view this feedback,
                        enhancing their understanding of reader preferences and creating a better experience for both
                        writers and readers alike.</P>
                </div>
                <div class="menu-col">
                    <h3>Variety of Books</h3>
                    <p>Explore a wide range of books at our online bookstore, featuring classic and niche genres. We
                        prioritize quality and affordability to offer high-standard books at competitive prices. Every
                        purchase ensures value, whether you're diving into timeless favorites or the latest releases.
                    </p>
                </div>
            </div>
            <!----------- aboutus---------------- -->
            <section class="about">
                <div class="new" id="new">
                    <h2 class="main-title">Our Story</h2>
                    <!-- <h1> Our Story</h1> -->
                    <p>Welcome to Writer's corner, <br>
                        In 2024, Writer's Corner was founded , a platform dedicated to empowering writers and connecting
                        them with a global community of book enthusiasts. Recognizing the need for accessibility and
                        inclusivity in the evolving publishing landscape, the team set out to create a space where
                        writers of all backgrounds could freely express their creativity and share their stories.
                        Writer's Corner was built on the principles of creative freedom and collaboration. We as
                        founders understood the true power of literature in transcending boundaries and touching the
                        hearts and minds of diverse readers. Through active forums, author events, and reader-writer
                        interactions, they fostered a vibrant community where writers find support and readers discover
                        new literary experiences.
                        Today, Writer's Corner stands as a thriving online hub, offering a wide range of genres and
                        serving as a hub for writers and readers alike. The platform continues to evolve, driven by the
                        team's unwavering commitment to innovation, diversity, and the power of the written word.
                        Join us on this incredible journey as we celebrate the art of storytelling and the boundless
                        potential of the written word. Welcome to Writer's Corner – where your stories come to life.</p>
                    <br><br>
                    <div class="new" id="new">
                        <h2 class="main-title"> About Us</h2>
                        <!-- <h1> About Us</h1> -->
                        <p>
                            At Writer's Corner, our online bookstore serves as a dynamic hub that empowers writers and
                            enriches the lives of avid readers. We provide authors with the tools and support to
                            seamlessly publish and share their literary creations, spanning captivating novels,
                            thought-provoking poetry collections, and insightful academic texts.
                            For our discerning readers, we curate a diverse selection of high-quality books across a
                            wide range of genres, from timeless classics to cutting-edge niche works, all offered at
                            competitive and affordable prices. Uniquely, our platform encourages meaningful engagement,
                            allowing users to express their preferences and provide valuable feedback on published
                            content.
                            By leveraging this insightful reader input, our authors can enhance their understanding of
                            audience sentiments, fostering an enriched experience for both creators and consumers.
                            Driven by a steadfast commitment to quality and accessibility, every purchase at Writer's
                            Corner delivers exceptional value, ensuring our customers derive maximum satisfaction and
                            inspiration from their literary adventures.</p>
                        <!-- <div class="row">
<div class="about-col">
<img src="./images/photo_5798682913548648768_y.jpg" alt="">
<div class="layer">
<h3>london</h3>
</div>
</div>
-- ----------- --
<div class="about-col">
<img src="./images/photo_5798682913548648769_y.jpg" alt="">
<div class="layer">
<h3>New York</h3>
</div>
</div>
 ----------- --
<div class="about-col">
<img src="./images/photo_5798682913548648770_y.jpg" alt="">
<div class="layer">
<h3>San fransisco</h3>
</div>
</div>
</div> -->
            </section>
    </section>
    <script src="https://kit.fontawesome.com/bed00ed1d9.js" crossorigin="anonymous"></script>
</body>
<footer>
    <div class="container">
        <div class="sec quicklinks">
            <h2> About US</h2>
            <p>Here on our website, we offer a comprehensive platform that not only meets the users' need to read their
                favorite books but also provides support for writers to promote and share their work with a wider
                audience.</p>
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
            <?php if ($is_logged_in): ?>
        <li><a href="user/home.php">Home</a></li>
        <li><a href="user/cart.php">Cart</a></li>
        <li><a href="user/user.php">Profile</a></li>
        <li><a href="#">Contact Us</a></li>
    <?php else: ?>
        <li><a href="?restricted=true">Home</a></li>
        <li><a href="?restricted=true">Cart</a></li>
        <li><a href="?restricted=true">Profile</a></li>
        <li><a href="?restricted=true">Contact Us</a></li>
    <?php endif; ?>
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
                    <span><i class="fa-solid fa-envelope"></i></i></span>
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