<?php
include("database.php");
$id = $_POST["rowId"];
$name = $_POST["ProductName"];
$description = $_POST["ProductDescription"];
$price = $_POST["ProductPrize"];
$category = $_POST["ProductCategory"];
$otherCategory = $_POST["othercategoryfield"];
$currentImageSrc=$_POST["currentImageSrc"];
$targetDir = "../upload/";
$targetFile = $targetDir . basename($_FILES["ProductImage"]["name"]);

if (move_uploaded_file($_FILES["ProductImage"]["tmp_name"], $targetFile)) {
    echo "Image uploaded successfully.";
    echo "Image location: " . $targetFile;
    $targetFile = "../folder6/upload/" . basename($_FILES["ProductImage"]["name"]);
} else {
   $targetFile=$currentImageSrc; 
}

if ($category === "Other") {
    $category = $otherCategory;
}
$stmt = $conn->prepare("UPDATE products SET product_name=:name, product_description=:description, product_price=:price, product_type=:category, product_image=:targetFile WHERE product_id=:id");
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindParam(':description', $description, PDO::PARAM_STR);
$stmt->bindParam(':price', $price, PDO::PARAM_INT);
$stmt->bindParam(':category', $category, PDO::PARAM_STR);
$stmt->bindParam(':targetFile', $targetFile, PDO::PARAM_STR);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $stmt->errorInfo()[2];
}
?>
