<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $user = $_POST['user'] ?? '';
    $pass = $_POST['pass'] ?? '';

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

    // Preparing the SQL statement for SELECT query
    $stmt = $conn->prepare("SELECT * FROM dana WHERE user = ? AND pass = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Binding parameters
    $stmt->bind_param("ss", $user, $pass);

    // Executing the statement
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Fetch the user data
            header("Location: About.html");
            exit;
            // Here, you might want to start a session or redirect the user to another page
        } else {
            header("Location: signup.html");
            exit;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Error executing query: " . $stmt->error;
        $stmt->close();
        $conn->close();
    }
} else {
    // Form not submitted, redirect back to the login form
    header("Location: login.html");
    exit;
}
?>
