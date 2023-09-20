<?php
$productNameErr = $DescriptionErr = $PriceErr = $ProductTypeErr = "";
$PName = $Description = $Price = $ProductType = "";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["productName"])) {
        $productNameErr = "Product name is required";
    } else {
        $PName = $_POST["productName"];
    }
    if (empty($_POST["Description"])) {
        $DescriptionErr = "Please Add Description";
    } else {
        $Description = $_POST["Description"];
    }
    if (empty($_POST["Price"])) {
        $PriceErr = "Please Add Price Of The Product";
    } else {
        $Price = $_POST["Price"];
    }
    if (empty($_POST["ProductType"])) {
        $ProductTypeErr = "Please Add Type Of The Product";
    } else {
        $ProductType = $_POST["ProductType"];
    }
    if (empty($productNameErr) && empty($DescriptionErr) && empty($PriceErr) && empty($ProductTypeErr)) {
        if (isset($_SESSION["ProductName"]) && isset($_SESSION["Description"]) && isset($_SESSION['price']) && isset($_SESSION['Producttype'])) {
            header("Location: http://localhost:8080/php/folder2/cart.php");
            exit();
        }
      else{
        $_SESSION["ProductName"]=$PName;
      $_SESSION["Description"] =$Description ;
      $_SESSION['price']=$Price;
      $_SESSION['Producttype'] =$ProductType;
      }
       
     }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Product Details</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="login-root">
      <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
        <div class="formbg-outer">
          <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
              <span class="padding-bottom--15">Product Details</span>
              <form id="product-form" action="index.php" method="POST">
                <div class="field padding-bottom--24">
                  <label for="productName">Product Name</label>
                  <input type="text" name="productName" value= '<?php echo "$PName" ?>'>
                  <span class="error_msg">
                <?php 
                    echo $productNameErr; ?>
                </span>
                </div>
                <div class="field padding-bottom--24">
                  <div class="grid--50-50">
                    <label for="Description">Description</label>
                  </div>
                  <input type="text" name="Description" value= '<?php echo "$Description" ?>'>
                  <span class="error_msg">
                  <?php 
                    echo $DescriptionErr; ?>
                </span>
                </div>
                <div class="field padding-bottom--24">
                  <div class="grid--50-50">
                    <label for="Price">Price</label>
                  </div>
                  <input type="Number" name="Price" value= '<?php echo "$Price" ?>'>
                  <span class="error_msg">
                  <?php 
                    echo $PriceErr; ?>
                </span>
                </div>
                <div class="field padding-bottom--24">
                  <div class="grid--50-50">
                    <label for="ProductType">Product Type</label>
                  </div>
                  <input type="text" name="ProductType" value= '<?php echo "$ProductType" ?>'>
                  <span class="error_msg">
                  <?php 
                    echo $ProductTypeErr; ?>
                </span>
                </div>
                <div class="field padding-bottom--24">
                  <input type="submit" name="submit" value="SUBMIT">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>