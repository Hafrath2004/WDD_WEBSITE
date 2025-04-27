<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ironix";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$id = isset($_POST['id']) ? $conn->real_escape_string($_POST['id']) : '';
$name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : '';
$email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
$password_input = isset($_POST['password']) ? $conn->real_escape_string($_POST['password']) : '';
$gender = isset($_POST['gender']) ? $conn->real_escape_string($_POST['gender']) : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if admin exists with all credentials
    $sql = "SELECT * FROM admin WHERE id='$id' AND name='$name' AND email='$email' AND password='$password_input' AND gender='$gender'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Admin found, login successful
        $_SESSION['admin_id'] = $id;
        $_SESSION['admin_name'] = $name;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Check if ID already exists
        $checkId = $conn->query("SELECT * FROM admin WHERE id='$id'");
        if ($checkId && $checkId->num_rows > 0) {
            echo "<script>alert('Admin ID already exists. Please use a different ID or login with your existing credentials.'); window.location.href='admin_login.html';</script>";
            exit();
        }
        // Admin not found, insert new admin
        $insert = "INSERT INTO admin (id, name, email, password, gender) VALUES ('$id', '$name', '$email', '$password_input', '$gender')";
        if ($conn->query($insert) === TRUE) {
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_name'] = $name;
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "<script>alert('Registration failed: " . $conn->error . "'); window.location.href='admin_login.html';</script>";
            exit();
        }
    }
} else {
    header("Location: admin_login.html");
    exit();
}
?>
