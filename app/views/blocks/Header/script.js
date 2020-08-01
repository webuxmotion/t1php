window.onscroll = function() {myFunction()};
window.onload = function() {myFunction()};
// Get the header
var header = document.getElementById("header");

// Get the offset position of the navbar
//var sticky = header.offsetTop;
var sticky = 100;

// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("is-sticky");
  } else {
    header.classList.remove("is-sticky");
  }
}
