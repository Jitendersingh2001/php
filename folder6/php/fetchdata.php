<?php
include("database.php");
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result) {
    $data = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(array("error" => "Database query failed"));
}



?>
