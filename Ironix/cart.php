<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ironix";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
$result = $conn->query("SELECT * FROM cart");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ironix Hardware Shop - Cart</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', Arial, sans-serif; background: #f8f9fa; color: #2c3e50; }
    .cart-container { max-width: 900px; margin: 40px auto; background: #fff; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); padding: 30px; }
    h1 { text-align: center; margin-bottom: 30px; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
    th, td { padding: 14px 10px; text-align: center; }
    th { background: #f5a623; color: #fff; }
    tr:nth-child(even) { background: #f8f9fa; }
    img { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; }
    .total-row td { font-weight: bold; font-size: 1.1em; }
    .empty-cart { text-align: center; color: #888; font-size: 1.2em; margin: 40px 0; }
    .back-btn { display: inline-block; margin-top: 20px; padding: 10px 24px; background: #f5a623; color: #fff; border-radius: 25px; text-decoration: none; font-weight: 600; }
    .back-btn:hover { background: #f39c12; }
  </style>
</head>
<body>
  <div class="cart-container">
    <h1><i class="fas fa-shopping-cart"></i> Your Cart</h1>
    <?php if ($result->num_rows > 0): ?>
    <table>
      <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Total</th>
      </tr>
      <?php
      $grandTotal = 0;
      while($row = $result->fetch_assoc()):
        $total = $row['price'] * $row['quantity'];
        $grandTotal += $total;
      ?>
      <tr>
        <td><img src="<?=htmlspecialchars($row['image_url'])?>" alt="<?=htmlspecialchars($row['name'])?>"></td>
        <td><?=htmlspecialchars($row['name'])?></td>
        <td><?=htmlspecialchars($row['description'])?></td>
        <td>$<?=number_format($row['price'], 2)?></td>
        <td><?=intval($row['quantity'])?></td>
        <td>$<?=number_format($total, 2)?></td>
      </tr>
      <?php endwhile; ?>
      <tr class="total-row">
        <td colspan="5" style="text-align:right;">Grand Total:</td>
        <td>$<?=number_format($grandTotal, 2)?></td>
      </tr>
    </table>
    <?php else: ?>
      <div class="empty-cart">Your cart is empty.</div>
    <?php endif; ?>
    <a href="index.php" class="back-btn"><i class="fa fa-arrow-left"></i> Continue Shopping</a>
  </div>
</body>
</html>
<?php $conn->close(); ?>
