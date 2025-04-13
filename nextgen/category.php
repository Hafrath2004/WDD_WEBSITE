<?php
// DB connection
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "nextgen";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category = isset($_GET['category']) ? $_GET['category'] : '';

$stmt = $conn->prepare("SELECT * FROM product WHERE category = ?");
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($category); ?> | NextGen</title>
  <style>
    body { font-family: Arial; background: #f9f9f9; padding: 20px; }
    h1 { text-align: center; color: #1a237e; margin-bottom: 30px; }
    .product-container { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
    .product { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 260px; }
    .product h2 { color: #1a237e; font-size: 18px; }
    .product p { font-size: 14px; margin: 6px 0; }
    .product img { width: 100%; border-radius: 8px; margin-top: 10px; }
  </style>
</head>
<body>
  <h1><?php echo htmlspecialchars($category); ?> Tools</h1>

  <?php
  if ($result->num_rows > 0) {
    echo "<div class='product-container'>";
    while ($row = $result->fetch_assoc()) {
      echo "<div class='product'>";
      echo "<h2>" . htmlspecialchars($row['product_name']) . "</h2>";
      echo "<p>" . htmlspecialchars($row['description']) . "</p>";
      echo "<p><strong>Price: ₹" . number_format($row['price'], 2) . "</strong></p>";
      echo "<p><strong>Discount: ₹" . number_format($row['discount_price'], 2) . "</strong></p>";
      echo "<img src='" . htmlspecialchars($row['image_url']) . "' alt='Product'>";
      echo "</div>";
    }
    echo "</div>";
  } else {
    echo "<p style='text-align:center;'>No products available in this category.</p>";
  }
  $conn->close();
  ?>
</body>
</html>
