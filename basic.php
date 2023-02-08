<?php
$servername = "localhost";
$username = "root";
$password = "Tony_123";
$dbname = "productsDB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// $sql = "CREATE DATABASE productsDB";

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table

$sql = "CREATE TABLE products (
    id INT() UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    SKU VARCHAR(120) NOT NULL,
    name VARCHAR(120) NOT NULL,
    price INT()
    )";
    
    
//     $conn->close();

?>



