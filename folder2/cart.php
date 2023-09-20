<?php
session_start();
if (isset($_SESSION["ProductName"]) && isset($_SESSION["Description"]) && isset($_SESSION['price']) && isset($_SESSION['Producttype'])){
    echo "Name of the product is: -". $_SESSION["ProductName"] ."<br>";
    echo "Description of the product is: -". $_SESSION["Description"] ."<br>";
    echo "price of the product is: -". $_SESSION["price"] ."<br>";
    echo "Type of the product is: -". $_SESSION["Producttype"] ."<br>";
}  


else{
    echo "There is no product";}

?>