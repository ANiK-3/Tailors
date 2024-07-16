function addNotification(message) {
    const notificationList = document.getElementById("notification-list");
    const newNotification = document.createElement("li");
    newNotification.textContent = message;
    notificationList.appendChild(newNotification);

    // incrementNotificationCounter
    const counter = document.getElementById("notification-counter");
    let count = parseInt(counter.textContent) || 0;
    counter.textContent = count + 1;
}

// functions available globally
window.addNotification = addNotification;
