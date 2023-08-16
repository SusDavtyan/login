<?php
session_start();

// Establish database connection
$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "user_accounts";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input
$username = $_POST['username'];
$password = $_POST['password'];

// Retrieve user data from database
$sql = "SELECT id, username, password FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        echo "Login successful!";
    } else {
        echo "Invalid password.";
    }
} else {
    echo "User not found.";
}

$conn->close();
?>
