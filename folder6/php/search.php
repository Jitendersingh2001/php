<?php
include("database.php"); // Include your database connection code here

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "SELECT * FROM products WHERE product_name LIKE '%$search%' OR product_description LIKE '%$search%'";
    $result = $conn->query($sql);

    if ($result) {
        $data = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo json_encode(array("error" => "Database query failed: " . $conn->errorInfo()));
    }
} else {
    echo json_encode(array("error" => "Search parameter not provided"));
}
?>