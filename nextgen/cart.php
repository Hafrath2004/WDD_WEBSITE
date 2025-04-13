<?php
session_start(); // Start the session

// Function to fetch product details
function getProductById($id) {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "nextgen"); // Update with your DB credentials

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM product WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8; /* Background color */
            text-align: center; /* Center text */
        }
        .cart-container {
            margin: 20px;
            padding: 20px;
            background: white; /* Background for the cart */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
        }
        .cart-item {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc; /* Border around each item */
            border-radius: 5px; /* Rounded corners */
        }
    </style>
</head>
<body>
    <div class="cart-container">
        <h2>Your Cart</h2>
        <?php
        // Check if the cart is set and not empty
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            echo "<ul>";
            foreach ($_SESSION['cart'] as $product_id) {
                // Fetch product details using the product ID
                $product = getProductById($product_id);
                if ($product) {
                    echo "<li class='cart-item'>";
                    echo "<h3>" . htmlspecialchars($product['product_name']) . "</h3>";
                    echo "<p>Price: ₹" . number_format($product['price'], 2) . "</p>";
                    echo "<p>Description: " . htmlspecialchars($product['description']) . "</p>";
                    echo "</li>";
                }
            }
            echo "</ul>";
        } else {
            echo "<p>Your cart is empty.</p>";
        }
        ?>
        <a href="index.php">Continue Shopping</a> <!-- Link back to the main page -->
    </div>
</body>
</html>