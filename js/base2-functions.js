function adjust_body_offset() {
    document.getElementsByTagName("body")[0].style.paddingTop = document.getElementById("top-nav").offsetHeight + "px";
    document.getElementsByTagName("body")[0].style.paddingBottom = document.getElementById("bottom-nav").offsetHeight + "px";
}
window.addEventListener("resize", event => adjust_body_offset());
window.addEventListener("load", event => adjust_body_offset());