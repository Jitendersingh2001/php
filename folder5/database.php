<?php
/* letibale needed to establish the connection */

$db_server = "localhost";
$db_username = "root";
$db_password = "";
$db_name= "product";

    // $conn=mysqli_connect($db_server,$db_username,$db_password,$db_name);

// try and catch block to handle the connection if it get failed or get successfully using PDO 
try {
    $conn = new PDO("mysql:host=$db_server;dbname=$db_name", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
/*
-> The new PDO statement should include a Data Source Name (DSN) that specifies the database type (mysql), host (localhost), and the database name you want to connect to. Replace 'your_database_name' with the actual name of your database.

-> Added a catch block to catch PDOException exceptions and display an error message if there's a connection issue.

-> Set the PDO error mode to exception using $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);. This will ensure that PDO throws exceptions when there are errors, making it easier to handle them. */