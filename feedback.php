<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $foodSustainability = $_POST['foodSustainability'] ?? '';
    $plasticSustainability = $_POST['plasticSustainability'] ?? '';
    $sustainabilityInfo = $_POST['sustainabilityInfo'] ?? '';
    $recommendationLikelihood = $_POST['recommendationLikelihood'] ?? '';
    $serviceQuality = $_POST['serviceQuality'] ?? '';
    $additionalComments = $_POST['additionalComments'] ?? '';
  
  

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
    $stmt = $conn->prepare("INSERT INTO feedback (foodSustainability, plasticSustainability, sustainabilityInfo, recommendationLikelihood , serviceQuality, additionalComments) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Binding parameters
    $result = $stmt->bind_param("ssssss", $foodSustainability, $plasticSustainability, $sustainabilityInfo, $recommendationLikelihood , $serviceQuality, $additionalComments);
    if (!$result) {
        die("Error binding parameters: " . $stmt->error);
    }

    // Executing the statement
    if ($stmt->execute()) {
        // Close the statement and connection before redirecting
        $stmt->close();
        $conn->close();

        // Redirect to about.html
        header("Location: About.html" );
        exit;
    } else {
        echo "Error executing statement: " . $stmt->error;
    }

    // Closing the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Form not submitted, perhaps redirect back to the form or to an error page
    header("Location: feedback.html");
    exit;
}
?>
