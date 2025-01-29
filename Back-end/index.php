<?php
session_start();

// Include database and user class
include_once 'Database/Database.php';
include_once 'Central/User.php';

// Initialize database connection
$db = new Database();

// Initialize user object
$user = new User($db);

// Attempt to automatically log in the user if the "Remember Me" cookie is set
$loggedInUser = $user->checkRememberMe();

if ($loggedInUser) {
  
    if ($loggedInUser['role'] === 'admin') {
       
        header("Location: ../admin_dashboard/admin_dashboard.php");
        exit();
    } else {
    
        header("Location: ../Front-end/Home/home.php");
        exit();
    }
}else{
    header("Location: ../Front-end/Home/home.php");
    exit();
}
?>
