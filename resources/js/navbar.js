// Function to add a notification to the list
function addNotification(notification) {
    const { id, request_id, message, is_read } = notification;
    const notificationList = document.getElementById("notification-list");
    const counter = document.getElementById("notification-counter");
    let count = parseInt(counter.textContent) || 0;

    // function createNotificationElement() {
    //     if (!is_read) {
    //         return `
    //         <li id="notification-item">
    //             <a href="/manage-request/${request_id}">${message}</a>
    //             <button class="mark-read-button">Mark as Read</button>
    //         </li>
    //     `;
    //     } else {
    //         return `
    //     <li id="notification-item">
    //         <a href="/manage-request/${request_id}">${message}</a>
    //     </li>
    //     `;
    //     }
    // }

    // notificationList.innerHTML += createNotificationElement();
    // let newNotification = document.querySelector("#notification-item");

    // document
    //     .querySelector(".mark-read-button")
    //     .addEventListener("click", function () {
    //         markAsRead(id, newNotification);
    //     });

    // const newNotification = document.getElementById("notification-item");

    // const counter = document.getElementById("notification-counter");
    // let count = parseInt(counter.textContent);

    // Create a new notification item
    const newNotification = document.createElement("li");
    newNotification.innerHTML = `<a href="/manage-request/${request_id}">${message}</a>`;
    newNotification.classList.add("notification-item");

    // Create a mark as read button for each notification
    if (!is_read) {
        const markAsReadButton = document.createElement("button");
        markAsReadButton.textContent = "Mark as Read";
        markAsReadButton.classList.add("mark-read-button");
        markAsReadButton.onclick = () => markAsRead(id, newNotification);
        newNotification.appendChild(markAsReadButton);
    }
    notificationList.appendChild(newNotification);

    // Increment the notification counter
    counter.textContent = count + 1;
}

// Function to mark a notification as read and update the backend
async function markAsRead(notificationId, notificationElement) {
    let csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    // Mark as read on the backend
    await fetch(`/notifications/${notificationId}/markAsRead`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "Content-Type": "application/json",
        },
    });
    // http.post(`/notifications/${notificationId}/markAsRead`, );

    // Remove the notification from the list
    notificationElement.remove();

    // Decrement the notification counter
    const counter = document.getElementById("notification-counter");
    let count = parseInt(counter.textContent) || 0;
    counter.textContent = count - 1;

    // Show "No notifications" message if there are no notifications
    if (counter.textContent === "0") {
        showNoNotificationsMessage();
    }
}

// Function to show "No notifications" message
function showNoNotificationsMessage() {
    const notificationList = document.getElementById("notification-list");
    notificationList.innerHTML = ""; // Clear the notification list
    const noNotificationItem = document.createElement("li");
    noNotificationItem.textContent = "No notifications";
    notificationList.appendChild(noNotificationItem);
}

// Function to retrieve notifications from the backend
async function loadNotifications() {
    const userId = document
        .querySelector('meta[name="user-id"]')
        .getAttribute("content");
    const response = await fetch("/notifications?user_id=" + userId);
    const notifications = await response.json();
    notifications.forEach((notification) => addNotification(notification));
}

// Initialize the notification counter click event listener
function initializeNotificationCounter() {
    const counter = document.getElementById("notification-counter");
    counter.addEventListener("click", () => {
        const count = parseInt(counter.textContent) || 0;
        if (count === 0) {
            showNoNotificationsMessage();
        } else {
            // Toggle notification list display
            const notificationList =
                document.getElementById("notification-list");
            notificationList.style.display =
                notificationList.style.display === "block" ? "none" : "block";
        }
    });
}

// Make functions available globally
window.addNotification = addNotification;
window.markAsRead = markAsRead;
window.loadNotifications = loadNotifications;
window.initializeNotificationCounter = initializeNotificationCounter;

// Load notifications from the backend when the page is loaded
document.addEventListener("DOMContentLoaded", () => {
    loadNotifications();
    initializeNotificationCounter();
});
