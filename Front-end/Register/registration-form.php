<?php
@include '../config.php';
session_start();

class User {
    private $conn;
    private $table = 'users';

    public $username;
    public $email;
    public $password;
    public $role;
    public $country;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register() {
        $sql = "INSERT INTO " . $this->table . " (username, email, password, role, country) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("sssss", $this->username, $this->email, $this->password, $this->role, $this->country);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['roles']) && isset($_POST['country'])) {
        $database = new Database();
        $db = $database->getConnection();

        $user = new User($db);
        $user->username = $_POST['username'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
        $user->role = $_POST['roles'];
        $user->country = $_POST['country'];

        if ($user->register()) {
            echo "User registered successfully";
        } else {
            echo "Failed to register user";
        }
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
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="#" alt="logo-img" id="logo1">
        </div>
        <nav class="right">
            <a href="../Home/home.html">home</a>
            <a href="../Categories/Categories.html">categories</a>
            <a href="../About/about.html">About us</a>
            <a href="../Contact-us/faq.html">Contact us</a>
        </nav>
    </header>
    <section class="container">
        <section class="form-container">
            <h2>CREATE YOUR ACCOUNT</h2>
            <?php 
            class ErrorHandler {
                public static function displayError() {
                    if (isset($_SESSION['error'])) {
                        echo "<p class='error'>" . $_SESSION['error'] . "</p>";
                        unset($_SESSION['error']);
                    }
                }
            }

            ErrorHandler::displayError();
            ?>
            <form id="loginForm" action="#" method="post">

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
            <select name="roles" id="select-role">
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

            <button class="btn-submit" type="submit">Continue</a></button>
            </form>

        </section>
    </section>
    <script src="../Register/registration-form.js"></script>
</body>
</html>