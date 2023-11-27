window.onscroll = function() {scroll()};
var header = document.getElementById("header");
var sticky = header.offsetTop;

function scroll() {
  if (window.pageYOffset > sticky) {
    header.classList.add("headerBorder");
  } else {
    header.classList.remove("headerBorder");
  }
}
