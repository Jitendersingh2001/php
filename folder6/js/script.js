$(document).ready(function () {
  let row, rowId, totalPages;
  let currentPage = 1;

  /* Other field code  */
  $("#ProductCategory").change(function () {
    if ($(this).val() === "Other") {
      $("#othercategoryfield").removeClass("hide");
    } else {
      $("#othercategoryfield").addClass("hide");
    }
  });
  // function to populate options of select field
  function selectcategory() {
    $.ajax({
      type: "GET",
      url: "php/category.php",
      dataType: "json",
      success: function (data) {
        let selectElement = $("#ProductCategory");
        selectElement.empty();

        if (data.product_types && data.product_types.length > 0) {
          $.each(data.product_types, function (index, productType) {
            selectElement.append(
              $("<option>", {
                value: productType,
                text: productType,
              })
            );
          });
        } else {
          selectElement.append(
            $("<option>", {
              value: "Other",
              text: "Other",
              id: "othercategory",
            })
          );
        }
        selectElement.append(
          $("<option>", {
            value: "Other",
            text: "Other",
            id: "othercategory",
          })
        );
        selectElement.val("");
      },
      error: function (xhr, status, error) {
        console.error(xhr);
      },
    });
  }

  selectcategory(); // call of select category function
  // load data function to load table
  function loadData() {
    $.ajax({
      type: "GET",
      url: "php/fetchdata.php",
      dataType: "json",
      success: function (data) {
        if (data.total_count > 10) {
          $(".pages").removeClass("hide");
        } else {
          $(".pages").addClass("hide");
        }
        totalPages = Math.ceil(data.total_count / 10); // Assuming 10 records per page

        if (totalPages > 1) {
          // Generate the page links dynamically
          let pagination = $(".pagination");
          pagination.empty(); // Clear previous links

          // Previous button
          pagination.append(
            '<li class="page-item prev-btn"><a class="page-link" href="#">Previous</a></li>'
          );
          // Page links
          for (let i = 1; i <= totalPages; i++) {
            pagination.append(
              '<li class="page-item"><a class="page-link" href="#">' +
                i +
                "</a></li>"
            );
          }
          prevbtndisable();
          nextbtndisable();
          // Next button
          pagination.append(
            '<li class="page-item next-btn"><a class="page-link" href="#">Next</a></li>'
          );
        }

        table(data);
        selectcategory();
      },
      error: function (error) {
        console.error(error);
      },
    });
  }
  function prevbtndisable() {
    if (currentPage == 1) {
      $(".prev-btn").addClass("disabled");
      $(".prev-btn .page-link").attr("aria-disabled", true);
    } else {
      $(".prev-btn").removeClass("disabled");
      $(".prev-btn .page-link").attr("aria-disabled", false);
    }
  }
  function nextbtndisable() {
    if (currentPage == totalPages) {
      $(".next-btn").addClass("disabled");
      $(".next-btn .page-link").attr("aria-disabled", true);
    } else {
      $(".next-btn").removeClass("disabled");
      $(".next-btn .page-link").attr("aria-disabled", false);
    }
  }
  function table(data) {
    $("tbody").empty();
    $.each(data.data, function (index, item) {
      let row = $("<tr>").appendTo("tbody");
      row.attr("data-id", item.product_id);
      $("<td>").text(item.product_name).appendTo(row);
      $("<td>").text(item.product_description).appendTo(row);
      $("<td>").text(item.product_price).appendTo(row);
      $("<td>").text(item.product_type).appendTo(row);
      $("<td>")
        .html('<img src="' + item.product_image + '" alt="image">')
        .appendTo(row);
      $("<td>")
        .html(
          '<div class="dropdown">' +
            '<button id="dropdownMenuButton" data-bs-toggle="dropdown" type="button">' +
            '<img src="../folder6/image/3dotmenu.png" alt="3dotmenu">' +
            "</button>" +
            '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">' +
            '<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ProductModal" id="edit">Edit</a>' +
            '<a class="dropdown-item" href="#" id="delete">Delete</a>' +
            "</div>" +
            "</div>"
        )
        .appendTo(row);
    });
  }

  loadData(); // call of load data function

  $(document).on("click", ".next-btn", function () {
    currentPage += 1;
    nextbtndisable();
    prevbtndisable();
    $.ajax({
      type: "GET",
      url: "php/fetchdata.php",
      data: { page: currentPage },
      dataType: "json",
      success: function (data) {
        table(data);
      },
      error: function (error) {
        console.error(error);
      },
    });
  });
  $(document).on("click", ".prev-btn", function () {
    currentPage -= 1;
    prevbtndisable();
    nextbtndisable();
    $.ajax({
      type: "GET",
      url: "php/fetchdata.php",
      data: { page: currentPage },
      dataType: "json",
      success: function (data) {
        table(data);
      },
      error: function (error) {
        console.error(error);
      },
    });
  });

  //submit / add btn implementation
  $(".modal-footer").on("click", "#submit", function (e) {
    e.preventDefault();
    let productName = $("#ProductName").val();
    let productDescription = $("#ProductDescription").val();
    let productPrice = $("#ProductPrize").val();
    let productCategory = $("#ProductCategory").val();
    let productImage = $("#ProductImage").val();

    if (
      productName === "" ||
      productDescription === "" ||
      productPrice === "" ||
      productCategory === "" ||
      productImage === ""
    ) {
      $.toast({
        heading: "Error",
        text: "All fields are mandatory to fill",
        showHideTransition: "slide",
        icon: "error",
      });
    } else if (parseFloat(productPrice) === 0) {
      $.toast({
        heading: "Error",
        text: "The price Value should not be 0",
        showHideTransition: "slide",
        icon: "error",
      });
    } else {
      let formData = new FormData($("#AddForm")[0]);

      if (productCategory === "Other") {
        let otherCategoryValue = $("#othercategoryfield").val();
        formData.append("OtherCategory", otherCategoryValue);
      }
      $.ajax({
        type: "POST",
        url: "php/postdata.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
          $("#ProductModal").modal("hide");
          $("#ProductName").val("");
          $("#ProductDescription").val("");
          $("#ProductPrize").val("");
          $("#ProductCategory").val("");
          $("#ProductImage").val("");
          $("#othercategoryfield").val("");
          loadData();
          $.toast({
            heading: "Success",
            text: "Product Added Successfully",
            showHideTransition: "slide",
            icon: "success",
          });
        },
        error: function (error) {
          console.error(error);
        },
      });
    }
  });

  //edit btn implemention
  $("tbody").on("click", ".dropdown .dropdown-item#edit", function () {
    $(".modal-title").text("Edit Product");
    $(".add-btn").val("Update");
    $(".add-btn").attr("id", "update-btn");
    row = $(this).closest("tr");
    rowId = row.data("id");
    if ($("#CurrentProductImage").length === 0) {
      let newElements = `
      <div id="imageContainer">
          <label for="ProductImage" class="form-label">Current Product Image</label><br>
          <img src="" id="CurrentProductImage" alt="Product Image" style="max-width: 100px; max-height: 100px;" />
          <br>
      </div>
  `;
      $(".image").before(newElements);
    }
    $.ajax({
      url: "php/action.php",
      type: "POST",
      data: { id: rowId, action: "edit" },
      dataType: "json",
      success: function (data) {
        $("#ProductName").val(data.product_name);
        $("#ProductDescription").val(data.product_description);
        $("#ProductPrize").val(data.product_price);
        $("#ProductCategory").val(data.product_type);
        $("#CurrentProductImage").attr("src", data.product_image);

        $("#NewProductImage").on("change", function () {
          let newImage = URL.createObjectURL(this.files[0]);
          $("#CurrentProductImage").attr("src", newImage);
        });
      },
      error: function (error) {
        console.error(error);
      },
    });
  });
  //delete function implementation
  $("tbody").on("click", ".dropdown .dropdown-item#delete", function () {
    row = $(this).closest("tr");
    rowId = row.data("id");
    $.ajax({
      url: "php/action.php",
      type: "POST",
      data: { id: rowId, action: "delete" },
      success: function () {
        $.toast({
          text: "Product Deleted Successfully",
          showHideTransition: "slide",
          icon: "success",
        });
        loadData();
      },
      error: function (error) {
        console.error(error);
      },
    });
  });

  //update btn implementation
  $(".modal-footer").on("click", "#update-btn", function (e) {
    e.preventDefault();
    let currentImageSrc = $("#CurrentProductImage").attr("src");
    let formData = new FormData($("#AddForm")[0]);

    if ($("#ProductCategory").val() === "Other") {
      let otherCategoryValue = $("#othercategoryfield").val();
      formData.append("OtherCategory", otherCategoryValue);
    }
    formData.append("rowId", rowId);
    formData.append("currentImageSrc", currentImageSrc);
    $.ajax({
      url: "php/update.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function () {
        $("#ProductModal").modal("hide");
        $.toast({
          text: "Update Successfully",
          showHideTransition: "slide",
          icon: "success",
        });
        loadData();
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  });

  //IMPLEMENETING SEARCH
  function filterTableRows() {
    let search = $(this).val();

    $.ajax({
      type: "POST",
      url: "php/search.php",
      data: { search: search },
      dataType: "json",
      success: function (data) {
        if (data && data.length > 0) {
          //data?.length > 0
          $("tbody").empty();
          $.each(data, function (index, item) {
            let row = $("<tr>").appendTo("tbody");
            row.attr("data-id", item.product_id);
            $("<td>").text(item.product_name).appendTo(row);
            $("<td>").text(item.product_description).appendTo(row);
            $("<td>").text(item.product_price).appendTo(row);
            $("<td>").text(item.product_type).appendTo(row);
            $("<td>")
              .html('<img src="' + item.product_image + '" alt="image">')
              .appendTo(row);
            $("<td>")
              .html(
                '<div class="dropdown">' +
                  '<button id="dropdownMenuButton" data-bs-toggle="dropdown" type="button">' +
                  '<img src="../folder6/image/3dotmenu.png" alt="3dotmenu">' +
                  "</button>" +
                  '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">' +
                  '<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ProductModal" id="edit">Edit</a>' +
                  '<a class="dropdown-item" href="#" id="delete">Delete</a>' +
                  "</div>" +
                  "</div>"
              )
              .appendTo(row);
          });
        } else {
          $("tbody")
            .empty()
            .append(
              '<tr><td colspan="6" style="color:red; text-align:center; font-size:30px;">No Results Found!</td></tr>'
            );
        }
      },
      error: function (error) {
        console.error("Ajax error:", error);
      },
    });
  }

  $("#searchInput").on("input", filterTableRows);
  //to reset everything
  $("#ProductModal").on("hidden.bs.modal", function () {
    $(".modal-title").text("Add Product");
    $(".add-btn").val("Add");
    $("#AddForm")[0].reset();
    $("#ProductCategory").val("");
    $("#othercategoryfield").addClass("hide");
    $("#imageContainer").remove();
  });
});
