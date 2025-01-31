<?php
require_once "../Database/Database.php";
require_once "../Cart/Cart.php";

// Create database connection
$db = new Database();

// Create cart instance
$cart = new Cart();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'];

        // Fetch product details from the database
        $query = "SELECT id, name, price FROM products WHERE id = ?";
        $stmt = $db->getConnection()->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        if ($product) {
            $cart->addToCart($product['id'], $product['name'], $product['price']);
        }
        header("Location: ../../Front-end/Cart/cart.php");
        exit();
    } elseif (isset($_POST['remove_from_cart'])) {
        $product_id = $_POST['product_id'] ?? null;
        if ($product_id) {
            $cart->removeFromCart($product_id);
        }
        header("Location: ../../Front-end/Cart/cart.php");
        exit();
    } elseif (isset($_POST['clear_cart'])) {
        $cart->clearCart();
        header("Location: ../../Front-end/Cart/cart.php");
        exit();
    }
}
