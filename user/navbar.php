<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>

<body>
    <main>
        <header>
            <div class="logo">
                <img src="../images/2.png" alt="" height="50px">
            </div>
            <nav>
                <ul class="sidebar">
                    <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26px"
                                viewBox="0 -960 960 960" width="26px" fill="#5f6368">
                                <path
                                    d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                            </svg> </a></li>
                    <li><a href="home.php"> Home</a></li>
                    <li><a href="user.php">Profile</a>
                        <ul class="submenu">
                            <li><a href="user.php">Account</a></li>
                            <li><a href="saved.php">Saved books</a></li>
                            <li><a href="purchased_books.php">Purchased Books</a></li>
                            <li><a href="wishlist.php">WishList</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <div class="containera">
                                <form method="GET" action="booklist.php">
                                    <div class="containera">
                                        <input checked="" class="checkboxa" type="checkbox">
                                        <div class="mainboxa">
                                            <div class="iconContainera">
                                                <svg viewBox="0 0 512 512" height="1em"
                                                    xmlns="http://www.w3.org/2000/svg" class="search_icona">
                                                    <path
                                                        d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <input class="search_inputa" name="search" placeholder="search" type="text">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </a>
                    </li>

                    <li><a href="cart.php"> Cart</a></li>
                    <li><a href="#section-wrapper"> Contact us</a></li>
                </ul>
                <ul>
                    <li class="hideOnMobile"><a href="home.php"> Home</a></li>
                    <li class="hideOnMobile"><a href="user.php">Profile</a>
                        <ul class="submenu">
                            <li><a href="user.php">Account</a></li>
                            <li><a href="saved.php">Saved books</a></li>
                            <li><a href="purchased_books.php">Purchased Books</a></li>
                            <li><a href="wishlist.php">WishList</a></li>
                        </ul>
                    </li>

                    


                    <li class="hideOnMobile"><a href="#">
                    <form method="GET" action="booklist.php">

                            <div class="containera">
                            <input checked="" class="checkboxa" type="checkbox">

                            <div class="mainboxa">
                                    <div class="iconContainera">
                                        <svg viewBox="0 0 512 512" height="1em" xmlns="http://www.w3.org/2000/svg"
                                            class="search_icona">
                                            <path
                                                d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z">
                                            </path>
                                        </svg>
                                    </div>
                                    <input class="search_inputa" name="search" placeholder="search" type="text">
                                </div>
                            </div>
                            </form>
                            </div>
                        </a></li>
                    <li class="hideOnMobile"><a href="cart.php"> Cart</a></li>
                    <li class="hideOnMobile"><a href="#section-wrapper"> Contact us</a></li>
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
</body>

</html>