<?php
session_start();
require '../vendor/autoload.php';
$mydb = new \App\Database();
$alert = new \App\Alert();

if (!isset($_SESSION['user_id']) || $_SESSION['type'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['id'])) {
    $feedback_id = intval($_GET['id']);

    $sql = "DELETE FROM feedback WHERE feedback_id = ?";
    $stmt = $mydb->con->prepare($sql);
    $stmt->bind_param("i", $feedback_id);

    if ($stmt->execute()) {
        $_SESSION['success_delete'] = "Feedback deleted successfully.";
    } else {
        echo "Error deleting feedback: " . $mydb->con->error;
    }

    $stmt->close();
    header("Location: feedback.php"); // Redirect to the same page to show updated feedback list
    exit();
}

$sql = "SELECT users.username, users.email, books.title, feedback.comment, feedback.feedback_id, feedback.user_id, feedback.book_id
        FROM feedback
        JOIN users ON feedback.user_id = users.user_id
        JOIN books ON feedback.book_id = books.book_id";
$stmt = $mydb->con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
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
            <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26px" viewBox="0 -960 960 960" width="26px" fill="#5f6368">
                  <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                </svg> </a></li>
            <li><a href="homeadmin.php"> Home</a></li>
            <li><a href="viewwriters.php">Writers</a></li>
            <li><a href="books.php">Books</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="listorders.php">All orders</a></li>
            <li><a href="listusers.php">Users</a></li>
            <li><a href="logout.php?admin_id=<?php echo $_SESSION['user_id']; ?>">Log out</a></li>
          </ul>
          <ul>
            <li class="hideOnMobile"><a href="homeadmin.php"> Home</a></li>
            <li class="hideOnMobile"><a href="viewwriters.php">Writers</a></li>
            <li class="hideOnMobile"><a href="books.php"> Books</a></li>
            <li class="hideOnMobile"><a href="feedback.php"> Feedback</a></li>
            <li class="hideOnMobile"><a href="listorders.php">All Orders</a></li>
            <li class="hideOnMobile"><a href="listusers.php"> Users</a></li>
            <li class="hideOnMobile"><a href="logout.php?admin_id=<?php echo $_SESSION['user_id']; ?>"> Log out</a></li>
            <li class="menu-button" onclick="showSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                  <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                </svg></a></li>
          </ul>
        </nav>
      </header>
    </main>
  </section>
<?php
if(isset($_SESSION['success_delete'])){
  $alert->printMessage($_SESSION['success_delete'], "success");
unset($_SESSION['success_delete']);
}
?>
  <!-- Start of Filter -->
  <div class="filter">
    <ul class="fltr">
      <li><a href="#">Feedbacks</a></li>
    </ul>
  </div>
  <!-- End of Filter -->

  <div class="container">
    <div class="admin-table">
      <?php if ($result->num_rows > 0): ?>
        <table>
          <tr>
            <th class="t-head">Username</th>
            <th class="t-head">Email</th>
            <th class="t-head">Book</th>
            <th class="t-head">Message</th>
            <th class="t-head">Options</th>
          </tr>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td class="disc-1"><?php echo htmlspecialchars($row["username"]); ?></td>
              <td class="disc-1"><?php echo htmlspecialchars($row["email"]); ?></td>
              <td class="disc-1"><?php echo htmlspecialchars($row["title"]); ?></td>
              <td class="disc-1"><?php echo htmlspecialchars($row["comment"]); ?></td>
              <td class="disc-1"><a href="feedback.php?id=<?php echo htmlspecialchars($row['feedback_id']); ?>">Delete</a></td>
            </tr>
          <?php endwhile; ?>
        </table>
      <?php else: ?>
        <p>No feedback found.</p>
      <?php endif; ?>
      <?php
        $stmt->close();
        $mydb->con->close();
      ?>
    </div>
  </div>

  <script>
    function showSidebar() {
      const sidebar = document.querySelector('.sidebar');
      sidebar.style.display = 'flex';
    }
    function hideSidebar() {
      const sidebar = document.querySelector('.sidebar');
      sidebar.style.display = 'none';
    }
  </script>
</body>

</html>
