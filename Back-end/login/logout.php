<?php
session_start();

// Destroy session data
session_unset();
session_destroy();

// Optionally, also destroy the 'remember_me' cookie if it exists
if (isset($_COOKIE['remember_me'])) {
    setcookie('remember_me', '', time() - 3600, '/'); // Expire the cookie
}

// Redirect to login page after logging out
header('Location: ../../Front-end/Login/login.html');
exit();
?>