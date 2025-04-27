<?php
// ----- PHP Database Connection & Query -----
$servername = "localhost";  // or "127.0.0.1"
$username   = "root";       // your database username
$password   = "";           // your database password
$dbname     = "ironix";     // your database name

// Create connection using MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection; stop the script if connection fails.
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve up to 10 products from the "products" table
$sql    = "SELECT id, name, description, price, image_url FROM products LIMIT 10";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ironix Hardware Shop - Home</title>
  
  <!-- Google Font - Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Font Awesome CDN for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="login.html">
  <link rel="stylesheet" href="login.php">
  <link rel="stylesheet" href="registration.php">
  
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
    .nav-search {
      margin-left: 20px;
      width: 300px;
      display: none; /* Hide in the top navigation */
    }
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
      padding: 10px 15px 10px 40px; /* extra left padding for the icon */
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
    
    /* Navigation Icons */
    .nav-icons {
      display: flex;
      align-items: center;
      gap: 10px;
      position: relative;
      margin-left: 5px;
    }
    .nav-icons a {
      color: #243b55;
      font-size: 1.4em;
      transition: all 0.3s ease;
      padding: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .nav-icons a:hover {
      color: #f5a623;
      transform: scale(1.1);
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
    }
    
    /* Banner (Hero Section) */
    .banner {
      position: relative;
      background: url('banner.jpg') no-repeat center center/cover;
      height: 500px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
    }
    .banner-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(20,30,48,0.85) 0%, rgba(36,59,85,0.8) 100%); /* Dark blue gradient */
    }
    .banner-content {
      position: relative;
      text-align: center;
      z-index: 2;
    }
    .banner-content h2 {
      font-size: 3.2em;
      margin-bottom: 0.5em;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
      color: #ffffff;
    }
    .banner-content p {
      font-size: 1.5em;
      margin-bottom: 1em;
      color: #f0f4f8;
    }
    .banner-content button {
      padding: 14px 32px;
      font-size: 1em;
      background: linear-gradient(135deg, #f5a623 0%, #f39c12 100%); /* Gold to amber gradient */
      border: none;
      color: #141e30;
      cursor: pointer;
      border-radius: 30px;
      font-weight: bold;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(245,166,35,0.3);
    }
    .banner-content button:hover {
      background: linear-gradient(135deg, #f39c12 0%, #f5a623 100%);
      transform: translateY(-3px);
      box-shadow: 0 6px 16px rgba(245,166,35,0.4);
    }
    
    /* Features Section */
    .features {
      background: #ffffff;
      padding: 30px 0;
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .feature {
      flex: 1 1 180px;
      text-align: center;
      margin: 15px;
      padding: 20px 15px;
      border-radius: 8px;
      transition: all 0.3s ease;
    }
    .feature:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .feature i {
      font-size: 2.2em;
      margin-bottom: 12px;
      background: linear-gradient(135deg, #141e30, #243b55);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .feature p { 
      font-size: 0.95em;
      color: #34495e;
      font-weight: 500;
    }
    
    /* Dynamic Products (Featured Products) Section */
    .products {
      padding: 60px 20px;
      max-width: 1200px;
      margin: 0 auto;
      text-align: center;
      background: #ffffff;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.05);
      margin-top: 30px;
      margin-bottom: 30px;
    }
    .products h2 {
      margin-bottom: 40px;
      font-size: 2.2em;
      color: #141e30;
      position: relative;
      display: inline-block;
    }
    .products h2:after {
      content: '';
      display: block;
      width: 60%;
      height: 3px;
      background: linear-gradient(90deg, transparent, #f5a623, transparent);
      margin: 8px auto 0;
    }
    .product-grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 25px;
    }
    .product-card {
      background: #ffffff;
      border: none;
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
      padding: 20px;
      width: 280px;
      transition: all 0.3s ease;
      border-radius: 12px;
      position: relative;
      overflow: hidden;
    }
    .product-card:hover { 
      transform: translateY(-8px);
      box-shadow: 0 12px 30px rgba(0,0,0,0.12);
    }
    .product-card:before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: linear-gradient(90deg, #141e30, #243b55);
    }
    .product-card img {
      width: 100%;
      height: auto;
      object-fit: cover;
      border-radius: 8px;
      transition: all 0.5s ease;
    }
    .product-card:hover img {
      transform: scale(1.05);
    }
    .product-card h3 {
      font-size: 1.3em;
      margin: 15px 0 10px;
      color: #141e30;
    }
    .product-card p {
      font-size: 0.95em;
      color: #34495e;
      line-height: 1.5;
    }
    .product-card .price {
      font-size: 1.2em;
      color: #141e30;
      margin-top: 15px;
      font-weight: bold;
      display: inline-block;
      padding: 5px 15px;
      background: #f0f4f8;
      border-radius: 20px;
    }
    
    /* Welcome Message Section */
    .welcome {
      background: linear-gradient(135deg, #141e30 0%, #243b55 100%);
      color: #fff;
      text-align: center;
      padding: 25px;
      font-size: 1.2em;
      margin: 20px 0;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      border-radius: 0;
      position: relative;
      overflow: hidden;
    }
    .welcome:before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(45deg, transparent 49%, rgba(245,166,35,0.2) 50%, transparent 51%);
      background-size: 20px 20px;
      opacity: 0.3;
    }
    .welcome strong {
      color: #f5a623;
      font-weight: 700;
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
      .nav-container { 
        flex-direction: column; 
      }
      .nav-links ul { 
        flex-direction: column; 
        margin-top: 15px; 
        text-align: center;
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
        margin-top: 10px;
        width: 100%;
      }
      .banner-content h2 { 
        font-size: 2.4em; 
      }
      .banner-content p { 
        font-size: 1.2em; 
      }
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

    /* Update the search container and icons styles */
    .search-container {
      margin: 0 10px;
      display: flex;
      align-items: center;
      gap: 30px;
    }

    .search-wrapper {
      position: relative;
      width: 250px;
    }

    .nav-icons {
      display: flex;
      align-items: center;
      gap: 25px;
    }

    .nav-icons a {
      color: #243b55;
      font-size: 1.4em;
      transition: all 0.3s ease;
      padding: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .nav-icons a:hover {
      color: #f5a623;
      transform: scale(1.1);
    }

    /* Update responsive styles */
    @media (max-width: 768px) {
      .search-container {
        flex-direction: column;
        width: 100%;
        margin: 10px 0;
        gap: 15px;
      }
      
      .search-wrapper {
        width: 100%;
      }
      
      .nav-icons {
        justify-content: center;
        width: 100%;
      }
    }

    /* Add language dropdown styles */
    .language-dropdown {
      position: relative;
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
      top: 100%; /* Always below the button */
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

    /* Update nav-icons spacing */
    .nav-icons {
      display: flex;
      align-items: center;
      gap: 10px;
      position: relative;
    }

    /* Update responsive styles */
    @media (max-width: 768px) {
      .language-content {
        right: auto;
        left: 50%;
        transform: translateX(-50%);
      }
    }

    /* Update icon wrapper styles */
    .icon-wrapper {
      display: flex;
      align-items: center;
      gap: 10px;
      position: relative;
      margin-left: 5px;
    }

    .icon-wrapper a {
      color: #243b55;
      font-size: 1.4em;
      transition: all 0.3s ease;
      padding: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .icon-wrapper a:hover {
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

    .icon-wrapper:hover .dropdown-content {
      display: block;
    }

    /* Update responsive styles */
    @media (max-width: 768px) {
      .icon-wrapper {
        justify-content: center;
        width: 100%;
        margin: 10px 0;
      }
      
      .dropdown-content {
        position: static;
        width: 100%;
        margin-top: 10px;
      }
    }

    /* Add icon-group and update profile-dropdown styles */
    .icon-group {
      display: flex;
      align-items: center;
      gap: 10px;
      position: relative;
    }

    .profile-dropdown {
      position: relative;
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

    .profile-dropdown:hover .dropdown-content {
      display: block;
    }

    .nav-divider {
      width: 100%;
      height: 4px;
      background: linear-gradient(90deg, #f5a623 0%, #f39c12 100%);
      margin-bottom: 10px;
      border-radius: 2px;
    }
    .nav-vdivider {
      width: 4px;
      height: 40px;
      background: linear-gradient(180deg, #f5a623 0%, #f39c12 100%);
      margin: 0 18px;
      border-radius: 2px;
      align-self: center;
    }

    .add-to-cart-btn {
      display: block;
      width: 100%;
      margin: 18px 0 0 0;
      padding: 12px 0;
      background: linear-gradient(90deg, #f5a623 0%, #f39c12 100%);
      color: #fff;
      font-size: 1.05em;
      font-weight: 600;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      box-shadow: 0 4px 12px rgba(245,166,35,0.15);
      transition: background 0.3s, transform 0.2s, box-shadow 0.3s;
      letter-spacing: 1px;
    }
    .add-to-cart-btn:hover {
      background: linear-gradient(90deg, #f39c12 0%, #f5a623 100%);
      color: #141e30;
      transform: translateY(-2px) scale(1.03);
      box-shadow: 0 8px 20px rgba(245,166,35,0.25);
    }

    @keyframes cart-blink {
      0%, 100% { color: #f5a623; }
      50% { color: #fff; background: #f5a623; box-shadow: 0 0 10px #f5a623; }
    }
    .cart-icon.blink {
      animation: cart-blink 0.5s 2;
      border-radius: 50%;
    }
  </style>
</head>
<body>
 <!-- Navigation Bar - Restyled to match the image -->
 <nav>
  <div class="nav-container">
    <div class="nav-logo">
      <a href="#">Ironix Hardware Shop</a>
    </div>
    <div class="nav-vdivider"></div>
    <div class="nav-links">
      <ul>
        <li><a href="#" class="active">HOME</a></li>
        <li><a href="#">SERVICES</a></li>
        <li><a href="#">SUPPORT</a></li>
        <li><a href="blog.php">BLOG</a></li>
        <li><a href="#">CONTACT US</a></li>
        <li class="icon-group">
          <a href="cart.php" class="cart-icon"><i class="fas fa-shopping-cart"></i></a>
          <div class="profile-dropdown">
            <a href="#" class="profile-icon" id="userProfileIcon"><i class="fa-regular fa-user"></i></a>
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
      
    <!-- These are hidden in the top navigation but kept for other parts of the site -->
    <div class="nav-search" style="display:none;">
      <div class="search-wrapper">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" placeholder="Search products...">
      </div>
    </div>
      
    <div class="nav-icons" style="display:none;">
      <a href="login.html"><i class="fa-regular fa-user"></i></a>
      <a href="#"><i class="fas fa-shopping-cart"></i></a>
      <a href="#"><i class="fa-solid fa-bell"></i></a>
    </div>
  </div>
</nav>

  

  <!-- Banner Section (Hero) -->
  <section class="banner">
    <div class="banner-overlay"></div>
    <div class="banner-content">
      <h2>Compare Models Air</h2>
      <p>Awaken Your In-Between Moments</p>
      <button>Shop Now</button>
    </div>
  </section>
  <!-- Features Section -->
  <section class="features">
    <div class="feature">
      <i class="fas fa-truck"></i>
      <p>Free Shipping from $99.99</p>
    </div>
    <div class="feature">
      <i class="fas fa-dollar-sign"></i>
      <p>Money Guarantee<br>30-Day Back Policy</p>
    </div>
    <div class="feature">
      <i class="fas fa-lock"></i>
      <p>Secure Payment Methods</p>
    </div>
    <div class="feature">
      <i class="fas fa-headset"></i>
      <p>24/7 Online Support</p>
    </div>
    <div class="feature">
      <i class="fas fa-shield-alt"></i>
      <p>100% Safe &amp; Secure Shopping</p>
    </div>
  </section>

  <!-- Dynamic Products Section (Featured Products) -->
  <section class="products">
    <h2>Featured Products</h2>
    <div class="product-grid">
      <?php
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              echo '<div class="product-card">';
              echo '<img src="' . htmlspecialchars($row["image_url"]) . '" alt="' . htmlspecialchars($row["name"]) . '">';
              echo '<h3>' . htmlspecialchars($row["name"]) . '</h3>';
              echo '<p>' . htmlspecialchars($row["description"]) . '</p>';
              echo '<p class="price">$' . number_format($row["price"], 2) . '</p>';
              echo '<form class="add-to-cart-form" style="margin:0;">';
              echo '<input type="hidden" name="product_id" value="' . $row["id"] . '">';
              echo '<input type="hidden" name="name" value="' . htmlspecialchars($row["name"]) . '">';
              echo '<input type="hidden" name="description" value="' . htmlspecialchars($row["description"]) . '">';
              echo '<input type="hidden" name="price" value="' . $row["price"] . '">';
              echo '<input type="hidden" name="image_url" value="' . htmlspecialchars($row["image_url"]) . '">';
              echo '<button type="submit" class="add-to-cart-btn">Add to Cart</button>';
              echo '</form>';
              echo '</div>';
          }
      } else {
          echo '<p>No products found.</p>';
      }
      ?>
    </div>
  </section>
  
  <!-- Welcome Message Section (Below Featured Products) -->
  <section class="welcome">
    <p>Welcome to Ironix Hardware Shop | Discover amazing deals and new offers every day. Use coupon code <strong>IRONIX2025</strong> for exclusive discounts!</p>
  </section>

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
      <a href="#"><i class="fab fa-square-instagram"style="font-size: 1.2em;"></i> Instagram</a>
    </div>
    <p>
      &copy; 2025 Ironix Hardware Shop. All Rights Reserved. Powered by Ironix Solutions.
      <a href="#">Privacy &amp; Cookie Policy</a>
    </p>
  </div>

  <!-- JavaScript: Image Ads Behind the Banner Section -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Create an ad container element inside the banner
      var adContainer = document.createElement("div");
      adContainer.id = "adContainer";
      adContainer.style.position = "absolute";
      adContainer.style.top = "0";
      adContainer.style.left = "0";
      adContainer.style.width = "100%";
      adContainer.style.height = "100%";
      adContainer.style.zIndex = "-1"; // Place behind the banner overlay and content
      adContainer.style.pointerEvents = "none"; // Ensure it doesn't block clicks
      
      // Append this container to the banner section
      var banner = document.querySelector(".banner");
      if (banner) {
        banner.appendChild(adContainer);
      }
      
      // Create an image element for the ad inside the container
      var adImg = document.createElement("img");
      adImg.style.width = "100%";
      adImg.style.height = "100%";
      adImg.style.objectFit = "cover";
      adContainer.appendChild(adImg);
      
      // Array of ad image URLs (Replace these placeholders with your actual ad image URLs)
      var adImages = [
        "ad1.jpg",
        "ad2.jpg",
        "ad3.jpg"
      ];
      var currentAd = 0;
      // Set the initial ad image
      adImg.src = adImages[currentAd];
      
      // Cycle through the ad images every 5 seconds
      setInterval(function() {
        currentAd = (currentAd + 1) % adImages.length;
        adImg.src = adImages[currentAd];
      }, 5000);
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var langBtn = document.querySelector('.language-dropdown > a.language-icon');
      var langMenu = document.querySelector('.language-dropdown .language-content');

      if (langBtn && langMenu) {
        langBtn.addEventListener('click', function(e) {
          e.preventDefault();
          langMenu.style.display = (langMenu.style.display === 'block') ? 'none' : 'block';
        });

        // Hide dropdown when clicking outside
        document.addEventListener('click', function(e) {
          if (!langBtn.contains(e.target) && !langMenu.contains(e.target)) {
            langMenu.style.display = 'none';
          }
        });
      }
    });
  </script>

  <!-- Modal for Cart Visualization -->
  <div id="cartModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:16px; max-width:350px; margin:auto; padding:24px; text-align:center; position:relative;">
      <span id="closeCartModal" style="position:absolute; top:10px; right:18px; font-size:1.5em; cursor:pointer;">&times;</span>
      <img id="cartModalImg" src="" alt="" style="width:100px; height:100px; object-fit:cover; border-radius:8px; margin-bottom:12px;">
      <h3 id="cartModalName"></h3>
      <p id="cartModalDesc" style="font-size:0.95em; color:#34495e;"></p>
      <p id="cartModalPrice" style="font-weight:bold; color:#f5a623;"></p>
      <p style="font-size:0.9em; color:#888;">Product ID: <span id="cartModalId"></span></p>
      <div style="margin: 18px 0;">
        <label style="font-size:0.95em; color:#34495e; margin-bottom:6px; display:block;">Quantity</label>
        <div style="display:flex; align-items:center; justify-content:center; gap:10px;">
          <button id="qtyMinus" style="width:32px; height:32px; border:none; background:#f5a623; color:#fff; font-size:1.2em; border-radius:50%; cursor:pointer;">-</button>
          <input id="cartModalQty" type="text" value="1" style="width:40px; text-align:center; font-size:1.1em; border:1px solid #eee; border-radius:8px; padding:4px 0;" readonly>
          <button id="qtyPlus" style="width:32px; height:32px; border:none; background:#f5a623; color:#fff; font-size:1.2em; border-radius:50%; cursor:pointer;">+</button>
        </div>
      </div>
      <button id="confirmAddToCart" style="margin-top:10px; width:100%; padding:12px 0; background:linear-gradient(90deg,#f5a623 0%,#f39c12 100%); color:#fff; font-size:1.05em; font-weight:600; border:none; border-radius:25px; cursor:pointer; box-shadow:0 4px 12px rgba(245,166,35,0.15); transition:background 0.3s,transform 0.2s,box-shadow 0.3s; letter-spacing:1px;">Add to Cart</button>
    </div>
  </div>

  <script>
  let currentProduct = {};

  document.querySelectorAll('.add-to-cart-form').forEach(function(form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      var formData = new FormData(form);
      // Store product data for later use
      currentProduct = {
        product_id: formData.get('product_id'),
        name: formData.get('name'),
        description: formData.get('description'),
        price: formData.get('price'),
        image_url: formData.get('image_url')
      };
      document.getElementById('cartModalImg').src = currentProduct.image_url;
      document.getElementById('cartModalName').textContent = currentProduct.name;
      document.getElementById('cartModalDesc').textContent = currentProduct.description;
      document.getElementById('cartModalPrice').textContent = '$' + parseFloat(currentProduct.price).toFixed(2);
      document.getElementById('cartModalId').textContent = currentProduct.product_id;
      document.getElementById('cartModalQty').value = 1;
      document.getElementById('cartModal').style.display = 'flex';
    });
  });

  document.getElementById('closeCartModal').onclick = function() {
    document.getElementById('cartModal').style.display = 'none';
  };
  window.onclick = function(event) {
    var modal = document.getElementById('cartModal');
    if (event.target == modal) {
      modal.style.display = 'none';
    }
  };

  // Quantity controls
  document.getElementById('qtyMinus').onclick = function() {
    let qty = parseInt(document.getElementById('cartModalQty').value, 10);
    if (qty > 1) document.getElementById('cartModalQty').value = qty - 1;
  };
  document.getElementById('qtyPlus').onclick = function() {
    let qty = parseInt(document.getElementById('cartModalQty').value, 10);
    document.getElementById('cartModalQty').value = qty + 1;
  };

  // Confirm Add to Cart with quantity
  document.getElementById('confirmAddToCart').onclick = function() {
    let qty = parseInt(document.getElementById('cartModalQty').value, 10);
    let formData = new FormData();
    formData.append('product_id', currentProduct.product_id);
    formData.append('name', currentProduct.name);
    formData.append('description', currentProduct.description);
    formData.append('price', currentProduct.price);
    formData.append('image_url', currentProduct.image_url);
    formData.append('quantity', qty);

    fetch('add_to_cart.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      document.getElementById('cartModal').style.display = 'none';
      // Make the cart icon blink
      var cartIcon = document.querySelector('.cart-icon');
      if (cartIcon) {
        cartIcon.classList.add('blink');
        setTimeout(function() {
          cartIcon.classList.remove('blink');
        }, 1000);
      }
    });
  };

  // Add event listener to user icon to redirect to login.html
  document.addEventListener('DOMContentLoaded', function() {
    var userProfileIcon = document.getElementById('userProfileIcon');
    if (userProfileIcon) {
      userProfileIcon.addEventListener('click', function(e) {
        e.preventDefault();
        window.location.href = 'login.html';
      });
    }
  });
  </script>

  <?php
  // Close the database connection
  $conn->close();
  ?>
</body>
</html>