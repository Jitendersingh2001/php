<?php
include("database.php");
$sql_total_count = "SELECT COUNT(*) AS total FROM products";
$result_total_count = $conn->query($sql_total_count);
$total_count = $result_total_count->fetch(PDO::FETCH_ASSOC)["total"];
$limit = 10;    
    if (isset($_GET["page"])) { 
      $pn  = $_GET["page"]; 
    } 
    else { 
      $pn=1; 
    };  
  
    $start_from = ($pn-1) * $limit;  
 
    $sql = "SELECT * FROM products LIMIT $start_from, $limit";  
$result = $conn->query($sql);

if ($result) {
    $data = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }  
      $response = array(
        "data" => $data,
        "total_count" => $total_count
    );

    echo json_encode($response);
} else {
    echo json_encode(array("error" => "Database query failed"));
}
?>
