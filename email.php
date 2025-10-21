<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $emailnews = $_POST['emailnews'] ?? '';


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "signupform";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
    }
    else {
        $stmt = $conn->prepare("INSERT INTO emails (emailnews) VALUES (?)");
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }

        // Binding parameters
        $result = $stmt->bind_param("s", $emailnews);
        if (!$result) {
            die("Error binding parameters: " . $stmt->error);
        }

        // Executing the statement
        if ($stmt->execute()) {
            // Close the statement and connection before redirecting
            $stmt->close();
            $conn->close();

            // Redirect to about.html
            header("Location: indexn.html");
            exit;
        } else {
            echo "Error executing statement: " . $stmt->error;
        }

        // Closing the statement and connection
        $stmt->close();
        $conn->close();
} 
}
?>

