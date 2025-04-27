<?php
session_start();

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

// Get POST data
$id = isset($_POST['id']) ? $conn->real_escape_string($_POST['id']) : '';
$name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : '';
$email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
$phone = isset($_POST['phone']) ? $conn->real_escape_string($_POST['phone']) : '';
$address = isset($_POST['address']) ? $conn->real_escape_string($_POST['address']) : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user exists
    $sql = "SELECT * FROM users WHERE id='$id' AND name='$name' AND email='$email' AND phone='$phone' AND address='$address'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // User found, login successful
        $_SESSION['user_id'] = $id;
        $_SESSION['user_name'] = $name;
        header("Location: index.php"); // Redirect to home or dashboard
        exit();
    } else {
        // User not found, insert new user
        $insert = "INSERT INTO users (id, name, email, phone, address) VALUES ('$id', '$name', '$email', '$phone', '$address')";
        if ($conn->query($insert) === TRUE) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            header("Location: index.php"); // Redirect to home or dashboard
            exit();
        } else {
            echo "<script>alert('Registration failed: " . $conn->error . "'); window.location.href='login.html';</script>";
            exit();
        }
    }
} else {
    header("Location: login.html");
    exit();
}
?>
