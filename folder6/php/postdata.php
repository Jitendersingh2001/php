<?php
include("database.php");
$name = $_POST["ProductName"];
$description = $_POST["ProductDescription"];
$price = $_POST["ProductPrize"];
$category = $_POST["ProductCategory"];
$otherCategory = $_POST["othercategoryfield"];
$targetDir = "../upload/";
$targetFile = $targetDir . basename($_FILES["ProductImage"]["name"]);
if (move_uploaded_file($_FILES["ProductImage"]["tmp_name"], $targetFile)) {
    echo "Image uploaded successfully.";
    echo "Image location: " . $targetFile;
} else {
    echo "Image upload failed.";
}
$targetFile = "../folder6/upload/" . basename($_FILES["ProductImage"]["name"]);
if ($category === "Other") {
    $category = $otherCategory;
}
$sql = "INSERT INTO products (product_name, product_description, product_price, product_type,product_image) VALUES ('$name', '$description', '$price', '$category','$targetFile')";
if ($conn->query($sql) == TRUE) {
    echo "<script>alert('New record added successfully');</script>";
} else {
    echo "<script>alert('Something went wrong');</script>";
}
?>
