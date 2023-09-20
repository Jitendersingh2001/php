<?php
session_start();
if (isset($_SESSION["ProductName"]) && isset($_SESSION["Description"]) && isset($_SESSION['price']) && isset($_SESSION['Producttype']) && isset($_SESSION["ProductImage"])) {
    echo "Name of the product is: -" . $_SESSION["ProductName"] . "<br>";
    echo "Description of the product is: -" . $_SESSION["Description"] . "<br>";
    echo "Price of the product is: -" . $_SESSION["price"] . "<br>";
    echo "Type of the product is: -" . $_SESSION["Producttype"] . "<br>";
    echo "Product image is: -<br>";
    echo '<img src="' . $_SESSION["ProductImage"] . '" alt="Product Image" height="200px"><br>';
} else {
    echo "There is no product";
}
?>
