<?php
// Start session
session_start();

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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    
    // Check if email already exists
    $checkEmail = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmail);
    
    // Response data array (for AJAX support)
    $response = [];
    
    if ($result->num_rows > 0) {
        // Email already exists
        $response['success'] = false;
        $response['message'] = "Email already registered. Please use a different email.";
    } else {
        // Insert new user into database
        $sql = "INSERT INTO users (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";
        
        if ($conn->query($sql) === TRUE) {
            // Registration successful, get the new user ID
            $newUserId = $conn->insert_id;
            
            // Store user data in session (auto-login after registration)
            $_SESSION['user_id'] = $newUserId;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;
            $_SESSION['logged_in'] = true;
            
            $response['success'] = true;
            $response['message'] = "Registration successful! Your user ID is: " . $newUserId;
            $response['redirect'] = "index.php";
        } else {
            // Registration failed
            $response['success'] = false;
            $response['message'] = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    
    // If it's an AJAX request, return JSON response
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } else {
        // For traditional form submission, redirect based on registration result
        if ($response['success']) {
            $_SESSION['registration_success'] = $response['message'];
            header("Location: " . $response['redirect']);
            exit;
        } else {
            // Store error message in session and redirect back to registration page
            $_SESSION['registration_error'] = $response['message'];
            header("Location: register.php");
            exit;
        }
    }
}

// If not a POST request, redirect to registration page
header("Location: register.php");
exit;
?>