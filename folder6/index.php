<?php
include("database.php");
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
                <input type="search" name="search" id="search">
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
                <tbody>
                <tr>
                    <td>
                        PRODUCT NAME
                    </td>
                    <td>
                        DESCRIPTION
                    </td>
                    <td>
                        PRICE
                    </td>
                    <td>
                        CATEGORY
                    </td>
                    <td>
                    <img src="../folder6/image/lpu.jpg" alt="image">
                    </td>
                    <td>
                    <div class="dropdown">
                        <button id="dropdownMenuButton" data-bs-toggle="dropdown" type="button"  >
                            <img src="../folder6/image/3dotmenu.png" alt="3dotmenu">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ProductModal">Edit</a>
                            <a class="dropdown-item" href="#">Delete</a>
                        </div>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        PRODUCT NAME
                    </td>
                    <td>
                        DESCRIPTION
                    </td>
                    <td>
                        PRICE
                    </td>
                    <td>
                        CATEGORY
                    </td>
                    <td>
                    <img src="../folder6/image/lpu.jpg" alt="image">
                    </td>
                    <td>
                    <div class="dropdown">
                        <button id="dropdownMenuButton" data-bs-toggle="dropdown" type="button"  >
                            <img src="../folder6/image/3dotmenu.png" alt="3dotmenu">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Delete</a>
                        </div>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        PRODUCT NAME
                    </td>
                    <td>
                        DESCRIPTION
                    </td>
                    <td>
                        PRICE
                    </td>
                    <td>
                        CATEGORY
                    </td>
                    <td>
                    <img src="../folder6/image/lpu.jpg" alt="image">
                    </td>
                    <td>
                    <div class="dropdown">
                        <button id="dropdownMenuButton" data-bs-toggle="dropdown" type="button"  >
                            <img src="../folder6/image/3dotmenu.png" alt="3dotmenu">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Delete</a>
                        </div>
                    </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- add product modal -->
    <div class="modal fade" id="ProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD PRODUCT</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="updateForm">
              <div class="mb-3">
                <label for="ProductName" class="form-label">Product Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="ProductName"
                  aria-describedby="ProductName"
                />
              </div>
              <div class="mb-3">
                <label for="ProductDescription" class="form-label">Product Description</label>
                <textarea
                  class="form-control"
                  id="ProductDescription"
                  aria-describedby="ProductDescription"
                ></textarea>
              </div>
              <div class="mb-3">
                <label for="ProductPrize" class="form-label">Product Prize</label>
                <input
                  type="text"
                  class="form-control"
                  id="ProductPrize"
                  aria-describedby="ProductPrize"
                />
              </div>
              <div class="mb-3">
                <label for="ProductCategory" class="form-label">Category</label><br>
                <select name="ProductCategory" id="ProductCategory">
                <option value="Men">Men</option>
                <option value="Woman">Woman</option>
                <option value="Shoes">Shoes</option>
                <option value="Kitchen">Kitchen</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="ProductImage" class="form-label">Product Image</label>
                <input
                  type="file"
                  class="form-control"
                  id="ProductImage"
                  aria-describedby="ProductImage"
                />
              </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCEL</button>
        <button type="button" class="btn btn-success">ADD</button>
      </div>
    </div>
  </div>
</div>
    <!-- JQUERY CDN LINK -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <!-- JAVASCRIPT/JQUERY LINK -->
        <script src="../js/script.js"></script>
</body>
</html>