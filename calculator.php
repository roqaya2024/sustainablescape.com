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

   


    $stmt = $conn->prepare("INSERT INTO calculate (bottles, bags, straws, wrappers, cleaning, cosmetics, others, box, cup, straw, cutlery, plates, furniture, people) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiiiiiiiiiiii", $bottles, $bags, $straws, $wrappers, $cleaning, $cosmetics, $others, $box, $cup, $straw, $cutlery, $plates, $furniture, $people);


    $bottles = $_POST['bottles'];
    $bags = $_POST['bags'];
    $straws = $_POST['straws'];
    $wrappers = $_POST['wrappers'];
    $cleaning = $_POST['cleaning'];
    $cosmetics = $_POST['cosmetics'];
    $others = $_POST['others'];
    $box = $_POST['box'];
    $cup = $_POST['cup'];
    $straw = $_POST['straw'];
    $cutlery = $_POST['cutlery'];
    $plates = $_POST['plates'];
    $furniture = $_POST['furniture'];
    $people = $_POST['people'];

   
    $stmt->execute();

   
    $stmt->close();
    $conn->close();

    
    header("Location: calculator.html");
    exit();
}
?>
