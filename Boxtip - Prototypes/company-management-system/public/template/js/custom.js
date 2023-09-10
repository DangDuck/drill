$(function () {
  $("#invoiceFile").on("change", function () {
    console.log("changed");
    const invoice = document.querySelector("#invoiceFile");
    $("#labelFileInvoice").text(invoice.files[0].name);
  });
});

// Jquery - AJAX
// INVOICE
// -------------------------------------------------------------
$(function () {
  $(".btn-add").on("click", function () {
    $("#staticBackdropLabel").html("UPLOAD INVOICE");
    $(".btn-submit").html("Upload");
    $(".modal-body form").attr(
      "action",
      "http://localhost:8080/master/uploadinvoice"
    );
    $("#nomorInvoice").removeAttr("value");
    $("#nomorInvoiceLama").removeAttr("value");
    $("#customerCode").prop("selectedIndex", 0);
    $("#paymentStatus").prop("selectedIndex", 0);
    $("#labelFileInvoice").text("Upload File");
  });
  $(".btn-edit").on("click", function () {
    $("#staticBackdropLabel").html("UPDATE INVOICE");
    $(".btn-submit").html("Update");
    $(".modal-body form").attr("action", "http://localhost:8080/master/edit");

    const id = $(this).data("id");
    $.ajax({
      url: "http://localhost:8080/master/update",
      data: { id: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        console.log(data);
        $("#customerCode").val(data.id_customer + "-" + data.customer_code);
        $("#paymentStatus").val(data.id_payment_status);
        $("#nomorInvoice").val(data.nomor_invoice);
        $("#nomorInvoiceLama").val(data.nomor_invoice);
        $("#labelFileInvoice").text(data.file_path);
      },
    });
  });
});

// RESI
// -----------------------------------------------------------------
$(function () {
  $(".btn-resi-add").on("click", function () {
    $("#staticBackdropLabel").html("ADD RESI");
    $(".btn-resi-submit").html("Add");
    $(".modal-body form").attr(
      "action",
      "http://localhost:8080/master/addresi"
    );
    // reset input
    $("#nomor_resi").val("");
    if (document.querySelector(".form-nomor-resi-boxtip")) {
      $(".form-nomor-resi-boxtip").remove();
    }
    $("#nomor_invoice").prop("selectedIndex", 0);
    $("#status").prop("selectedIndex", 0);
  });
  $(".btn-resi-edit").on("click", function () {
    $("#staticBackdropLabel").html("UPDATE RESI");
    $(".btn-resi-submit").html("Update");
    $(".modal-body form").attr(
      "action",
      "http://localhost:8080/master/editresi"
    );
    //ajax input
    const id = $(this).data("id");
    const form_gen = `
    <div class='form-group form-nomor-resi-boxtip'>
      <label for='nomor_resi_boxtip'>Nomor Resi Boxtip</label>
      <input class='form-control' type='text' disabled id='nomor_resi_boxtip' name='nomor_resi_boxtip'>
    </div>`;
    $.ajax({
      url: "http://localhost:8080/master/updateresi",
      data: { id: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#input_nomor_resi").val(data.nomor_resi);
        $("#nomor_resi").val(data.nomor_resi);
        $("#nomor_resi").attr("disabled", true);
        if (document.querySelector("#nomor_resi_boxtip")) {
          $("#nomor_resi_boxtip").val(data.nomor_resi_boxtip);
        } else {
          $(form_gen).insertBefore(".form-nomor-invoice");
          $("#nomor_resi_boxtip").val(data.nomor_resi_boxtip);
        }
        $("#nomor_invoice").val(data.nomor_invoice);
        $("#status").val(data.id_status);
      },
    });
  });
});

// CUSTOMER
// -------------------------------------------------------------
$(function () {
  $(".btn-customer-add").on("click", function () {
    $("#staticBackdropLabel").html("ADD CUSTOMER");
    $(".btn-customer-submit").html("Add");
    $(".modal-body form").attr(
      "action",
      "http://localhost:8080/master/addcustomer"
    );
    $("#id_customer").removeAttr("value");
    $("#customerName").val("");
    $("#nomor_telpon").val("");
    $("#alamat").val("");
    $("#instagram").val("");
  });
  $(".btn-customer-edit").on("click", function () {
    $("#staticBackdropLabel").html("UPDATE CUSTOMER");
    $(".btn-customer-submit").html("Update");
    $(".modal-body form").attr(
      "action",
      "http://localhost:8080/master/editcustomer"
    );

    const id = $(this).data("id");
    console.log(id);
    $.ajax({
      url: "http://localhost:8080/master/updatecustomer",
      data: { id: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        console.log(data);
        $("#customerName").val(data.nama);
        $("#nomor_telpon").val(data.nomor_telpon);
        $("#alamat").val(data.alamat);
        $("#instagram").val(data.instagram);
        $("#id_customer").val(data.id);
      },
    });
  });
});
