<?php
session_start();
// Database connection details
$servername = "localhost";
$username   = "root";      // Change this if needed
$password   = "";          // Change this if needed
$dbname     = "nextgen";   // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en'; // Default to English
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['language'])) {
    $_SESSION['lang'] = $_POST['language'];
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Query to fetch all products
$sql    = "SELECT * FROM accessories";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>NextGen | Hardware Shop</title>
  <!-- FontAwesome for icons -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    /* Basic Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f0f4f8;
      color: #333;
    }
    
    .top-bar {
    background: #1a237e;
    color: #fff;
    padding: 8px 20px;
    font-size: 14px;
    display: flex;
    justify-content: space-between; /* Space between contact info and user controls */
    align-items: center;
    }

    .login-link {
    color: #fff; /* Text color */
    text-decoration: none; /* Remove underline */
    padding: 5px 10px; /* Padding around the text */
    border: 1px solid #fff; /* White border */
    border-radius: 5px; /* Rounded corners */
    transition: background 0.3s, color 0.3s; /* Transition for hover effect */
    display: flex; /* Use flex to align icon and text */
    align-items: center; /* Center items vertically */
    }

    .login-link:hover {
        background: rgba(255, 255, 255, 0.2); /* Light background on hover */
        color: #fff; /* Keep text color white on hover */
    }

    .user-controls {
        display: flex; /* Flex container for user controls */
        align-items: center; /* Center items vertically */
        margin-left: auto; /* Push user controls to the right */
    }


    .user-controls a:hover {
        background: rgba(255, 255, 255, 0.2); /* Light background on hover */
        color: #fff; /* Keep text color white on hover */
    }

    .user-controls a i {
        margin-right: 5px; /* Space between icon and text */
    }

    .user-controls-language {
    display: flex;
    align-items: center; /* Align items vertically */
    gap: 15px; /* Space between user controls and language selector */
    }

    .user-controls a i {
        margin-right: 5px; /* Space between icon and text */
    }
    .user-controls a {
    color: #fff; /* Text color */
    text-decoration: none; /* Remove underline */
    padding: 5px 10px; /* Padding around the text */
    border: 1px solid #fff; /* White border */
    border-radius: 5px; /* Rounded corners */
    transition: background 0.3s, color 0.3s; /* Transition for hover effect */
    }

    .user-controls a:hover {
        background: rgba(255, 255, 255, 0.2); /* Light background on hover */
        color: #fff; /* Keep text color white on hover */
    }
    
    .language-selector select {
        padding: 4px 8px;
        font-size: 14px;
        border-radius: 5px;
    }
    .top-bar .contact-info {
      display: flex;
      gap: 20px;
    }
    /* Header / Navigation */
    .header {
      background: #fff;
      padding: 10px 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .header .logo {
      font-size: 26px;
      font-weight: bold;
      color: #1a237e;
    }
    
    .nav-links {
      list-style: none;
      display: flex;
      gap: 15px;
      font-size: 16px;
    }
    
    .nav-links li a {
      color: #1a237e;
      text-decoration: none;
      padding: 5px 10px;
    }
    
    .nav-links li a:hover {
      background: #e3f2fd;
      border-radius: 4px;
    }
    
    /* Search Bar within Header */
    .search-bar {
      margin-left: 20px;
      position: relative;
    }
    
    .search-bar input[type="text"] {
      width: 250px;
      padding: 8px 12px;
      border: 2px solid #1a237e;
      border-radius: 20px;
      outline: none;
      font-size: 14px;
    }
    
    .search-bar button {
      position: absolute;
      right: 0;
      top: 0;
      bottom: 0;
      border: none;
      background: none;
      padding: 0 12px;
      cursor: pointer;
      color: #1a237e;
    }
    
    /* Banner Section with Promotional Offer */
    .banner {
      position: relative;
      background: url('banner-image.jpg') no-repeat center center/cover;
      /* Replace 'banner-image.jpg' with your actual banner image */
      height: 400px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }
    
    .banner::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(26, 35, 126, 0.7);
    }
    
    .banner-content {
      position: relative;
      color: #fff;
    }
    
    .banner-content h1 {
      font-size: 48px;
      margin-bottom: 10px;
    }
    
    .banner-content p {
      font-size: 20px;
      margin-bottom: 20px;
    }
    
    .banner-content .shop-now-btn {
      background: #d32f2f;
      border: none;
      padding: 10px 20px;
      border-radius: 25px;
      font-size: 18px;
      color: #fff;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    
    .banner-content .shop-now-btn:hover {
      background: #b71c1c;
    }
    
    /* Category Icons Section */
    .categories {
      background: #e3f2fd;
      padding: 20px 0;
      display: flex;
      justify-content: space-around;
      text-align: center;
    }
    
    .category {
      flex: 1;
    }
    
    .category i {
      font-size: 30px;
      color: #1a237e;
    }
    
    .category p {
      margin-top: 8px;
      font-size: 16px;
      color: #1a237e;
      font-weight: bold;
    }
    
    /* Product Container */
    .product-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      padding: 40px;
      justify-content: center;
    }
    
    .product {
      background: #ffffff;
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.15);
      padding: 20px;
      width: 260px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .product:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
    }
    
    .product h2 {
      color: #1a237e;
      margin-bottom: 10px;
      font-size: 20px;
    }
    
    .product p {
      margin: 5px 0;
      color: #333;
      font-size: 16px;
    }
    
    .product strong {
      color: #d32f2f;
    }
    
    .product-image {
      width: 100%;
      height: auto;
      margin-top: 10px;
      border-radius: 8px;
      border: 1px solid #ddd;
    }
    
    .add-to-cart-btn {
  margin-top: 10px;
  width: 100%;
  padding: 10px;
  background-color: #1a237e;
  color: #fff;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 16px;
  transition: background 0.3s ease;
}

.add-to-cart-btn:hover {
  background-color: #0d1a5c;
}

    /* Footer */
    footer {
      background: #1a237e;
      color: #fff;
      text-align: center;
      padding: 15px 0;
      font-size: 14px;
    }
  </style>
</head>
<body>
<div class="top-bar">
    <div class="contact-info">
        <span><i class="fas fa-phone-alt"></i> Hotline: 0759874512 / 0765478965</span>
        <span><i class="fas fa-clock"></i> Mon-Fri: 9AM - 6PM</span>
    </div>

    <div class="user-controls">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="user_profile.php"><i class="fas fa-user-circle"></i> Profile</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <?php else: ?>
            <a href="login.php" class="login-link"><i class="fas fa-user-circle"></i> Login</a>
        <?php endif; ?>
    </div>

        <!-- Language Selector -->
        <div class="language-selector">
            <form method="POST" action="">
                <select name="language" onchange="this.form.submit()">
                    <option value="en" <?php if ($_SESSION['lang'] === 'en') echo 'selected'; ?>>English</option>
                    <option value="si" <?php if ($_SESSION['lang'] === 'si') echo 'selected'; ?>>සිංහල</option>
                    <option value="ta" <?php if ($_SESSION['lang'] === 'ta') echo 'selected'; ?>>த மிழ்</option>
                </select>
            </form>
        </div>
    </div>
</div>


  <!-- Header Section -->
  <header class="header">
    <div class="logo">NextGen</div>
    <nav>
      <ul class="nav-links">
        <li><a href="specials.php"><strong>Specials</strong></a></li>
        <li><a href="power_tools.php"><strong>Power Tools</strong></a></li>
        <li><a href="hand_tools.php"><strong>Hand Tools</strong></a></li>
        <li><a href="garden_tools.php"><strong>Garden Tools</strong></a></li>
        <li><a href="accessories.php"><strong>Accessories</strong></a></li>
      </ul>
    </nav>
    <!-- Search Bar -->
    <div class="search-bar">
      <form action="search.php" method="GET">
        <input type="text" name="query" placeholder="Search Tools..." required>
        <button type="submit"><i class="fas fa-search"></i></button>
      </form>
    </div>
  </header>

  <!-- Banner Section -->
  <section class="banner">
    <div class="banner-content">
      <h1>Drill into Savings!</h1>
      <p>Up to 50% off on drills - limited time offer!</p>
      <button class="shop-now-btn">Shop Now</button>
    </div>
  </section>

  <!-- Category Icons Section -->
  <section class="categories">
    <div class="category">
      <i class="fas fa-tools"></i>
      <p>Hand Tools</p>
    </div>
    <div class="category">
      <i class="fas fa-drill"></i>
      <p>Drills</p>
    </div>
    <div class="category">
      <i class="fas fa-hammer"></i>
      <p>Hammers</p>
    </div>
    <div class="category">
      <i class="fas fa-bolt"></i>
      <p>Power Tools</p>
    </div>
  </section>

  <!-- Products Section -->
  <?php
    if ($result->num_rows > 0) {
      echo "<div class='product-container'>";
      // Output each product from the database
      while ($row = $result->fetch_assoc()) {
        echo "<div class='product'>";
        echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
        echo "<p><strong>Price: ₹" . number_format($row['price_lkr'], 2) . "</strong></p>";
        echo "<p><strong>Discount Price: ₹" . number_format($row['discounted_price_lkr'], 2) . "</strong></p>";
        echo "<img src='" . htmlspecialchars($row['image_url']) . "' class='product-image' alt='" . htmlspecialchars($row['name']) . "' />";
        echo "<form method='POST' action='add_to_cart.php'>";
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "' />";
        echo "<button type='submit' class='add-to-cart-btn'>Add to Cart</button>";
        echo "</form>";
        echo "</div>";
      }
      echo "</div>";
    } else {
      echo "<p style='text-align:center; padding:40px;'>No product found.</p>";
    }
    $conn->close();
  ?>
.add-to-cart-btn {
  margin-top: 10px;
  width: 100%;
  padding: 10px;
  background-color: #1a237e;
  color: #fff;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 16px;
  transition: background 0.3s ease;
}

.add-to-cart-btn:hover {
  background-color: #0d1a5c;
}

  <!-- Footer -->
  <footer>
    &copy; 2025 NextGen. All Rights Reserved.
  </footer>
</body>
</html>