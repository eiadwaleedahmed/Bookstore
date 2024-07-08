<?php
session_start();
require '../vendor/autoload.php';

$mydb = new \App\Database();
if (!isset($_SESSION['user_id']) || $_SESSION['type'] != 'admin') {
  header("Location: ../index.php");
  exit();
}

// Fetch user data
$sql_select_users = "SELECT * FROM `users` WHERE `type` = 'user' ORDER BY `user_id` DESC LIMIT 5";
$stmt_select_users = $mydb->con->prepare($sql_select_users);
$stmt_select_users->execute();
$result_select_users = $stmt_select_users->get_result();

// Fetch order data with joined book details
$sql_select_orders = "
    SELECT o.order_id, o.username, o.email, u.phone, b.image as book_cover, b.title as book_name, o.order_date, o.status
    FROM orders o
    JOIN users u ON o.user_id = u.user_id
    JOIN orderdetails od ON o.order_id = od.order_id
    JOIN books b ON od.book_id = b.book_id
    LIMIT 5
";
$stmt_select_orders = $mydb->con->prepare($sql_select_orders);
$stmt_select_orders->execute();
$result_select_orders = $stmt_select_orders->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Books</title>
  <link rel="shortcut icon" href="../images/2.png" type="image/x-icon">

  <link rel="stylesheet" href="../assets/css/homeadmin.css">
  <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css">
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

            <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26px"
                  viewBox="0 -960 960 960" width="26px" fill="#5f6368">
                  <path
                    d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                </svg> </a></li>
            <li><a href="homeadmin.php"> Home</a></li>
            <li><a href="viewwriters.php">writers</a></li>
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
            <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg"
                  height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                  <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                </svg></a></li>

          </ul>
        </nav>
      </header>

    </main>
  </section>
  <div>
    <!-- <div class="head-title">
      <div class="left">
           <h1>dashboard</h1>
            <ul class="breadcrumb">
                <li><a href="#">Dashboard</a>                </li>
                <li><i class="fa-solid fa-chevron-right"></i></li>
                <li><a href="#">Home</a></li>
            </ul>
       </div> -->

    <br>
    <br>
    <!--
    <li>
      <a href="#" class="btn-download"></a>
      <i class="fa-solid fa-chevron-right"></i>
    </li>
    <span class="text">download pdf</span>

  </div>

  <ul class="box-info">
    <li>
      <i class="fa-solid fa-chevron-right"></i>
      <span class="text">
        <h3>1030</h3>
        <p>new orders</p>
      </span>
    </li>
    <li>
      <i class="fa-solid fa-chevron-right"></i>
      <span class="text">
        <h3>2834</h3>
        <p> total Visitors</p>
      </span>
    </li>
    <li>
      <i class="fa-solid fa-chevron-right"></i>
      <span class="text">
        <h3>590</h3>
        <p>Total sales</p>
      </span>
    </li>
  </ul>
-->


    <!-- start of filter  -->
    <div class="filter">
      <ul class="fltr">
        <li> <a href="#">Recent Users</a></li>
        <!-- <li>  <a href="#">Clothes</a></li>
              <li>  <a href="#">eqhf</a></li>
              <li>  <a href="#">acc</a></li>
              <li>  <a href="#">ejfu</a></li>
              <li>  <a href="#">efjkiug</a></li> -->
      </ul>
    </div>
    <!-- end of the filter -->
    <div class="container">
      <div class="admin-table">
        <table>
          <tr>

            <th class="t-head">Name</th>
            <th class="t-head">Picture</th>
            <th class="t-head">Email address</th>
            <th class="t-head">Password</th>
            <th class="t-head">Date of birth</th>
            <th class="t-head">Phone number</th>
          </tr>
          <?php
          while ($row_select_users = $result_select_users->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='disc-1'>" . htmlspecialchars($row_select_users["username"]) . "</td>";
            echo "<td class='disc-1'><img src='" . htmlspecialchars('../images/users_images/' . $row_select_users["image"]) . "' alt='user Image' class='book-image' width='100' height='150'></td>";
            echo "<td class='disc-1'>" . htmlspecialchars($row_select_users["email"]) . "</td>";
            echo "<td class='disc-1'>" . htmlspecialchars($row_select_users["password"]) . "</td>";
            echo "<td class='disc-1'>" . htmlspecialchars($row_select_users["birth_date"]) . "</td>";
            echo "<td class='disc-1'>" . htmlspecialchars($row_select_users["phone"]) . "</td>";
            echo "</tr>";
          }
          $stmt_select_users->close();
          ?>

        </table>
      </div>
    </div>



    <!-- start of filter  -->
    <div class="filter">
      <ul class="fltr">
        <li> <a href="#">Recent Orders</a></li>

      </ul>
    </div>
    <!-- end of the filter -->
    <div class="container">
      <div class="admin-table">
        <table>
          <tr>


            <th class="t-head">Users'sname</th>
            <th class="t-head">Email </th>
            <th class="t-head"> Phone number</th>
            <th class="t-head">Book's cover</th>
            <th class="t-head">Book's name</th>

            <th class="t-head">Date</th>
            <th class="t-head">Status</th>


          </tr>
          <?php
          while ($row_select_orders = $result_select_orders->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='disc-1'>" . htmlspecialchars($row_select_orders["username"]) . "</td>";
            echo "<td class='disc-1'>" . htmlspecialchars($row_select_orders["email"]) . "</td>";
            echo "<td class='disc-1'>" . htmlspecialchars($row_select_orders["phone"]) . "</td>";
            echo "<td class='disc-1'><img src='" . htmlspecialchars('../images/books_images/' . $row_select_orders['book_cover']) . "' alt='Book cover' width='50px'></td>";
            echo "<td class='disc-1'>" . htmlspecialchars($row_select_orders["book_name"]) . "</td>";
            echo "<td class='disc-1'>" . htmlspecialchars($row_select_orders["order_date"]) . "</td>";
            echo "<td class='disc-1'>" . htmlspecialchars($row_select_orders["status"]) . "</td>";
            echo "</tr>";
          }
          $stmt_select_orders->close();
          ?>
        </table>
      </div>
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