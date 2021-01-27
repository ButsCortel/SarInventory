const toastr = require("toastr");
toastr.options.timeOut = 2000;
toastr.options.positionClass = "toast-bottom-center";
window.showToast = (message, type) => {
    toastr[type](message);
};

if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
