const toastr = require("toastr");
toastr.options.timeOut = 2000;
toastr.options.positionClass = "toast-bottom-center";
window.showToast = (message, type) => {
    toastr[type](message);
};

if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
let checkouts = "";
let checkout_ids = "";
window.storeJSON = (data) => {
    checkouts = data;
    checkout_ids = data.map((checkout) => checkout.id);
};
let submitted_checkout = false;
window.submitCheckout = (e) => {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: "/sale",
        method: "post",
        data: {
            checkouts: checkouts,
            checkout_ids: checkout_ids,
            total: $("#total").val(),
            payment: $("#payment").val(),
        },
        success: (data) => {
            $("#payment").css({
                "border-color": "",
                "border-width": "",
            });
            $("#change").val(data.change);
            showToast(
                `Total: &#8369;${data.total}, Change: &#8369;${data.change}`,
                "info"
            );
            submitted_checkout = true;
            $("#done-btn").css({ "pointer-events": "auto", opacity: "1" });
        },
        error: (error) => {
            $("#payment").css({
                "border-color": "red",
                "border-width": "2px",
            });
            showToast(error.responseJSON.message, "error");
        },
    });
};
window.doneCheckout = (e) => {
    e.preventDefault();
    if (submitted_checkout) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: "/sale/done",
            method: "post",
            data: {
                checkouts: checkouts,
                checkout_ids: checkout_ids,
                total: $("#total").val(),
                payment: $("#payment").val(),
                change: $("#change").val(),
            },
            success: (data) => {
                $("#payment").css({
                    "border-color": "",
                    "border-width": "",
                });
                const { checkoutsView, totalView } = data;
                $("#code").val("");
                $("#quantity").val(1);
                $(".checkouts-section").html(checkoutsView);
                $(".total-section").html(totalView);
                showToast("Transaction finished!", "success");
                $("#done-btn").css({
                    "pointer-events": "none",
                    opacity: "0.5",
                });
                submitted_checkout = false;
            },
            error: (error) => {
                console.log(error);
                showToast("Invalid Input!", "error");
            },
        });
    }
};
