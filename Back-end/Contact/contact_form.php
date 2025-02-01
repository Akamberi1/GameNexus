<?php
session_start();
require_once "Contact.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Check if the user is logged in
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Validate input
    if (empty($username) || empty($email) || empty($message)) {
        echo "All fields are required!";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }

    // Save to database
    $contactForm = new ContactForm();
    $result = $contactForm->submitMessage($username, $email, $message, $user_id);

    if ($result) {
        $_SESSION['contact_status'] = 'Message sent successfully!';
        header("Location: ../../Front-end/Contact-us/faq.php"); // Redirect back
        exit;
    } else {
        $_SESSION['contact_status'] = 'Failed to send your message. Please try again.';
        exit;
    }
}
?>
