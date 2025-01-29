<?php
session_start();

// Include database and user class
include_once '../Database/Database.php';
include_once '../Central/User.php';

// Initialize database connection
$db = new Database();

// Initialize user object
$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    // $remember = isset($_POST['remember']) ? true : false;

    // Attempt login
    $loggedInUser = $user->login($username, $password);

    if ($loggedInUser) {
        // Redirect based on user role (admin or regular user)
        if ($loggedInUser['role'] === 'admin') {
            // Redirect to admin dashboard
            header("Location: ../admin_dashboard/admin_dashboard.php");
            exit();
        } else {
            // Redirect to regular user homepage/dashboard
            header("Location: ../index.php");
            exit();
        }
    } else {
        $error = "Invalid credentials.";
    }
}
?>

<!-- Display Error Message -->
<?php if (isset($error)) { echo $error; } ?>
