/******/ (() => { // webpackBootstrap
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
numbersOnlyInput = function numbersOnlyInput(e) {
  e.target.value = e.target.value.replace(/[^0-9]*/g, "");
};

numbersOnlyKeydown = function numbersOnlyKeydown(e) {
  if (e.key === ".") {
    e.preventDefault();
  }
}; //index page


handleCheckout = function handleCheckout(e, stocks, id) {
  // console.log(stocks, id);
  e.stopPropagation();
  var checkBg = $(".checkout-bg");
  checkBg.css({
    display: "flex"
  }).find(".id").val(id);
  checkBg.find(".stock").text(stocks + " in stock");
  checkBg.find(".quantity").val(0).attr("max", stocks);
  checkBg.find(".confirm-button").css({
    "pointer-events": "none",
    opacity: "0.2"
  });
};

handleClose = function handleClose(e) {
  e ? e.preventDefault() : "";
  $(".checkout-bg").css({
    display: "none"
  });
};

$(".checkout-control").submit(function (e) {
  var _this = this;

  $(this).find(".checkout-button-group ").css({
    opacity: "0.5",
    cursor: "inherit",
    "pointer-events": "none"
  });
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
  });
  $.ajax({
    url: "/checkout",
    method: "post",
    data: {
      id: $(this).find(".id").val(),
      quantity: $(this).find(".quantity").val()
    },
    success: function success() {
      handleClose();
    },
    error: function error(_error) {
      console.log(_error);
    },
    complete: function complete() {
      $(_this).find(".checkout-button-group ").css({
        opacity: "1",
        cursor: "inherit",
        "pointer-events": ""
      });
    }
  });
  return false;
});
$(".quantity").on("input", function (e) {
  e.target.value = e.target.value.replace(/[^0-9]*/g, "");
  $(this).next().children(".confirm-button").css({
    "pointer-events": "none",
    opacity: "0.2"
  });

  if ($(this).val() >= 1 && $(this).val() <= parseInt($(this).attr("max"))) {
    $(this).next().children(".confirm-button").css({
      cursor: "pointer",
      "pointer-events": "auto",
      opacity: "1"
    });
  }
}); // Add product page

$("form.add-product").submit(function () {
  setTimeout(function () {
    disableButton();
  }, 0);

  function disableButton() {
    $("#btnSubmit").prop("disabled", true);
  }
}); // $("form.checkout-control").submit(function () {
//     setTimeout(function () {
//         disableButton();
//     }, 0);
//     function disableButton() {
//         $("#btnSubmit").prop("disabled", true);
//     }
// });
//  modal

closeModal = function closeModal() {
  $(".confirm-modal").hide();
  $(".restock-modal").hide();
};

openModal = function openModal() {
  $(".confirm-modal").css({
    display: "flex"
  });
};

openRestockModal = function openRestockModal() {
  $(".restock-modal").css({
    display: "flex"
  });
};

handleConfirm = function handleConfirm(e) {
  console.log(e);
  return true;
};
/******/ })()
;