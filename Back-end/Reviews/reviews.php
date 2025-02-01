<?php
// Review.php
require_once '../Database/Database.php';

class Review {
    private $conn;

    public function __construct() {
        $database = new Database();  // Create instance of Database class
        $this->conn = $database->getConnection();  // Get the database connection
    }

    // Method to insert a review
    public function insertReview($userId, $productId, $reviewText, $reviewImage) {
        // Set the rating as NULL for now
        $rating = null; 
    
        // Prepare the SQL query to insert the review
        $sql = "INSERT INTO reviews (user_id, product_id, review_text, image, rating) 
                VALUES (?, ?, ?, ?, ?)";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt === false) {
            // If preparing the statement failed, return an error
            die('Error preparing the query: ' . $this->conn->error);
        }
    
        // Bind the parameters
        $stmt->bind_param('iisss', $userId, $productId, $reviewText, $reviewImage, $rating);
    
        // Execute the statement
        if ($stmt->execute()) {
            return true;  // Successfully inserted
        } else {
            // If the statement fails, log the error
            die('Error executing the query: ' . $stmt->error);
        }
    }
    
    

    // Method to handle image upload and return the file name
    public function uploadReviewImage($image) {
        $reviewImage = null;

        if (isset($image) && $image['error'] === UPLOAD_ERR_OK) {
            $targetDir = '../../Front-end/images/';  // Path to your images folder
            $targetFile = $targetDir . basename($image['name']);
            if (move_uploaded_file($image['tmp_name'], $targetFile)) {
                // If upload is successful, return the file name
                $reviewImage = basename($image['name']);
            } else {
                die('Error uploading the image.');
            }
        }

        return $reviewImage;
    }
}
