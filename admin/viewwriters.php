<?php
session_start();
require '../vendor/autoload.php';

$mydb = new \App\database();
if (!isset($_SESSION['user_id']) || $_SESSION['type'] != 'admin') {
  header("Location: ../index.php");
  exit();
}

$sql_select_authors = "SELECT author_id, username, email, password, phone, image, birth_date FROM authors";
$stmt_select_authors = $mydb->con->prepare($sql_select_authors);
$stmt_select_authors->execute();
$result_select_authors = $stmt_select_authors->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Writers</title>
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
      right: -250px; /* Initially hidden */
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
      transition: right 0.3s ease; /* Transition for smooth slide */
    }

    .sidebar.show {
      right: 0; /* Show the sidebar */
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
  .filter ul{
    position: relative;
    display: flex;
    gap: 28px;
    align-items: center;
    text-align: center;
    margin-left: 42%;
  }
  .filter ul li{
    list-style: none;
  }
  .filter ul li a{
    position: relative;
    text-decoration: none;
    font-size: 1em;
    font-weight: 900;
    color: #000;
    text-transform: uppercase;
    letter-spacing: 0.2em;
  }
  .filter ul li a::before{
    content: '';
    position: absolute;
    bottom: -2px;
    width: 100%;
    height: 2px;
    background: #009EFD;
  
    transform: scalex(0);
    transition:transform 0.5s ease-in-out;
    transform-origin: right;
  
  }
  .filter ul li a:hover::before{
    transform: scaleX(1);
    transform-origin: left;
  }
  /* end of filter style  */
  @media (max-width:768px)
  {
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
  @media (max-width:425px)
  {
    .container .admin-table {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      width: 164%;
      margin: 0 auto;
      text-align: center;
  }
  .filter {
    margin-left: 45%;}
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
            <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26px" viewBox="0 -960 960 960" width="26px" fill="#5f6368">
                  <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
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
            <li class="menu-button" onclick="showSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                  <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                </svg></a></li>
          </ul>
        </nav>
      </header>
    </main>
  </section>
  <!-- start of filter  -->
  <div class="filter">
    <ul class="fltr">
      <li> <a href="#">Recently added Writers</a></li>
    </ul>
  </div>
  <!-- end of the filter -->
  <!-- start of the cards -->
  <div class="card-containershop">
    <?php while ($row_select_authors = $result_select_authors->fetch_assoc()): ?>
      <div class="cardShop">
        <div class="imgbx">
          <img src="<?php echo '../images/authors_images/' . htmlspecialchars($row_select_authors['image']); ?>" alt="<?php echo htmlspecialchars($row_select_authors['username']); ?>">
        </div>
        <div class="content">
          <div class="details">
            <div class="name">
              <h2><?php echo htmlspecialchars($row_select_authors['username']) ?><br></h2>
            </div>
            <a href="writerinfo.php?id=<?php echo $row_select_authors['author_id'] ?>"><button type="submit" class="submit-btn">More info</button></a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
    <?php
    $stmt_select_authors->close();
    $mydb->con->close();
    ?>
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
