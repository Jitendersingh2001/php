<?php
include("database.php");
// Query to select distinct product types from the 'products' table
$sql = "SELECT DISTINCT product_type FROM products";
$result = $conn->query($sql);

if ($result) {
    $productTypes = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $productTypes[] = $row['product_type'];
    }
    echo json_encode(array("product_types" => $productTypes));
} else {
    echo json_encode(array("error" => "Database query for distinct product types failed"));
}
?>
