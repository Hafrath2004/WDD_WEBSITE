<?php
// Database connection
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "ironix"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the blog post ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Show single post if ID is provided, otherwise show blog listing
if ($id > 0) {
    // Query to fetch the specific blog post
    $sql = "SELECT * FROM blog WHERE id = $id";
    $result = $conn->query($sql);

    // Check if blog post exists
    if ($result->num_rows == 0) {
        // Redirect to blog listing if post not found
        header("Location: blog.php");
        exit();
    }

    $post = $result->fetch_assoc();
    $date = date("F j, Y", strtotime($post["published_at"]));
    $showSinglePost = true;
} else {
    // Query to fetch all blog posts for the listing page
    $sql = "SELECT * FROM blog ORDER BY published_at DESC";
    $result = $conn->query($sql);
    $showSinglePost = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ironix Hardware Shop - Blog</title>
  
  <!-- Google Font - Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Font Awesome CDN for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <style>
    /* Global Reset & Base Styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Poppins', Arial, sans-serif;
      background: #f8f9fa;
      color: #2c3e50;
      line-height: 1.6;
    }
    a { 
      text-decoration: none; 
      color: inherit; 
    }
    
    /* Navigation Bar - Styled to match the image */
    nav {
      background: #f8f9fa;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
      padding: 10px 20px;
      border-bottom: 1px solid #e0e0e0;
    }
    .nav-container {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .nav-logo {
      font-size: 1.8em;
      font-weight: bold;
      color: #243b55;
    }
    
    /* Modified nav layout */
    .nav-links {
      display: flex;
      flex: 1;
      justify-content: center;
    }
    .nav-links ul {
      list-style: none;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      margin: 0;
      padding: 0;
      gap: 10px;
    }
    .nav-links ul li {
      margin: 0;
      display: flex;
      align-items: center;
      position: relative;
      height: 40px;
      line-height: 40px;
    }
    .nav-links ul li a,
    .cart-icon,
    .profile-icon {
      vertical-align: middle;
    }
    .nav-links ul li a {
      color: #243b55;
      padding: 8px 12px;
      transition: all 0.3s ease;
      font-weight: 500;
      text-transform: uppercase;
      font-size: 0.9em;
      position: relative;
    }
    .nav-links ul li a:hover {
      color: #f5a623;
    }
    /* Active menu item */
    .nav-links ul li a.active {
      color: #f5a623;
    }
    .nav-links ul li a.active:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 2px;
      background-color: #f5a623;
    }
    
    /* Add dropdown indicators */
    .dropdown-icon {
      margin-left: 5px;
      font-size: 10px;
    }
    
    /* Special styling for shop button */
    .shop-button {
      background-color: #f5a623;
      color: white !important;
      border-radius: 4px;
      padding: 8px 15px !important;
    }
    .shop-button:hover {
      background-color: #e09000;
    }
    
    /* Profile dropdown styles */
    .profile-dropdown {
      display: flex;
      align-items: center;
    }
    
    .profile-icon {
      color: #243b55;
      font-size: 1.4em;
      transition: all 0.3s ease;
      padding: 0 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      line-height: 1;
    }
    
    .profile-icon:hover {
      color: #f5a623;
      transform: scale(1.1);
    }
    
    .dropdown-content {
      display: none;
      position: absolute;
      right: 0;
      top: 100%;
      background-color: #fff;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
      border-radius: 8px;
      overflow: hidden;
      margin-top: 5px;
    }
    
    .profile-dropdown:hover .dropdown-content {
      display: block;
    }
    
    .dropdown-content a {
      color: #243b55;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      text-align: left;
      transition: all 0.3s ease;
      border-bottom: 1px solid #e0e0e0;
    }
    
    .dropdown-content a i {
      margin-right: 10px;
      width: 20px;
      text-align: center;
    }
    
    .dropdown-content a:last-child {
      border-bottom: none;
    }
    
    .dropdown-content a:hover {
      background-color: #f8f9fa;
      color: #f5a623;
    }
    
    /* Search Bar */
    .search-wrapper {
      position: relative;
      width: 200px;
      margin: 0 5px;
    }
    .search-wrapper i {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #5d6d7e;
    }
    .search-wrapper input {
      width: 100%;
      padding: 10px 15px 10px 40px;
      border: 2px solid #5d6d7e;
      border-radius: 25px;
      background: #ffffff;
      color: #2c3e50;
      transition: all 0.3s ease;
    }
    .search-wrapper input:focus {
      border-color: #f5a623;
      box-shadow: 0 0 10px rgba(245,166,35,0.4);
      outline: none;
    }
    .search-wrapper input::placeholder {
      color: #95a5a6;
    }
    
    /* Language dropdown styles */
    .language-dropdown {
      position: relative;
      display: inline-block;
    }

    .language-icon {
      color: #243b55;
      font-size: 1.1em;
      padding: 8px 12px;
      border-radius: 20px;
      background: #f0f4f8;
      transition: all 0.3s ease;
    }

    .language-icon:hover {
      background: #f5a623;
      color: white;
    }

    .language-content {
      display: none;
      position: absolute;
      right: 0;
      background-color: #fff;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
      border-radius: 8px;
      overflow: hidden;
      margin-top: 5px;
    }

    .language-content a {
      color: #243b55;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      text-align: left;
      transition: all 0.3s ease;
      border-bottom: 1px solid #e0e0e0;
    }

    .language-content a:last-child {
      border-bottom: none;
    }

    .language-content a:hover {
      background-color: #f8f9fa;
      color: #f5a623;
    }

    .language-content a i {
      margin-right: 10px;
      width: 20px;
      text-align: center;
    }

    .language-dropdown:hover .language-content {
      display: block;
    }

    .nav-vdivider {
      width: 4px;
      height: 40px;
      background: linear-gradient(180deg, #f5a623 0%, #f39c12 100%);
      margin: 0 18px;
      border-radius: 2px;
      align-self: center;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
      .nav-container { 
        flex-direction: column; 
      }
      .nav-links ul { 
        flex-direction: column; 
        margin-top: 15px; 
        text-align: center;
        gap: 10px;
      }
      .nav-links ul li {
        margin: 5px 0;
      }
      .nav-search { 
        width: 100%;
        max-width: 100%;
        margin: 10px 0;
      }
      .nav-icons {
        justify-content: center;
        width: 100%;
        margin: 10px 0;
      }
      .dropdown-content {
        position: static;
        width: 100%;
        margin-top: 10px;
      }
      .language-content {
        right: auto;
        left: 50%;
        transform: translateX(-50%);
      }
    }

    /* Blog Content Styles */
    .blog-container {
      max-width: 1200px;
      margin: 40px auto;
      padding: 0 20px;
    }

    .blog-header {
      text-align: center;
      margin-bottom: 40px;
    }

    .blog-header h1 {
      font-size: 2.5em;
      color: #141e30;
      margin-bottom: 15px;
    }

    .blog-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 30px;
    }

    .blog-card {
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0,0,0,0.08);
      transition: all 0.3s ease;
    }

    .blog-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    .blog-card-img {
      height: 200px;
      overflow: hidden;
    }

    .blog-card-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .blog-card:hover .blog-card-img img {
      transform: scale(1.1);
    }

    .blog-card-content {
      padding: 20px;
    }

    .blog-card-date {
      color: #5d6d7e;
      font-size: 0.85em;
      margin-bottom: 10px;
    }

    .blog-card-title {
      font-size: 1.3em;
      margin-bottom: 10px;
      color: #141e30;
      font-weight: 600;
    }

    .blog-card-desc {
      color: #34495e;
      margin-bottom: 15px;
      font-size: 0.95em;
      line-height: 1.5;
    }

    .blog-card-link {
      display: inline-block;
      color: #f5a623;
      font-weight: 500;
      border-bottom: 2px solid transparent;
      transition: all 0.3s ease;
    }

    .blog-card-link:hover {
      border-bottom-color: #f5a623;
    }

    @media (max-width: 768px) {
      .blog-grid {
        grid-template-columns: 1fr;
      }
    }

    /* Bottom Page / Detailed Footer Section */
    .footer-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      max-width: 1200px;
      margin: 0 auto;
      padding: 60px 20px;
      background: #f8f9fa;
      color: #2c3e50;
      border-top: 5px solid #141e30;
    }
    .footer-section {
      flex: 1;
      min-width: 220px;
      margin: 20px 15px;
    }
    .footer-section h2,
    .footer-section h3 {
      color: #141e30;
      margin-bottom: 20px;
      position: relative;
      display: inline-block;
    }
    .footer-section h2 { 
      font-size: 1.6em; 
    }
    .footer-section h2:after,
    .footer-section h3:after {
      content: '';
      display: block;
      width: 40px;
      height: 3px;
      background: #f5a623;
      margin-top: 10px;
    }
    .footer-section h3 { 
      font-size: 1.3em; 
    }
    .footer-section p {
      font-size: 0.95em;
      margin-bottom: 15px;
      color: #34495e;
      line-height: 1.6;
    }
    .footer-section ul { 
      list-style: none; 
    }
    .footer-section ul li { 
      margin-bottom: 12px; 
    }
    .footer-section ul li a {
      color: #34495e;
      font-size: 0.95em;
      transition: all 0.3s;
      position: relative;
      padding-left: 15px;
    }
    .footer-section ul li a:before {
      content: '→';
      position: absolute;
      left: 0;
      color: #5d6d7e;
      transition: all 0.3s;
    }
    .footer-section ul li a:hover { 
      color: #141e30;
      padding-left: 20px;
    }
    .footer-section ul li a:hover:before {
      color: #141e30;
    }
    .footer-section.subscribe form {
      display: flex;
      flex-direction: column;
    }
    .footer-section.subscribe input[type="email"] {
      padding: 14px;
      margin-bottom: 15px;
      border: 1px solid #e2e8f0;
      border-radius: 25px;
      background: #ffffff;
      transition: all 0.3s;
    }
    .footer-section.subscribe input[type="email"]:focus {
      border-color: #5d6d7e;
      box-shadow: 0 0 10px rgba(93,109,126,0.3);
      outline: none;
    }
    .footer-section.subscribe button {
      padding: 14px;
      border: none;
      background: linear-gradient(135deg, #141e30 0%, #243b55 100%);
      color: #fff;
      cursor: pointer;
      border-radius: 25px;
      font-size: 0.95em;
      font-weight: 600;
      transition: all 0.3s;
      box-shadow: 0 4px 10px rgba(20,30,48,0.2);
    }
    .footer-section.subscribe button:hover { 
      background: linear-gradient(135deg, #243b55 0%, #141e30 100%);
      transform: translateY(-3px);
      box-shadow: 0 6px 12px rgba(20,30,48,0.3);
    }
    .footer-bottom {
      background: #141e30;
      padding: 20px;
      text-align: center;
      font-size: 0.9em;
      color: #ffffff;
    }
    .footer-bottom .social-icons {
      margin-bottom: 15px;
    }
    .footer-bottom .social-icons a {
      margin: 0 10px;
      display: inline-flex;
      align-items: center;
      font-size: 1em;
      color: #f0f4f8;
      transition: all 0.3s;
    }
    .footer-bottom .social-icons a:hover {
      color: #f5a623;
      transform: translateY(-3px);
    }
    .footer-bottom .social-icons i {
      margin-right: 5px;
    }
    .footer-bottom a {
      color: #a0aec0;
      text-decoration: underline;
      transition: all 0.3s;
    }
    .footer-bottom a:hover {
      color: #f5a623;
    }
    /* Responsive Styles - Updated for new layout */
    @media (max-width: 768px) {
      .footer-container { 
        flex-direction: column; 
        text-align: center; 
      }
      .footer-section h2:after,
      .footer-section h3:after {
        margin: 10px auto 0;
      }
      .footer-section ul li a {
        padding-left: 0;
      }
      .footer-section ul li a:before {
        content: none;
      }
      .footer-section ul li a:hover {
        padding-left: 0;
      }
    }
  </style>
</head>
<body>
  <!-- Navigation Bar -->
  <nav>
    <div class="nav-container">
      <div class="nav-logo">
        <a href="index.php">Ironix Hardware Shop</a>
      </div>
      <div class="nav-vdivider"></div>
      <div class="nav-links">
        <ul>
          <li><a href="index.php">HOME</a></li>
          <li><a href="#">SERVICES</a></li>
          <li><a href="#">SUPPORT</a></li>
          <li><a href="blog.php" class="active">BLOG</a></li>
          <li><a href="#">CONTACT US</a></li>
          <li class="icon-group">
            <a href="#" class="cart-icon"><i class="fas fa-shopping-cart"></i></a>
            <div class="profile-dropdown">
              <a href="#" class="profile-icon"><i class="fa-regular fa-user"></i></a>
              <div class="dropdown-content">
                <a href="#"><i class="fa-regular fa-user"></i> Profile</a>
                <a href="login.html"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                <a href="#"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
              </div>
            </div>
          </li>
          <li class="language-dropdown">
            <a href="#" class="language-icon"><i class="fas fa-globe"></i> EN</a>
            <div class="language-content">
              <a href="#"><i class="fas fa-globe"></i> English</a>
              <a href="#"><i class="fas fa-globe"></i> Sinhala</a>
            </div>
          </li>
          <li class="search-wrapper">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Search products...">
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Blog Content Section -->
  <div class="blog-container">
    <div class="blog-header">
      <h1>Latest Blog Posts</h1>
      <p>Stay updated with our latest hardware tips and industry news</p>
    </div>

    <div class="blog-grid">
      <?php
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            echo '<div class="blog-card">';
            echo '  <div class="blog-card-img">';
            echo '    <img src="' . htmlspecialchars($row["image_url"]) . '" alt="' . htmlspecialchars($row["title"]) . '">';
            echo '  </div>';
            echo '  <div class="blog-card-content">';
            echo '    <div class="blog-card-date">' . date("F j, Y", strtotime($row["published_at"])) . '</div>';
            echo '    <h3 class="blog-card-title">' . htmlspecialchars($row["title"]) . '</h3>';
            echo '    <p class="blog-card-desc">' . htmlspecialchars($row["description"]) . '</p>';
            echo '    <a href="blog.php?id=' . $row["id"] . '" class="blog-card-link">Read More</a>';
            echo '  </div>';
            echo '</div>';
          }
        } else {
          echo '<p>No blog posts found.</p>';
        }
      ?>
    </div>
  </div>

  <!-- Bottom Page / Detailed Footer Section -->
  <section class="footer-container">
    <div class="footer-section logo-description">
      <h2>Ironix Hardware Shop</h2>
      <p>Your one-stop destination for high-quality hardware tools and equipment. We provide reliable solutions for every project.</p>
    </div>
    <div class="footer-section pages">
      <h3>Pages</h3>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Products</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Privacy Policy</a></li>
      </ul>
    </div>
    <div class="footer-section services">
      <h3>Services</h3>
      <ul>
        <li><a href="#">Tool Rental</a></li>
        <li><a href="#">Repair &amp; Maintenance</a></li>
        <li><a href="#">Installation</a></li>
        <li><a href="#">Custom Orders</a></li>
        <li><a href="#">Technical Support</a></li>
      </ul>
    </div>
    <div class="footer-section subscribe">
      <h3>Subscribe</h3>
      <p>Stay updated with our latest offers and hardware tips.</p>
      <form>
        <input type="email" placeholder="Enter your email" required>
        <button type="submit">SUBSCRIBE NOW</button>
      </form>
    </div>
  </section>

  <div class="footer-bottom">
    <div class="social-icons">
      <a href="#"><i class="fab fa-facebook" style="font-size: 1.2em;"></i> Facebook</a>
      <a href="#"><i class="fab fa-twitter-square" style="font-size: 1.2em;"></i> Twitter</a>
      <a href="#"><i class="fab fa-linkedin" style="font-size: 1.2em;"></i> LinkedIn</a>
      <a href="#"><i class="fab fa-square-instagram" style="font-size: 1.2em;"></i> Instagram</a>
    </div>
    <p>
      &copy; 2025 Ironix Hardware Shop. All Rights Reserved. Powered by Ironix Solutions.
      <a href="#">Privacy &amp; Cookie Policy</a>
    </p>
  </div>
</body>
</html>