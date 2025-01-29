<?php
session_start(); 
if (isset($_COOKIE['remember_me'])) {
    $remember_token = $_COOKIE['remember_me'];

    // Query to find the user based on the remember token
    $query = "SELECT * FROM users WHERE remember_token = '$remember_token' LIMIT 1";
    $result = mysqli_query($this->conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Log the user in automatically
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; // Store the role (admin or user)

        // Redirect to the dashboard or homepage
        header("Location: index.php");
        exit();
    }
}
?>