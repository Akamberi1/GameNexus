<?php
session_start();

class Database {
    private $host = 'localhost';
    private $db_name = 'GameNexus';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

class User {
    private $conn;
    private $table_name = "users";
    public $username;
    public $email;
    public $password;
    public $role;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function exists() {
        $query = "SELECT id FROM " . $this->table_name . " WHERE email = ? OR username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $this->email, $this->username);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function register() {
        $query = "INSERT INTO " . $this->table_name . " (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bind_param("ssss", $this->username, $this->email, $hashed_password, $this->role);
        return $stmt->execute();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);
    
    $user->username = trim($_POST["username"]);
    $user->email = trim($_POST["email"]);
    $confirm_email = trim($_POST["confirm-email"]);
    $user->password = $_POST["password"];
    
    if ($user->email !== $confirm_email) {
        $_SESSION["error"] = "Email addresses do not match!";
        header("Location: ../Register/registration-form.php");
        exit();
    }

    $user->role = isset($_POST["role"]) && in_array($_POST["role"], ["admin", "user"]) ? $_POST["role"] : "user";

    if ($user->exists()) {
        $_SESSION["error"] = "An account with this username or email already exists.";
        header("Location: ../Register/registration-form.php");
        exit();
    }
    
    if ($user->register()) {
        $_SESSION["success"] = "Registration successful!";
        if ($user->role === "admin") {
            header("Location: ../Login/login.html");
        } else {
            header("Location: ../Register/registration-form.php");
        }
        exit();
    } else {
        $_SESSION["error"] = "Registration failed. Please try again.";
        header("Location: ../Register/registration-form.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/4acdbd152b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Register/registration-form.css">
    <style>
        /* Simple pop-up style */
        .popup {
            display: none;
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translateX(-50%);
            padding: 20px;
            background-color: #333;
            color: white;
            border-radius: 5px;
            text-align: center;
            z-index: 1000;
        }

        .popup.success {
            background-color: green;
        }

        .popup.error {
            background-color: red;
        }

        .popup.show {
            display: block;
        }
    </style>

</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="../Home/home.php"><img src="../images/gamenexus-logo.png" alt="logo-img" id="logo1"></a>
        </div>
        <nav class="right">
            <a href="../Home/home.php">Home</a>
            <a href="../Categories/Categories.php">Categories</a>
            <a href="../About/about.html">About us</a>
            <a href="../Contact-us/faq.php">Contact us</a>
        </nav>
    </header>
    <section class="container">
        <section class="form-container">
            <h2>CREATE YOUR ACCOUNT</h2>
            <form id="loginForm" action="registration-form.php" method="POST" enctype="multipart/form-data">

                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username">
            
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email-address" placeholder="Email Address">
            
                <div>
                    <label for="confirm-email">Confirm your Email Address</label>
                    <input type="email" name="confirm-email" id="confirm-email" placeholder="Confirm your Email Address">
                </div>
            
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Your Password">
                
            <label for="select-roles">Role</label>
            <select name="role" id="select-role" required>
                <option value="" disabled selected>--Select Your Role-</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <label for="select-country">Country of Residence</label>
            <select name="country" id="select-country">
                <option value="Albania">Albania</option>
                <option value="Argentina">Argentina</option>
                <option value="Belgium">Belgium</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Denmark">Denmark</option>
                <option value="Dominica">Dominica</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egypt">Egypt</option>
                <option value="Fiji">Fiji</option>
                <option value="Finland">Finland</option>
                <option value="Germany">Germany</option>
                <option value="Greece">Greece</option>
                <option value="Haiti">Haiti</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="Iran">Iran</option>
                <option value="Japan">Japan</option>
                <option value="Jordan">Jordan</option>
                <option value="Kazakhstan">Kazakhstan</option>
                <option value="Kosova">Kosova</option>
            </select>

            <div class="captcha">
                <input type="checkbox" name="captcha" id="i-am-human"> I am human
            </div>
        
            <div class="terms">
                <input type="checkbox" name="terms" id="agree-terms"> I am 13 years of age or older and agree to the terms of the <a href="#">Steam Subscriber Agreement</a> and the <a href="#">Valve Privacy Policy</a>.
            </div>

            <button class="btn-submit" type="submit">Continue</button>
            </form>
            <?php if (isset($_SESSION["success"])): ?>
        <div class="popup success show" id="popup">
            <?php echo $_SESSION["success"]; unset($_SESSION["success"]); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION["error"])): ?>
        <div class="popup error show" id="popup">
            <?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?>
        </div>
    <?php endif; ?>

        </section>
    </section>
    <script src="../Register/registration-form.js"></script>
    <script>
        window.onload = function() {
            const popup = document.querySelector('.popup');
            if (popup) {
                popup.classList.add('show'); 
            }
        };

        setTimeout(() => {
            const popup = document.querySelector('.popup');
            if (popup) {
                popup.classList.remove('show');  
            }
        }, 3000);
    </script>
</body>
</html>