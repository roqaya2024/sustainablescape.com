<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "signupform";

    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "INSERT INTO diys (comment, picture_path) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $comment, $picture_path);


    $comment = !empty($_POST['comment']) ? $_POST['comment'] : "No comment provided";
    $picture_path = "";


    if (isset($_FILES['picture_path']) && $_FILES['picture_path']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['picture_path']['name'];
        $file_tmp = $_FILES['picture_path']['tmp_name'];


        $upload_directory = "uploads/";
        $picture_path = $upload_directory . basename($file_name);

        if (move_uploaded_file($file_tmp, $picture_path)) {
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "No file uploaded or file upload error occurred.";
    }


    if ($stmt->execute() === TRUE) {
        // Redirect back to diys.html (or whatever page you want)
        header("Location: diys.html?success=1");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {

    header("Location: diys.html");
}
