<?php
session_start();

class Cart {
    public function __construct() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function addToCart($product_id, $name, $price, $quantity = 1) {
        // Check if product already exists in cart
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = [
                'id' => $product_id,
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity
            ];
        }
    }

    public function getCart() {
        return $_SESSION['cart'] ?? [];
    }

    public function removeFromCart($product_id) {
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
        }
    }

    public function clearCart() {
        $_SESSION['cart'] = [];
    }
}
