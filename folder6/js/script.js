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
      url: "php/fetchdata.php", // Change the URL to your getdata.php file
      dataType: "json",
      success: function (data) {
        console.log(data);
        $("tbody").empty();
        // Loop through the retrieved data and append it to the table
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
        // Handle error
        console.error(xhr);
      },
    });
  }
  loadData();
  $("#submit").click(function (e) {
    e.preventDefault(); // Prevent the form from submitting

    // Get form data
    var formData = new FormData($("#AddForm")[0]);

    // Include the othercategoryfield value in formData if the "Other" option is selected
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
        // Handle success
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
        // Handle error
        console.error(xhr);
      },
    });
  });
  $("tbody").on("click", ".dropdown .dropdown-item#edit", function () {
    $(".modal-title").text("Edit Product");
    $(".add-btn").val("Edit");
  });
});
