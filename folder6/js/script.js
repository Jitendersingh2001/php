$(document).ready(function () {
  var row, rowId;
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
        if (data.product_types && data.product_types.length > 0) {
          var selectElement = $("#ProductCategory");
          selectElement.empty();
          $.each(data.product_types, function (index, productType) {
            selectElement.append(
              $("<option>", {
                value: productType,
                text: productType,
              })
            );
          });
          selectElement.append(
            $("<option>", {
              value: "Other",
              text: "Other",
              id: "othercategory",
            })
          );
          selectElement.val("");
        }
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
        $("tbody").empty();
        $.each(data, function (index, item) {
          var row = $("<tr>").appendTo("tbody");
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
        selectcategory();
      },
      error: function (xhr, status, error) {
        console.error(xhr);
      },
    });
  }
  loadData(); // call of load data function
  //submit / add btn implementation
  $(".modal-footer").on("click", "#submit", function (e) {
    e.preventDefault();

    var formData = new FormData($("#AddForm")[0]);

    if ($("#ProductCategory").val() === "Other") {
      var otherCategoryValue = $("#othercategoryfield").val();
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
      error: function (xhr, status, error) {
        console.error(xhr);
      },
    });
  });
  //edit btn implemention
  $("tbody").on("click", ".dropdown .dropdown-item#edit", function () {
    $(".modal-title").text("Edit Product");
    $(".add-btn").val("Update");
    $(".add-btn").attr("id", "update-btn");
    row = $(this).closest("tr");
    rowId = row.data("id");
    if ($("#CurrentProductImage").length === 0) {
      var newElements = `
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
          var newImage = URL.createObjectURL(this.files[0]);
          $("#CurrentProductImage").attr("src", newImage);
        });
      },
      error: function (xhr, status, error) {
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
        loadData();
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  });

  //IMPLEMENETING SEARCH
  function filterTableRows() {
    var searchValue = $("#searchInput").val().toLowerCase();

    $("tbody tr").each(function () {
      var productName = $(this).find("td:eq(0)").text().toLowerCase();

      var productDescription = $(this).find("td:eq(1)").text().toLowerCase();
      if (
        productName.indexOf(searchValue) !== -1 ||
        productDescription.indexOf(searchValue) !== -1
      ) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  }
  //update btn implementation
  $(".modal-footer").on("click", "#update-btn", function (e) {
    e.preventDefault();
    var currentImageSrc = $("#CurrentProductImage").attr("src");
    var formData = new FormData($("#AddForm")[0]);

    if ($("#ProductCategory").val() === "Other") {
      var otherCategoryValue = $("#othercategoryfield").val();
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
          heading: "Updation",
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
