<?php
session_start(); // Start the session

// Check if the product ID is set
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Initialize the cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add the product ID to the cart
    if (!in_array($product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $product_id; // Add product ID to the cart
    }

    // Redirect back to the previous page (or wherever you want)
    header("Location: index.php"); // Change to your main page
    exit();
}
?>