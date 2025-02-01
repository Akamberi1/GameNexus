<?php


include_once __DIR__ . '/../Database/Database.php';

class Product {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Function to fetch a product by ID
    public function getProductById($id) {
        $query = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Return the product as an associative array
        } else {
            return null; // No product found
        }
    }
}
?>