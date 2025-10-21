<?php

$products = array(
    array("name" => "Product 1", "price" => 10),
    array("name" => "Product 2", "price" => 20),
    array("name" => "Product 3", "price" => 30)
);

$json = json_encode($products);

header('Content-Type: application/json');

echo $json;
?>
