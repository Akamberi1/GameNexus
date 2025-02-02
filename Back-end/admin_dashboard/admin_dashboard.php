<?php
session_start();
@include '../config.php';
if (!isset($_SESSION['user_id'])) {
  header("Location: ../../Front-end/Login/login.html");
  exit;
}

class Database {
    private $host = "localhost";
    private $dbname = "GameNexus";
    private $username = "root";
    private $password = "";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

class Dashboard {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getCount($table) {
        $query = "SELECT COUNT(*) AS total FROM $table";
        $result = $this->db->query($query);
        return ($result->num_rows > 0) ? $result->fetch_assoc()['total'] : 0;
    }
}

$dashboard = new Dashboard();

$totalUsers = $dashboard->getCount('users');
$totalGames = $dashboard->getCount('products');
$totalReviews = $dashboard->getCount('reviews');
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <script src="https://kit.fontawesome.com/4acdbd152b.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../admin_dashboard/admin_dashboard.css">
    <style>
      .logo{
        width: 200px;
        height: 160px;
      }
    </style>
  </head>
  <body>
    <div class="grid-container">

      <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
        <i class="fa-solid fa-bars"></i>
        </div>
        <div class="header-left">
          <h2 style="color: white;">Welcome, Admin! </h2>
        </div>
        <div class="header-right">
        </div>
      </header>

      <aside id="sidebar">
        <div class="sidebar-title">
            <a href="../../Front-end/Home/home.php"><img class="logo" src="../../Front-end/images/gamenexus-logo.png" alt="Logo"></a>
            <i class="fa-solid fa-circle-xmark close-sidebar-icon" onclick="closeSidebar()"></i>
            <style>
            .sidebar-title {
              display: flex;
              align-items: center;
              justify-content: space-between;
              padding: 10px 0;
            }
            .fa-circle-xmark {
              display: none; 
              margin: 50px; 
              padding-bottom: 7.1px; 
            }
            .logo {
              width: 150px; 
              height: auto;
              margin-right: 86px; 
            }
            .close-sidebar-icon {
              margin-left: auto; 
            }
            @media screen and (max-width: 992px) {
              .fa-circle-xmark {
                display: inline !important;
                margin: 25px; 
                padding-bottom: 7.1px; 
              }
            }
          </style>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a href="../admin_dashboard/admin_dashboard.php"><i class="fa-solid fa-table-columns"></i> Dashboard</a>
          </li>
          <li class="sidebar-list-item">
          <a href="../../Front-end/Home/home.php"><i class="fa-solid fa-house"></i> Homepage</a>
          </li>
          <li class="sidebar-list-item">
            <a href="../../Front-end/Categories/Categories.php"><i class="fa-solid fa-list"></i> Categories</a>
          </li>
          <li class="sidebar-list-item">
<<<<<<< HEAD
            <a href="../Contact/viewContacts.php"><i class="fa-solid fa-address-book"></i> Contact Us</a>
=======
            <a href="../../Front-end/Contact-us/faq.php"><i class="fa-solid fa-address-book"></i> Contact Us</a>
>>>>>>> parent of 2ffe10b (Revert "last commit i think")
          </li>
          <li class="sidebar-list-item">
            <a href="../../Front-end/About/about.html"><i class="fa-solid fa-address-card"></i>  About</a>
          </li>
          <li class="sidebar-list-item">
            <a href="../users_dashboard/Users.php"><i class="fa-solid fa-users"></i>  Users</a>
          </li>
          <li class="sidebar-list-item">
            <a href="../games/games.php"><i class="fa-solid fa-gamepad"></i> Games</a>
          </li>
        </ul>
      </aside>

      <main class="main-container">
        <div class="main-title">
          <h2>DASHBOARD</h2>
        </div>

        <div class="main-cards">

          <div class="card">
            <div class="card-inner">
              <h2>Users</h2>
              <i class="fa-solid fa-users"></i>
            </div>
            <h1><?php echo $totalUsers; ?></h1>
          </div>

          <div class="card">
            <div class="card-inner">
              <h2>Games</h2>
              <i class="fa-solid fa-gamepad"></i>
            </div>
            <h1><?php echo $totalGames; ?></h1>
          </div>

          <div class="card">
            <div class="card-inner">
              <h2>Reviews</h2>
              <i class="fa-solid fa-message"></i>
            </div>
            <h1><?php echo $totalReviews; ?></h1>
          </div>

        </div>

        <div class="products">

          <div class="product-card">
            <h2 class="product-description">Latest Updates</h2>
            <p class="text-secondary">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce laoreet facilisis nulla, consectetur pulvinar diam. Aliquam tempus vel quam.
            </p>
            <button type="button" class="product-button">
            <i class="fa-solid fa-plus"></i>
            </button>
          </div>
        </div>
</main>

    </div>

    <script src="../admin_dashboard/admin_dashboard.js"></script>
  </body>
</html>