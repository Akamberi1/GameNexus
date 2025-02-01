<?php
session_start();

// Check if the user is logged in (you can use $_SESSION for this check)
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect them to the login page
    header('Location: ../../Front-end/Login/login.html');
    exit();
}

require_once '../Reviews/reviews.php'; // Include the Review class

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the product ID from the hidden input
    $productId = $_POST['product_id'];
    // Get the review text
    $reviewText = $_POST['review_text'];
    // Get the user ID from session
    $userId = $_SESSION['user_id'];

    // Instantiate the Review class
    $review = new Review();

    // Upload the image if it's provided
    $reviewImage = $review->uploadReviewImage($_FILES['review_image']);

    // Insert the review into the database
    if ($review->insertReview($userId, $productId, $reviewText, $reviewImage)) {
        // If successful, redirect back to the product details page
        header('Location: ../../Front-end/Product-details/product-details.php?id=' . $productId);
        exit();
    } else {
        die('Error submitting the review.');
    }
} else {
    // If the request is not POST, redirect back to the product page
    header('Location: ../../Front-end/Product-details/product-details.php?id=' . $_POST['product_id']);
    exit();
}
