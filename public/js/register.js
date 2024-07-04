/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/register.js ***!
  \**********************************/
var selectRole = document.getElementById("role");
var tailorFields = document.getElementById("tailor-fields");
var customerFields = document.getElementById("customer-fields");

// Initially hide all role-specific fields
tailorFields.style.display = "none";
customerFields.style.display = "none";
selectRole.addEventListener("change", function (event) {
  var role = event.target.value;

  // Hide all role-specific fields before showing the relevant one
  tailorFields.style.display = "none";
  customerFields.style.display = "none";

  // Show fields based on selected role
  if (role === "2") {
    customerFields.style.display = "block";
  } else if (role === "3") {
    tailorFields.style.display = "block";
  }
});
/******/ })()
;