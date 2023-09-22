<?php
include("php/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
     <!-- CSS LINK -->
      <link rel="stylesheet" type="text/css" href="css/style.css">
     <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!-- Bootstrap JavaScript and Popper.js (order matters) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../folder6/jqueryToast/toast.css" />

        <!-- Box icon link -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <div class="container-fluid navbar">
        <!-- NAVBAR STARTS HERE-->
        <div class="inner_navbar d-flex w-100">
            <div class="inner-left-navbar text-white">
                PRODUCT CART
            </div>
            <div class="inner-center-navbar w-50 d-flex position-relative">
                <input type="search" name="search" id="searchInput">
                <i class='bx bx-search-alt-2 position-absolute serach-icon'></i>
            </div>
            <div class="inner-right-navbar">
                <button data-bs-toggle="modal" data-bs-target="#ProductModal">Add</button>
            </div>
        </div>
    </div>
    <div class="container-fluid table">
        <!-- TABLE STARTS HERE  -->
        <div class="inner-table">
            <table>
               <thead>
               <tr>
                    <th>
                        PRODUCT NAME
                    </th>
                    <th>
                        DESCRIPTION
                    </th>
                    <th>
                        PRICE
                    </th>
                    <th>
                        CATEGORY
                    </th>
                    <th>
                        IMAGE
                    </th>
                    <th>
                        ACTION
                    </th>
                </tr>
               </thead>
                <tbody>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-end">
    <li class="page-item prev-btn"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item next-btn"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>
        </div>
    </div>

    <!-- add product modal -->
    <div class="modal fade" id="ProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title" id="exampleModalLabel">ADD PRODUCT</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="AddForm" >
              <div class="mb-3">
                <label for="ProductName" class="form-label" >Product Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="ProductName"
                  name="ProductName"
                  aria-describedby="ProductName"
                />
              </div>
              <div class="mb-3">
                <label for="ProductDescription" class="form-label">Product Description</label>
                <textarea
                  class="form-control"
                  name="ProductDescription"
                  id="ProductDescription"
                  aria-describedby="ProductDescription"
                ></textarea>
              </div>
              <div class="mb-3">
                <label for="ProductPrize" class="form-label">Product Price</label>
                <input
                  type="number"
                  name="ProductPrize"
                  class="form-control"
                  id="ProductPrize"
                  aria-describedby="ProductPrize"
                  oninput="javascript: if (this.value.length > 15) this.value = this.value.slice(0, 15);"
                />
              </div>
              <div class="mb-3">
                <label for="ProductCategory" class="form-label">Category</label><br>
                <select name="ProductCategory" id="ProductCategory">
                </select><br>
                <input
                  type="text"
                  class="form-control hide"
                  id="othercategoryfield"
                  aria-describedby="othercategoryfield"
                  name="othercategoryfield"
                />
              </div>
              <div class="mb-3 image">
    <div class="new_image">
    <label for="ProductImage" class="form-label">New Product Image</label>
    <input
        type="file"
        name="ProductImage"
        class="form-control"
        id="ProductImage"
        aria-describedby="ProductImage"
    />
    </div>
</div>

            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger cancel-btn" data-bs-dismiss="modal">CANCEL</button>
        <input type="submit" id="submit" name="submit" value="ADD" class="btn btn-success add-btn">
       
      </div>
    </div>
  </div>
</div>

    <!-- JQUERY CDN LINK -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="../folder6/jqueryToast/toast.js"></script>
        <!-- JAVASCRIPT/JQUERY LINK -->
        <script src="../folder6/js/script.js"></script>
</body>
</html>