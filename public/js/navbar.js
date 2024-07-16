/******/ (() => { // webpackBootstrap
/*!********************************!*\
  !*** ./resources/js/navbar.js ***!
  \********************************/
function addNotification() {
  var message = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : "no new messages.";
  var notificationList = document.getElementById("notification-list");
  var newNotification = document.createElement("li");
  newNotification.textContent = message;
  notificationList.appendChild(newNotification);

  // incrementNotificationCounter
  var counter = document.getElementById("notification-counter");
  var count = parseInt(counter.textContent) || 0;
  counter.textContent = count + 1;
}

// functions available globally
window.addNotification = addNotification;
/******/ })()
;