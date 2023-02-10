<?php
$servername = "localhost";
$username = "root";
$password = "Tony_123";
$dbname = "productsDB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// I used PhpMyAdmin to create Database
// but here is the SQL to create table

// $sql = "CREATE DATABASE productsDB";

$sql = "CREATE TABLE products (
    id INT() UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    SKU VARCHAR(120) NULL INDEX KEY,
    name VARCHAR(120) NULL,
    price FLOAT() NULL,
    size INT() NOT NULL,
    height INT() NOT NULL,
    width INT() NOT NULL,
    length INT() NOT NULL,
    weight FLOAT() NOT NULL,
    )";
    
    
//     $conn->close();

?>



