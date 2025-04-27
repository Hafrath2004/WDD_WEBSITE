<?php
// add_to_cart.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ironix";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$product_id = intval($_POST['product_id']);
$name = $_POST['name'];
$description = $_POST['description'];
$price = floatval($_POST['price']);
$image_url = $_POST['image_url'];
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

// Check if product already in cart
$check = $conn->prepare("SELECT quantity FROM cart WHERE product_id = ?");
$check->bind_param("i", $product_id);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    $check->bind_result($existing_qty);
    $check->fetch();
    $new_qty = $existing_qty + $quantity;
    $update = $conn->prepare("UPDATE cart SET quantity = ? WHERE product_id = ?");
    $update->bind_param("ii", $new_qty, $product_id);
    $update->execute();
    $update->close();
} else {
    $sql = "INSERT INTO cart (product_id, name, price, quantity, description, image_url) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isdis", $product_id, $name, $price, $quantity, $description, $image_url);
    $stmt->execute();
    $stmt->close();
}
$check->close();

$response = [
    "id" => $product_id,
    "name" => $name,
    "description" => $description,
    "price" => $price,
    "image_url" => $image_url
];
header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
