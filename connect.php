<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieving form data
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$country = $_POST['country'];
$phone = $_POST['phone'];

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Consider adding a password for security in production
$dbname = "signupform";

// Establishing the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Checking the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Preparing the SQL statement
$stmt = $conn->prepare("INSERT INTO nour (fname, lname, email, country, phone) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

// Binding parameters
$result = $stmt->bind_param("sssss", $fname, $lname, $email, $country, $phone);
if (!$result) {
    die("Error binding parameters: " . $stmt->error);
}

// Executing the statement
if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error executing statement: " . $stmt->error; 
}

// Closing the statement and connection
$stmt->close();
$conn->close();
?>
