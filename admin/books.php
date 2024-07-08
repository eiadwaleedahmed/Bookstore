<?php
session_start();
require '../vendor/autoload.php';
$mydb = new \App\Database();
$alert = new \App\Alert();

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['type'] != 'admin') {
  header("Location: ../index.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['action'])) {
    $book_id = $_POST['book_id'];
    $action = $_POST['action'];
    if ($action == 'approve') {
      $new_status = 'accepted';
      $success_message = "Book approved successfully.";
    } elseif ($action == 'reject') {
      $new_status = 'rejected';
      $success_message = "Book rejected successfully.";
    } elseif ($action == 'delete') {
      $tables = ['cart', 'save', 'discount_requests', 'wishlist', 'purchased_books', 'orderdetails', 'feedback'];
      $book_exists_in_tables = false;
      foreach ($tables as $table) {
        $sql_check_book = "SELECT COUNT(*) as count FROM $table WHERE book_id = ?";
        $stmt_check_book = $mydb->con->prepare($sql_check_book);
        $stmt_check_book->bind_param("i", $book_id);
        $stmt_check_book->execute();
        $stmt_check_book->bind_result($count);
        $stmt_check_book->fetch();
        $stmt_check_book->close();
        if ($count > 0) {
          $book_exists_in_tables = true;
          break;
        }
      }
      if ($book_exists_in_tables) {
        $_SESSION['failed_delete'] = "This book cannot be deleted as it is referenced in one or more tables. Please ensure it is removed from all references before attempting to delete.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
      } else {
        $sql_delete_book = "DELETE FROM books WHERE book_id = ?";
        $stmt_delete_book = $mydb->con->prepare($sql_delete_book);
        $stmt_delete_book->bind_param("i", $book_id);

        if ($stmt_delete_book->execute()) {
          $_SESSION['success_delete'] = "Book deleted successfully.";
        } else {
          $_SESSION['failed_delete'] = "Error deleting book: " . $stmt_delete_book->error;
        }
        $stmt_delete_book->close();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
      }
    }

    // Update book status
    $sql_update_book_status = "UPDATE books SET status = ? WHERE book_id = ?";
    $stmt_update_book_status = $mydb->con->prepare($sql_update_book_status);
    $stmt_update_book_status->bind_param('si', $new_status, $book_id);

    if ($stmt_update_book_status->execute()) {
      $_SESSION['success_delete'] = $success_message;
    } else {
      $_SESSION['failed_delete'] = "Error updating book status: " . $stmt_update_book_status->error;
    }

    $stmt_update_book_status->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  }
}

// Fetch accepted books from the database
$sql_select_books = "SELECT book_id, title, image FROM books WHERE status = 'accepted'";
$stmt_select_books = $mydb->con->prepare($sql_select_books);
$stmt_select_books->execute();
$result_select_books = $stmt_select_books->get_result();

// Fetch pending books from the database
$sql_select_pending_books = "SELECT * FROM books WHERE status = 'pending'";
$stmt_select_pending_books = $mydb->con->prepare($sql_select_pending_books);
$stmt_select_pending_books->execute();
$result_select_pending_books = $stmt_select_pending_books->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Books</title>
  <link rel="shortcut icon" href="../images/2.png" type="image/x-icon">
  <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    * {
      padding: 0;
      margin: 0;
      text-decoration: none;
      list-style: none;
      box-sizing: border-box;
      font-family: 'Nunito', sans-serif;
    }

    body {
      line-height: 1.5;
      background-color: #eaeaea;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 95%;
      margin: auto;
      border-bottom: 1px solid #dbdbdb;
      padding: 10px 17px;
      background-color: transparent;
    }

    header ul li {
      display: inline-block;
      list-style: none;
      margin: 0 30px;
    }

    header ul li:last-child {
      margin-right: 0;
    }

    header ul li a {
      text-decoration: none;
      color: black;
      padding: 22px 0;
      display: inline-block;
      transition: all ease 0.3s;
      font-size: 18px;
      font-weight: bolder;
    }

    header ul li a:hover {
      color: #042c90;
    }

    header ul .submenu {
      position: absolute;
      width: 200px;
      background-color: #ffffff;
      box-shadow: 0 20px 45px #00000020;
      margin-top: -50px;
      opacity: 0;
      z-index: -999;
      transition: all ease 0.5s;
    }

    header ul li:hover .submenu {
      z-index: 99;
      opacity: 1;
      margin-top: 0;
    }

    header ul .submenu li {
      margin: 0;
      width: 100%;
    }

    header ul .submenu li a {
      padding: 15px 20px;
      display: inline-block;
      width: 100%;
    }

    header .logo {
      color: #000;
      font-weight: 600;
      font-size: 40px;
    }

    nav li:first-child {
      margin-right: auto;
    }

    .sidebar {
      position: fixed;
      top: 0;
      right: -250px;
      /* Initially hidden */
      height: 100vh;
      width: 250px;
      z-index: 999;
      background-color: white;
      backdrop-filter: blur(10px);
      box-shadow: -10px 0 10px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      justify-content: flex-start;
      transition: right 0.3s ease;
      /* Transition for smooth slide */
    }

    .sidebar.show {
      right: 0;
      /* Show the sidebar */
    }

    .menu-button {
      display: none;
      cursor: pointer;
      font-size: 30px;
      padding: 10px;
    }

    @media (max-width: 1221px) {
      .hideOnMobile {
        display: none;
      }

      .menu-button {
        display: block;
      }

      header {
        padding: 10px;
        width: 81%;
        margin: auto;
      }
    }

    @media (max-width: 917px) {
      header {
        padding: 10px;
        width: 104%;
        margin: auto;
      }
    }

    @media (max-width: 768px) {
      header {
        padding: 9px;
        width: 77%;
        margin: auto;
      }
    }

    @media (max-width: 425px) {
      .sidebar {
        width: 100%;
      }

      header .logo {
        color: #000;
        font-weight: 600;
        font-size: 31px;
      }

      header {
        padding: 9px;
        width: 70%;
        margin: auto;
      }
    }

    @media (max-width: 375px) {
      .sidebar {
        width: 100%;
      }

      header .logo {
        color: #000;
        font-weight: 600;
        font-size: 30px;
      }

      header {
        padding: 2px;
        width: 58%;
        margin: auto;
        padding-bottom: 3%;
      }
    }

    @media (max-width: 320px) {
      header {
        padding: 9px;
        width: 88%;
        margin: auto;
        padding-bottom: 7%;
      }
    }

    .filter ul li {
      list-style: none;
    }

    .card-containershop {
      position: relative;
      display: flex;
      justify-content: space-evenly;
      align-items: center;
      min-height: 70vh;
      gap: 20px;
      flex-wrap: wrap;
      background-color: #eaeaea;
    }

    .cardShop {
      position: relative;
      width: 300px;
      height: 220px;
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 35px 80px rgba(0, 0, 0, 0.15);
      transition: 0.5s;
      display: flex;
      margin-top: 11%;

    }

    /* .cardShop:hover {
  height: 270px;
} */

    .imgbx {
      left: 50%;
      top: -70px;
      transform: translateX(-50%);
      position: absolute;
      width: 160px;
      height: 160px;
      background: #000;
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.20);
      overflow: hidden;
      transition: 0.5;
    }

    .imgbx img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* .cardShop:hover .imgbx {
  width: 215px;
  height: 180px;
} */

    .cardShop .content {
      position: absolute;
      width: 100%;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-end;
      overflow: hidden;
    }

    .cardShop .content .details {
      margin-top: -231px;
      padding: 81px;
      text-align: center;
      width: 100%;
      transition: 0.5s;
      transform: translateY(150px);
    }

    .cardShop .content .data {
      font-size: 14px;
      transform: translateY(150px);
      text-overflow: ellipsis;
    }

    /* .cardShop:hover .content .details {
  transform: translateY(0px);
} */

    /* .cardShop:hover .content .data {
  transform: translateY(0px);
} */

    .cardShop .content .details h2 {
      font-size: 12px;
      padding: 20%;
      font-weight: 600;
      color: black;
      margin: -8%;
      margin-bottom: 5%;

    }

    .cardShop .content .details h2 span {
      font-size: 0.75em;
      font-weight: 500;
      opacity: 0.5;
    }

    .cardShop .content .details .data {
      display: flex;
      justify-content: space-between;
      margin: 20px 0;
    }

    .cardShop .content .details .data h3 {
      font-size: 1em;
      color: rgba(255, 255, 255, 0.2);
      line-height: 1.2em;
      font-weight: 600;
    }

    .cardShop .content .details .data h3 span {
      font-size: 0.85em;
      font-weight: 400;
      opacity: 0.5;
    }

    .cardShop .content .details .actionbtn {
      display: flex;
      justify-content: space-between;
      gap: 20px;
    }

    .cardShop .content .details .actionbtn button {
      padding: 10px 30px;
      border: none;
      outline: none;
      border-radius: 5px;
      font-size: 1em;
      font-weight: 500;
      background: #17388b;
      color: #fff;
      cursor: pointer;
    }

    .cardShop .content .details .actionbtn button:nth-child(2) {
      border: 1px solid grey;
      color: #bbbbbb;
      background: #fff;
    }

    h2 {
      justify-content: center;
    }

    .card-containershop .submit-btn {
      width: 122%;
      margin-top: -30px;
      padding: 10px;
      font-size: 20px;
      text-decoration: none;
      color: #17388b;
      background: transparent;
      cursor: pointer;
      transition: ease-out 0.5s;
      border: 2px solid #17388b;
      border-radius: 10px;
      box-shadow: inset 0 0 0 0 #17388b;
      align-items: center;
    }

    .card-containershop .submit-btn:hover {
      color: white;
      box-shadow: inset 0 -100px 0 0 #17388b;
    }

    @media (max-width: 395px) {
      .card-containershop {
        position: relative;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        min-height: 70vh;
        gap: 124px;
        flex-wrap: wrap;
      }

      .card-containershop .submit-btn {
        width: 100%;
        margin-top: -30px;
        padding: 10px;
        font-size: 20px;
        text-decoration: none;
        color: #17388b;
        background: transparent;
        cursor: pointer;
        transition: ease-out 0.5s;
        border: 2px solid #17388b;
        border-radius: 10px;
        box-shadow: inset 0 0 0 0 #17388b;
        align-items: center;
      }

      .filter {
        margin-bottom: -400px;
      }

      .imgbx {
        transform: translateX(-50%);
        width: 163px;
        height: 160px;
        background: #000;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.20);
        overflow: hidden;
        transition: 0.5;
      }

      .cardShop {
        position: relative;
        width: 300px;
        height: 220px;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 35px 80px rgba(0, 0, 0, 0.15);
        transition: 0.5s;
        display: flex;
      }
    }

    .searchBox {
      margin-bottom: 100px;
    }

    h1 {
      text-align: center;

    }

    .filter {
      margin-left: -79%;
      padding-top: 3%;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: center;
      /* width: 28%; */
      /* margin: auto; */
    }

    .filter ul {
      position: relative;
      display: flex;
      gap: 28px;
      align-items: center;
      text-align: center;
      margin-left: 42%;
    }

    .filter ul li {
      list-style: none;
    }

    .filter ul li a {
      position: relative;
      text-decoration: none;
      font-size: 1em;
      font-weight: 900;
      color: #000;
      text-transform: uppercase;
      letter-spacing: 0.2em;
    }

    .filter ul li a::before {
      content: '';
      position: absolute;
      bottom: -2px;
      width: 100%;
      height: 2px;
      background: #009EFD;

      transform: scalex(0);
      transition: transform 0.5s ease-in-out;
      transform-origin: right;

    }

    .filter ul li a:hover::before {
      transform: scaleX(1);
      transform-origin: left;
    }

    /* end of filter style  */
    @media (max-width:768px) {
      .container .admin-table {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        width: 112%;
        margin: 0 auto;
        text-align: center;
      }

      .filter {
        margin-left: -58%
      }

      @media (max-width:425px) {
        .container .admin-table {
          display: flex;
          flex-wrap: wrap;
          justify-content: center;
          width: 164%;
          margin: 0 auto;
          text-align: center;
        }

        .filter {
          margin-left: 45%;
        }
      }
    }

    @media (max-width: 1024px) {
      .card-containershop {
        position: relative;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        min-height: 53vh;
        gap: 20px;
        flex-wrap: wrap;
        background-color: #eaeaea;
      }
    }

    @media (max-width: 768px) {
      .card-containershop {
        min-height: 166vh;
        gap: 20px;
        flex-direction: column;
      }
    }

    @media (max-width: 425px) {
      .card-containershop {
        min-height: 156vh;
        gap: 20px;
        flex-direction: column;
        width: 65%;
        margin: auto;
      }
    }

    @media (max-width: 320px) {
      .card-containershop {
        min-height: 334vh;
        gap: 20px;
        flex-direction: column;
        width: 65%;
        margin: auto;
      }
    }

    @media (max-width: 375px) {
      .card-containershop {
        min-height: 156vh;
        gap: 20px;
        flex-direction: column;
        width: 78%;
        margin: auto;
      }

      .filter {
        margin-bottom: 20%;
      }
    }

    .firstbutton {

      display: flex;
      align-items: center;
      position: relative;
      padding: -5%;
      margin-right: 20px;
      padding-bottom: 37px;
    }

    .secondbutton {
      display: flex;
      align-items: center;
      position: relative;
      width: 100%;
      margin: -10px;
      margin-right: 30px;
      padding-bottom: 37px;
    }


    .card-containershop .button2 {
      gap: 37px;
      /* display: flex; */
      align-items: center;
      width: 54%;
      margin-left: -36px
    }


    form .firstbutton {

      display: flex;
      align-items: center;
      position: relative;
      width: 80%;
      margin: auto;
      /* margin: 8px;  */
    }
  </style>
</head>

<body>

  <section class="heads">
    <main>
      <header>
        <div class="logo">
          ADMIN
        </div>
        <nav>
          <ul class="sidebar">
            <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26px"
                  viewBox="0 -960 960 960" width="26px" fill="#5f6368">
                  <path
                    d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                </svg> </a></li>
            <li><a href="homeadmin.php"> Home</a></li>
            <li><a href="viewwriters.php">Writers</a></li>
            <li><a href="books.php">Books</a></li>
            <li><a href="Feedback.php">Feedback</a></li>
            <li><a href="listorders.php">All orders</a></li>
            <li><a href="listusers.php">Users</a></li>
            <li><a href="logout.php?admin_id=<?php echo $_SESSION['user_id']; ?>">Log out</a></li>
          </ul>
          <ul>
            <li class="hideOnMobile"><a href="homeadmin.php"> Home</a></li>
            <li class="hideOnMobile"><a href="viewwriters.php">Writers</a></li>
            <li class="hideOnMobile"><a href="books.php"> Books</a></li>
            <li class="hideOnMobile"><a href="Feedback.php"> Feedback</a></li>
            <li class="hideOnMobile"><a href="listorders.php">All Orders</a></li>
            <li class="hideOnMobile"><a href="listusers.php"> Users</a></li>
            <li class="hideOnMobile"><a href="logout.php?admin_id=<?php echo $_SESSION['user_id']; ?>"> Log out</a></li>
            <li class="menu-button" onclick="showSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg"
                  height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                  <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                </svg></a></li>
          </ul>
        </nav>
      </header>
    </main>
  </section>
  <?php
  if (isset($_SESSION['success_delete'])) {
    $alert->printMessage($_SESSION['success_delete'], "success");
    unset($_SESSION['success_delete']);
  }
  if (isset($_SESSION['failed_delete'])) {
    $alert->printMessage($_SESSION['failed_delete'], "Danger");
    unset($_SESSION['failed_delete']);
  }
  ?>
  <!-- start of filter  -->
  <div class="filter">
    <ul class="fltr">
      <li> <a href="#">Recently added Books</a></li>
    </ul>
  </div>
  <!-- end of the filter -->

  <!-- start of the cards -->
  <div class="card-containershop">
    <?php while ($row = $result_select_books->fetch_assoc()): ?>
      <div class="cardShop">
        <div class="imgbx">
          <img src="<?php echo '../images/books_images/' . $row['image']; ?>" alt="<?php echo $row['title']; ?>">
        </div>
        <div class="content">
          <div class="details">
            <div class="name">
              <h2><?php echo $row['title']; ?></h2>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
              <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
              <input type="hidden" name="action" value="delete">
              <input type="submit" value="Delete" class="submit-btn">
            </form>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>




























  <div class="filter">
    <ul class="fltr">
      <li> <a href="#">Pending Books</a></li>
    </ul>
  </div>
  <div class="card-containershop">
    <?php while ($row = $result_select_pending_books->fetch_assoc()): ?>
      <div class="cardShop">
        <div class="imgbx">
          
          <img src="<?php echo '../images/books_images/' . $row['image']; ?>" alt="<?php echo $row['title']; ?>">
        </div>
        <div class="content">
          <div class="details">
            <div class="name">
              <h2><?php echo $row['title']; ?></h2>
            </div>
            <div class="button2" style="display:flex;">
              <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="firstbutton">
                  <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
                  <input type="hidden" name="action" value="approve">
                  <input type="submit" value="Approve" class="submit-btn">
                </div>
              </form>
              <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="secondbutton">
                  <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
                  <input type="hidden" name="action" value="reject">
                  <input type="submit" value="Reject" class="submit-btn">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    <?php endwhile; ?>
  </div>
  </div>
  </div>

  <script>
    function showSidebar() {
      const sidebar = document.querySelector('.sidebar');
      sidebar.classList.add('show');
    }

    function hideSidebar() {
      const sidebar = document.querySelector('.sidebar');
      sidebar.classList.remove('show');
    }
  </script>
</body>

</html>
<?php
// Close prepared statements and database connection
$stmt_select_books->close();
$stmt_select_pending_books->close();
$mydb->con->close();
?>