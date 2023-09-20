<?php
include("database.php");

// Query to select data from the 'products' table
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->rowCount() > 0) {
    $data = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(array()); // Return an empty JSON array if no data is found
}
?>
