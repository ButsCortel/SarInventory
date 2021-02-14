require("./bootstrap");

require("alpinejs");

const ZXing = require("@zxing/browser");

// /products/restock
window.openScanner = async (e) => {
    e.preventDefault();
    $(".scanner").css({ display: "flex" });
    try {
        const codeReader = new ZXing.BrowserMultiFormatReader();
        const result = await codeReader.decodeOnceFromVideoDevice(
            undefined,
            "video"
        );
        $(".code").val(result);
        const video = document.getElementById("video");
        const tracks = video.srcObject.getTracks();
        tracks.forEach((track) => track.stop());
        $(".scanner").hide();
        $(".fetch-product").trigger("submit");
    } catch (error) {
        console.log(error);
    }
};
window.closeScanner = () => {
    const video = document.getElementById("video");
    const obj = video.srcObject;
    const tracks = obj.getTracks();
    tracks.forEach((track) => track.stop());
    $(".scanner").hide();
};

window.numbersOnlyInput = (e) => {
    e.target.value = e.target.value.replace(/[^0-9]*/g, "");
};
window.numbersOnlyKeydown = (e) => {
    if (e.key === ".") {
        e.preventDefault();
    }
};

//index page

window.handleCheckout = (e, stocks, id) => {
    // console.log(stocks, id);
    e.stopPropagation();
    const checkBg = $(".checkout-bg");
    checkBg.css({ display: "flex" }).find(".id").val(id);
    checkBg.find(".stock").text(stocks + " in stock");
    checkBg.find(".quantity").val(0).attr("max", stocks);
    checkBg
        .find(".confirm-button")
        .css({ "pointer-events": "none", opacity: "0.2" });
};

window.handleClose = (e) => {
    e ? e.preventDefault() : "";
    $(".checkout-bg").css({ display: "none" });
};

$(".checkout-control").on("submit", function (e) {
    $(this).find(".checkout-button-group ").css({
        opacity: "0.5",
        cursor: "inherit",
        "pointer-events": "none",
    });
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: "/checkout",
        method: "post",
        data: {
            id: $(this).find(".id").val(),
            quantity: $(this).find(".quantity").val(),
        },
        success: (data) => {
            handleClose();
            showToast(data.message, "success");
        },
        error: (error) => {
            console.log(error);
            showToast(error.responseJSON.message, "error");
        },
        complete: () => {
            $(this).find(".checkout-button-group ").css({
                opacity: "1",
                cursor: "inherit",
                "pointer-events": "",
            });
        },
    });
    return false;
});

$(".quantity").on("input", function (e) {
    e.target.value = e.target.value.replace(/[^0-9]*/g, "");
    $(this)
        .next()
        .children(".confirm-button")
        .css({ "pointer-events": "none", opacity: "0.2" });
    if ($(this).val() >= 1 && $(this).val() <= parseInt($(this).attr("max"))) {
        $(this)
            .next()
            .children(".confirm-button")
            .css({ cursor: "pointer", "pointer-events": "auto", opacity: "1" });
    }
});

// Add product page

$("form.add-product").on("submit", function () {
    setTimeout(function () {
        disableButton();
    }, 0);
    function disableButton() {
        $("#btnSubmit").prop("disabled", true);
    }
});

// restock page
$(".fetch-product").on("submit", function (e) {
    e.preventDefault();
    $(".search-button").css({
        opacity: "0.2",
        "pointer-events": "none",
    });
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: "/products/fetch",
        method: "post",
        data: {
            code: $("#code").val(),
        },
    }).done(function (res) {
        $("#code").css({ border: "" });
        if (res.product.length > 0) {
            const { id, name, price, stock, thumbnail } = res.product[0];
            $(".fetch-message").hide();
            $(".product-info").show();
            $(".product-name").text(name);
            $(".product-price").text(price + " PHP");
            $(".product-stock").text(stock + " in stock");
            thumbnail ? $(".product-img").attr("src", thumbnail) : "";
            $("#id").val(id);
            $(".stock-input")
                .prop("disabled", false)
                .css({ opacity: "1", "pointer-events": "auto" });
            $(".stock-button")
                .prop("disabled", false)
                .css({ opacity: "1", "pointer-events": "auto" });
        } else {
            $(".stock-input")
                .prop("disabled", true)
                .css({ opacity: "0.2", "pointer-events": "none" });
            $(".stock-button")
                .prop("disabled", true)
                .css({ opacity: "0.2", "pointer-events": "none" });
            $("#code").css({ border: "2px solid red" });
            $(".product-info").hide();
            $(".fetch-message").show();
            $("#id").val("");
            $(".product-name").text("");
            $(".product-price").text("");
            $(".product-stock").text("");
            $(".product-img").attr("src", "/images/no_image.png");

            $(".fetch-message")
                .text("Product does not exist!")
                .css({ color: "red" });
        }
        $(".search-button").css({
            opacity: "1",
            "pointer-events": "auto",
        });
    });

    return false;
});

$(".restock-form").on("submit", function (e) {
    $(".stock-button").css({
        opacity: "0.2",
        "pointer-events": "none",
    });
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: "/products/restock",
        method: "put",
        data: {
            id: $("#id").val(),
            stock: $("#stock").val(),
        },
    }).done(function (res) {
        if (res.message.length > 0) {
            $(".stock-input")
                .prop("disabled", true)
                .css({ opacity: "0.2", "pointer-events": "none" });
            $(".stock-button")
                .prop("disabled", true)
                .css({ opacity: "0.2", "pointer-events": "none" });
            $(".product-info").hide();
            $(".fetch-message").show();
            $("#id").val("");
            $("#code").val("");
            $("#stock").val(1);
            $(".product-name").text("");
            $(".product-price").text("");
            $(".product-stock").text("");
            $(".product-img").attr("src", "/images/no_image.png");
            $(".fetch-message").text("No product found.").css({ color: "red" });
            showToast(res.message, "success");
        } else {
            $(".stock-button").css({
                opacity: "1",
                "pointer-events": "",
            });
            showToast("Invalid input!", "error");
        }
    });

    return false;
});
//  modal
window.closeModal = () => {
    $(".confirm-modal").hide();
    $(".restock-modal").hide();
};
window.openModal = () => {
    $(".confirm-modal").css({ display: "flex" });
};
window.openRestockModal = () => {
    $(".restock-modal").css({ display: "flex" });
};
let isCamOpen = false;

window.toggleCamera = () => {
    let loading = false;
    if (isCamOpen) {
        isCamOpen = false;
        const video = document.getElementById("video");
        const tracks = video.srcObject.getTracks();
        tracks[0].stop();
        return;
    }
    try {
        isCamOpen = true;
        const codeReader = new ZXing.BrowserMultiFormatReader();

        codeReader.decodeFromVideoDevice(undefined, "video", (result) => {
            if (result != undefined && !loading) {
                $("#code").val(result.text);
                loading = true;
                setTimeout(() => (loading = false), 2000);
                $(".add-checkout").trigger("submit");
            }
        });
    } catch (error) {
        console.log(error);
    }
};
let add_checkout_loading = false;
$(".add-checkout").on("submit", function (e) {
    if (!add_checkout_loading) {
        add_checkout_loading = true;
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: "/checkout/add",
            method: "post",
            data: {
                code: $("#code").val(),
                quantity: $("#quantity").val(),
            },
            success: (data) => {
                const { checkoutsView, totalView } = data;
                $("#code").val("");
                $("#quantity").val(1);
                $(".checkouts-section").html(checkoutsView);
                $(".total-section").html(totalView);
                showToast("Added to checkout!", "success");
                add_checkout_loading = false;
            },
            error: (error) => {
                showToast(error.responseJSON.message, "error");
                add_checkout_loading = false;
            },
        });
    }
    // .done(function (data) {
    //     console.log(data.data);
    // });
    return false;
});
$("#apply").on("click", function (e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: "/sales/filter",
        method: "post",
        data: {
            from: $("#from").val(),
            to: $("#to").val(),
        },
        success: (data) => {
            const { saleBody } = data;

            $(".sale-body").html(saleBody);
        },
        error: (error) => {
            console.log(error);
            showToast("Invalid filter!", "error");
        },
    });

    // .done(function (data) {
    //     console.log(data.data);
    // });
    return false;
});
$("#clear").on("click", function (e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: "/sales/filter",
        method: "post",
        success: (data) => {
            const { saleBody } = data;
            $(".sale-body").html(saleBody);
        },
        error: (error) => {
            console.log(error);
            showToast("Invalid filter!", "error");
        },
    });

    // .done(function (data) {
    //     console.log(data.data);
    // });
    return false;
});

window.deleteCheckout = (id) => {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: "/checkout/" + id,
        method: "delete",
        success: (data) => {
            const { checkoutsView, totalView } = data;
            $(".checkouts-section").html(checkoutsView);
            $(".total-section").html(totalView);
            showToast("Removed from checkout!", "success");
        },
        error: (error) => {
            showToast(error.responseJSON.message, "error");
        },
    });
};
window.resetCheckout = (e) => {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: "/checkout",
        method: "delete",
        success: (data) => {
            const { checkoutsView, totalView } = data;
            $(".checkouts-section").html(checkoutsView);
            $(".total-section").html(totalView);
            showToast("Checkout has been reset!", "success");
        },
        error: (error) => {
            showToast(error.responseJSON.message, "error");
        },
    });
};
