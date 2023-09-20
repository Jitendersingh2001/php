$(document).ready(function () {
  $("#ProductCategory").val("");
  /* Other field code  */
  $("#ProductCategory").change(function () {
    if ($(this).val() === "Other") {
      $("#othercategoryfield").removeClass("hide");
    } else {
      $("#othercategoryfield").addClass("hide");
    }
  });

  function loadData() {
    $.ajax({
      type: "GET",
      url: "php/fetchdata.php",
      dataType: "json",
      success: function (data) {
        console.log(data);
        $("tbody").empty();
        $.each(data, function (index, item) {
          var row = $("<tr>").appendTo("tbody");
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
      },
      error: function (xhr, status, error) {
        console.error(xhr);
      },
    });
  }
  loadData();
  $("#submit").click(function (e) {
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
  $("tbody").on("click", ".dropdown .dropdown-item#edit", function () {
    $(".modal-title").text("Edit Product");
    $(".add-btn").val("Edit");
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
  $("#searchInput").on("input", filterTableRows);
});
