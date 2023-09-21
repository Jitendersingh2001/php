<?php
include("database.php");

if(isset($_POST["id"])) {
    $id = $_POST["id"];

    if($_POST["action"] == "edit") {
        $result = selectProduct($id, $conn);
        echo $result;
    } else if($_POST["action"] == "delete") {
        $result = deleteProduct($id, $conn);
        echo $result;
    }
}

function selectProduct($id, $conn) {
    try {
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {  
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return json_encode($data); 
        } else {
            return "No records were found";
        }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}

function deleteProduct($id, $conn) {
    try {
        $stmt = $conn->prepare("DELETE FROM products WHERE product_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "Record deleted successfully";
        } else {
            return "No records were deleted";
        }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}
?>
