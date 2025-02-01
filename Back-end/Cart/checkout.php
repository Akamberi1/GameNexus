<?php
session_start(); 

require_once '../../Back-end/Database/Database.php'; 
require_once '../../Back-end/Cart/cart.php'; 


$cart = new Cart();
$cartItems = $cart->getCart();
$db = new Database();
$conn = $db->getConnection();


if (!isset($_SESSION['user_id'])) {
    header("Location: ../../Front-end/Login/login.html"); 
    exit();
}


$_SESSION['checkout_success'] = true;


$user_id = $_SESSION['user_id']; 
$totalPrice = 0; 


foreach ($cartItems as $item) {
    $totalPrice += $item['price'] * $item['quantity'];
}


$orderQuery = "INSERT INTO orders (user_id, total_price) VALUES (?, ?)";
$stmt = $conn->prepare($orderQuery);
$stmt->bind_param("id", $user_id, $totalPrice);
$stmt->execute();
$order_id = $stmt->insert_id; 


foreach ($cartItems as $item) {
    $subtotal = $item['price'] * $item['quantity'];
    $orderItemQuery = "INSERT INTO order_items (order_id, product_id, quantity, price, subtotal) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($orderItemQuery);
    $stmt->bind_param("iiidi", $order_id, $item['id'], $item['quantity'], $item['price'], $subtotal);
    $stmt->execute();
}


$cart->clearCart(); 


header("Location: ../../Front-end/Cart/cart.php");
exit();
?>
