<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ironix";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
$admins = $conn->query("SELECT * FROM admin");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ironix Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Google Fonts & Font Awesome -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --main-blue: #243b55;
      --main-gold: #f5a623;
      --main-bg: #f8f9fa;
      --card-red: #ff5e62;
      --card-blue: #5e72e4;
      --card-yellow: #ffd600;
      --sidebar-bg: #232946;
      --sidebar-active: #f5a623;
      --sidebar-hover: #243b55;
    }
    body {
      margin: 0;
      font-family: 'Poppins', Arial, sans-serif;
      background: var(--main-bg);
      color: var(--main-blue);
    }
    .dashboard-container {
      display: flex;
      min-height: 100vh;
    }
    /* Sidebar */
    .sidebar {
      width: 230px;
      background: var(--sidebar-bg);
      color: #fff;
      display: flex;
      flex-direction: column;
      padding: 24px 0;
      min-height: 100vh;
      box-shadow: 2px 0 12px rgba(36,59,85,0.08);
    }
    .sidebar .brand {
      font-size: 1.5em;
      font-weight: 700;
      color: var(--main-gold);
      text-align: center;
      margin-bottom: 32px;
      letter-spacing: 2px;
    }
    .sidebar ul {
      list-style: none;
      padding: 0;
      margin: 0;
      flex: 1;
    }
    .sidebar ul li {
      margin-bottom: 8px;
    }
    .sidebar ul li a {
      display: flex;
      align-items: center;
      color: #fff;
      text-decoration: none;
      padding: 12px 32px;
      font-size: 1.05em;
      border-left: 4px solid transparent;
      transition: background 0.2s, border 0.2s;
    }
    .sidebar ul li a.active,
    .sidebar ul li a:hover {
      background: var(--sidebar-hover);
      border-left: 4px solid var(--sidebar-active);
      color: var(--main-gold);
    }
    .sidebar ul li a i {
      margin-right: 14px;
      font-size: 1.1em;
    }
    .sidebar .sidebar-footer {
      text-align: center;
      font-size: 0.95em;
      color: #b0b0b0;
      margin-top: 32px;
    }
    /* Main Content */
    .main-content {
      flex: 1;
      padding: 36px 40px 36px 40px;
      background: var(--main-bg);
      min-width: 0;
    }
    .dashboard-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 32px;
    }
    .dashboard-header .welcome {
      font-size: 1.5em;
      font-weight: 600;
      color: var(--main-blue);
    }
    .dashboard-header .profile {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .dashboard-header .profile-img {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid var(--main-gold);
    }
    .dashboard-header .profile-name {
      font-weight: 500;
      color: var(--main-blue);
    }
    .profile-dropdown {
      position: relative;
      display: inline-block;
    }
    .profile-btn {
      background: none;
      border: none;
      color: var(--main-blue);
      font-size: 1.2em;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 4px;
    }
    .profile-menu {
      display: none;
      position: absolute;
      right: 0;
      top: 120%;
      background: #fff;
      min-width: 140px;
      box-shadow: 0 4px 16px rgba(36,59,85,0.12);
      border-radius: 10px;
      z-index: 10;
      padding: 8px 0;
    }
    .profile-menu a {
      display: flex;
      align-items: center;
      gap: 8px;
      color: var(--main-blue);
      padding: 10px 18px;
      text-decoration: none;
      font-size: 1em;
      transition: background 0.2s;
    }
    .profile-menu a:hover {
      background: #f5a623;
      color: #fff;
    }
    .profile-dropdown.show .profile-menu {
      display: block;
    }
    /* Cards */
    .dashboard-cards {
      display: flex;
      gap: 24px;
      margin-bottom: 32px;
      flex-wrap: wrap;
    }
    .dashboard-card {
      flex: 1 1 220px;
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 16px rgba(36,59,85,0.07);
      padding: 24px 20px;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      min-width: 200px;
      position: relative;
      overflow: hidden;
    }
    .dashboard-card .card-icon {
      font-size: 2em;
      margin-bottom: 10px;
      opacity: 0.8;
    }
    .dashboard-card.red { border-top: 5px solid var(--card-red);}
    .dashboard-card.red .card-icon { color: var(--card-red);}
    .dashboard-card.blue { border-top: 5px solid var(--card-blue);}
    .dashboard-card.blue .card-icon { color: var(--card-blue);}
    .dashboard-card.yellow { border-top: 5px solid var(--card-yellow);}
    .dashboard-card.yellow .card-icon { color: var(--card-yellow);}
    .dashboard-card .card-title {
      font-size: 1.1em;
      font-weight: 600;
      margin-bottom: 6px;
      color: var(--main-blue);
    }
    .dashboard-card .card-value {
      font-size: 2em;
      font-weight: 700;
      margin-bottom: 8px;
    }
    .dashboard-card .card-desc {
      font-size: 0.98em;
      color: #888;
      margin-bottom: 6px;
    }
    .dashboard-card .card-date {
      font-size: 0.9em;
      color: #b0b0b0;
    }
    /* Table */
    .dashboard-table-container {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 16px rgba(36,59,85,0.07);
      padding: 24px 20px;
      margin-top: 12px;
    }
    .dashboard-table-tabs {
      display: flex;
      gap: 12px;
      margin-bottom: 18px;
    }
    .dashboard-table-tabs button {
      background: #f0f4f8;
      border: none;
      border-radius: 8px;
      padding: 8px 18px;
      font-size: 1em;
      color: var(--main-blue);
      font-weight: 500;
      cursor: pointer;
      transition: background 0.2s, color 0.2s;
    }
    .dashboard-table-tabs button.active,
    .dashboard-table-tabs button:hover {
      background: var(--main-gold);
      color: #fff;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 8px;
    }
    th, td {
      padding: 12px 10px;
      text-align: left;
    }
    th {
      background: #f0f4f8;
      color: var(--main-blue);
      font-weight: 600;
      font-size: 1em;
    }
    tr:nth-child(even) {
      background: #f8f9fa;
    }
    tr:hover {
      background: #fffbe6;
    }
    .payment-reminder {
      background: var(--main-gold);
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 8px 18px;
      font-size: 1em;
      font-weight: 500;
      float: right;
      margin-bottom: 10px;
      cursor: pointer;
      transition: background 0.2s;
    }
    .payment-reminder:hover {
      background: #ffb300;
    }
    @media (max-width: 900px) {
      .dashboard-cards {
        flex-direction: column;
      }
      .main-content {
        padding: 24px 6px;
      }
    }
    @media (max-width: 600px) {
      .sidebar {
        display: none;
      }
      .main-content {
        padding: 12px 2px;
      }
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <!-- Sidebar -->
    <nav class="sidebar">
      <div class="brand"><i class="fa-solid fa-screwdriver-wrench"></i> Ironix Admin</div>
      <ul>
        <li><a href="#" class="active"><i class="fa-solid fa-chart-pie"></i> Dashboard</a></li>
        <li><a href="#"><i class="fa-solid fa-box"></i> Products</a></li>
        <li><a href="#"><i class="fa-solid fa-users"></i> Customers</a></li>
        <li><a href="#"><i class="fa-solid fa-warehouse"></i> Inventory</a></li>
        <li><a href="#"><i class="fa-solid fa-user-gear"></i> Admins</a></li>
        <li><a href="#"><i class="fa-solid fa-gear"></i> Settings</a></li>
      </ul>
      <div class="sidebar-footer">
        &copy; 2025 Ironix Hardware Shop
      </div>
    </nav>
    <!-- Main Content -->
    <div class="main-content">
      <div class="dashboard-header">
        <div class="welcome">Welcome Back <span style="font-size:1.2em;">👋</span></div>
        <div class="profile">
          <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin" class="profile-img">
          <span class="profile-name">Admin User</span>
          <div class="profile-dropdown">
            <button class="profile-btn">
              <i class="fa-regular fa-user"></i>
              <i class="fa-solid fa-caret-down"></i>
            </button>
            <div class="profile-menu">
              <a href="admin_login.html"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
              <a href="admin_logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Cards -->
      <div class="dashboard-cards">
        <div class="dashboard-card red">
          <div class="card-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
          <div class="card-title">Total Products</div>
          <div class="card-value">450</div>
          <div class="card-desc">Products in Inventory</div>
          <div class="card-date"><i class="fa-regular fa-calendar"></i> 30 April 2025</div>
        </div>
        <div class="dashboard-card blue">
          <div class="card-icon"><i class="fa-solid fa-users"></i></div>
          <div class="card-title">Customers</div>
          <div class="card-value">310</div>
          <div class="card-desc">Active Customers</div>
          <div class="card-date"><i class="fa-regular fa-calendar"></i> 30 April 2025</div>
        </div>
        <div class="dashboard-card yellow">
          <div class="card-icon"><i class="fa-solid fa-warehouse"></i></div>
          <div class="card-title">Current Stock</div>
          <div class="card-value">560</div>
          <div class="card-desc">Items in Stock</div>
          <div class="card-date"><i class="fa-regular fa-calendar"></i> 30 April 2025</div>
        </div>
      </div>
      <!-- Table Section -->
      <div class="dashboard-table-container">
        <div class="dashboard-table-tabs">
          <button class="active">Products</button>
          <button>Customers</button>
          <button>Admins</button>
        </div>
        <!-- Product Actions Dropdown -->
        <div class="product-actions" style="margin-bottom: 12px; position: relative; display: inline-block;">
          <button id="productActionsBtn" style="background: var(--main-gold); color: #fff; border: none; border-radius: 8px; padding: 8px 18px; font-size: 1em; font-weight: 500; cursor: pointer;">
            <i class="fa-solid fa-ellipsis-vertical"></i> Product Actions
          </button>
          <div id="productActionsMenu" style="display:none; position:absolute; left:0; top:110%; background:#fff; box-shadow:0 4px 16px rgba(36,59,85,0.12); border-radius:10px; min-width:160px; z-index:10;">
            <a href="add_product.php" style="display:block; padding:10px 18px; color:var(--main-blue); text-decoration:none; font-size:1em; border-bottom:1px solid #f0f0f0;">
              <i class="fa-solid fa-plus"></i> Add Product
            </a>
            <a href="#" style="display:block; padding:10px 18px; color:var(--main-blue); text-decoration:none; font-size:1em;"><i class="fa-solid fa-trash"></i> Delete Product</a>
          </div>
        </div>
        <?php if (isset($_GET['delete_status'])): ?>
          <div style="padding:10px 18px; border-radius:8px; margin-bottom:10px; color:#fff; background:<?= $_GET['delete_status']==='success' ? '#43a047' : '#e53935' ?>;">
            <?= $_GET['delete_status']==='success' ? 'Product deleted successfully.' : 'Product not found or could not be deleted.' ?>
          </div>
        <?php endif; ?>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Description</th>
              <th>Price</th>
              <th>Image URL</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $latestProduct = $conn->query("SELECT * FROM products ORDER BY id DESC LIMIT 1");
            if ($latestProduct && $latestProduct->num_rows > 0):
              $row = $latestProduct->fetch_assoc(); ?>
                <tr>
                  <td><?= htmlspecialchars($row['id']) ?></td>
                  <td><?= htmlspecialchars($row['name']) ?></td>
                  <td><?= htmlspecialchars($row['description']) ?></td>
                  <td>$<?= number_format($row['price'], 2) ?></td>
                  <td style="max-width:220px; overflow-x:auto; white-space:nowrap;">
                    <a href="<?= htmlspecialchars($row['image_url']) ?>" target="_blank">View Image</a>
                  </td>
                </tr>
            <?php else: ?>
              <tr><td colspan="5" style="text-align:center;">No products found.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <!-- Admins Table (Dynamic from DB) -->
      <div id="admins-table" style="display:none;">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>Gender</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($admins && $admins->num_rows > 0): ?>
              <?php while($row = $admins->fetch_assoc()): ?>
                <tr>
                  <td><?= htmlspecialchars($row['id']) ?></td>
                  <td><?= htmlspecialchars($row['name']) ?></td>
                  <td><?= htmlspecialchars($row['email']) ?></td>
                  <td><?= htmlspecialchars($row['password']) ?></td>
                  <td><?= htmlspecialchars($row['gender']) ?></td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr><td colspan="5" style="text-align:center;">No admins found.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script>
    // Tab switching logic
    const tabs = document.querySelectorAll('.dashboard-table-tabs button');
    const tables = [
      document.querySelector('table'), // Products table (first)
      null, // Customers table (not implemented)
      document.getElementById('admins-table')
    ];
    tabs.forEach((tab, idx) => {
      tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        // Hide all tables
        document.querySelector('table').style.display = idx === 0 ? '' : 'none';
        if (tables[2]) tables[2].style.display = idx === 2 ? '' : 'none';
        // (You can add logic for Customers table if needed)
      });
    });
    // Profile dropdown logic
    document.querySelector('.profile-btn').onclick = function(e) {
      e.stopPropagation();
      document.querySelector('.profile-dropdown').classList.toggle('show');
    };
    document.body.onclick = function() {
      document.querySelector('.profile-dropdown').classList.remove('show');
    };
    // Product Actions Dropdown logic
    document.getElementById('productActionsBtn').onclick = function(e) {
      e.stopPropagation();
      var menu = document.getElementById('productActionsMenu');
      menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    };
    document.body.addEventListener('click', function() {
      document.getElementById('productActionsMenu').style.display = 'none';
    });
  </script>
</body>
</html>
