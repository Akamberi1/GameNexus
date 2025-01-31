<?php
@include '../config.php';

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

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <script src="https://kit.fontawesome.com/4acdbd152b.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../admin_dashboard/admin_dashboard.css">
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
        <i class="fa-solid fa-bell"></i>
        <i class="fa-solid fa-user"></i>
        </div>
      </header>

      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand">
            
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
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
            <a href="../../Front-end/Contact-us/faq.html"><i class="fa-solid fa-address-book"></i> Contact Us</a>
          </li>
          <li class="sidebar-list-item">
            <a href="../../Front-end/About/about.html"><i class="fa-solid fa-address-card"></i>  About</a>
          </li>
          <li class="sidebar-list-item">
            <a href="#"><i class="fa-solid fa-users"></i>  Users</a>
          </li>
          <li class="sidebar-list-item">
            <a href="#"><i class="fa-solid fa-gamepad"></i> Games</a>
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