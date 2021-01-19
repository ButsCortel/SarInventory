numbersOnlyInput = (e) => {
    e.target.value = e.target.value.replace(/[^0-9]*/g, "");
};
numbersOnlyKeydown = (e) => {
    if (e.key === ".") {
        e.preventDefault();
    }
};

//Index page

$(".checkout-control").each(function () {
    if ($(this).find(".quantity").attr("max") < 1) {
        $(this).css({ opacity: "0.2" }).find("*").css({ visibility: "hidden" });
    }
    $(this)
        .find(".checkout-button")
        .css({ opacity: "0.2", cursor: "inherit", "pointer-events": "none" });
});

$(".quantity").on("input", disableButton);

function disableButton(e) {
    e.target.value = e.target.value.replace(/[^0-9]*/g, "");
    $(this).next().css({ "pointer-events": "none", opacity: "0.2" });
    if ($(this).val() >= 1 && $(this).val() <= parseInt($(this).attr("max"))) {
        $(this)
            .next()
            .css({ cursor: "pointer", "pointer-events": "auto", opacity: "1" });
    }
}

// Add product page

$("form.add-product").submit(function () {
    setTimeout(function () {
        disableButton();
    }, 0);
    function disableButton() {
        $("#btnSubmit").prop("disabled", true);
    }
});
// $("form.checkout-control").submit(function () {
//     setTimeout(function () {
//         disableButton();
//     }, 0);
//     function disableButton() {
//         $("#btnSubmit").prop("disabled", true);
//     }
// });
