<?php
require_once "../Database/Database.php";

class ContactForm {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function submitMessage($username, $email, $message, $user_id = null) {
        // Prepare SQL
        $stmt = $this->conn->prepare("INSERT INTO contact_form (user_id, name, email, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $username, $email, $message);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>