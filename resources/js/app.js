require("./bootstrap");

require("alpinejs");

const ZXing = require("@zxing/browser");

window.openScanner = async (e) => {
    e.preventDefault();
    $(".scanner").css({ display: "flex" });
    const codeReader = new ZXing.BrowserMultiFormatReader();
    const result = await codeReader.decodeOnceFromVideoDevice(
        undefined,
        "video"
    );
    $(".code").val(result);
    $(".scanner").hide();
    const video = document.getElementById("video");
    const tracks = video.srcObject.getTracks();
    tracks[0].stop();
};
window.closeScanner = () => {
    $(".scanner").hide();
    const video = document.getElementById("video");
    const tracks = video.srcObject.getTracks();
    tracks[0].stop();
};
