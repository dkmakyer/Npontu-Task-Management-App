document
    .getElementById("notificationButton")
    .addEventListener("click", function () {
        document.getElementById("notificationPopup").classList.remove("hidden");
    });

document.getElementById("closePopup").addEventListener("click", function () {
    document.getElementById("notificationPopup").classList.add("hidden");
});

document
    .getElementById("notificationPopup")
    .addEventListener("click", function (event) {
        if (event.target === this) {
            document
                .getElementById("notificationPopup")
                .classList.add("hidden");
        }
    });

//Add Task
function openCalendar() {
    const dateInput = document.getElementById("taskDate");
    dateInput.focus(); // This will open the date picker in most browsers
}

function openAddTaskModal() {
    document.getElementById("addTaskModal").classList.remove("hidden");
}

function closeAddTaskModal(event) {
    if (!event || event.target === document.getElementById("addTaskModal")) {
        document.getElementById("addTaskModal").classList.add("hidden");
    }
}

// Collaboration Modal Functions
const collaborationModal = document.getElementById("addCollaboration");
function openCollaboration() {
    collaborationModal.style.display = "flex"; // Show the modal
}

function closeCollaboration() {
    const collaborationModal = document.getElementById("addCollaboration");
    collaborationModal.style.display = "none"; // Hide the modal
}

// Open collaboration modal when "Invite" button is clicked
document
    .querySelector("#mainInviteButton")
    .addEventListener("click", openCollaboration);

// Close collaboration modal when "Go Back" button is clicked
const goBackButton = document.querySelector("#collaboBackButton");
goBackButton.addEventListener("click", function (event) {
    event.preventDefault(); // Prevent default link behavior
    closeCollaboration();
});

// Close collaboration modal when clicking outside the modal
document.addEventListener("click", function (event) {
    if (
        collaborationModal.style.display === "flex" && // Check if modal is open
        !event.target.closest(".bg-white") && // Check if click is outside the modal content
        !event.target.closest('button[onclick="openCollaboration()"]') // Ensure the "Invite" button doesn't close the modal
    ) {
        closeCollaboration();
    }
});
// Toggle Collaboration Notification Popup
document
    .getElementById("collaboNotificationButton")
    .addEventListener("click", function () {
        const collaboNotificationPopup = document.getElementById(
            "collaboNotificationPopup"
        );
        collaboNotificationPopup.classList.toggle("hidden");
    });

// Close Collaboration notification popup when clicking outside
document.addEventListener("click", function (event) {
    const collaboNotificationPopup = document.getElementById(
        "collaboNotificationPopup"
    );
    if (
        collaboNotificationPopup &&
        !event.target.closest("#collaboNotificationButton") &&
        !event.target.closest("#collaboNotificationPopup")
    ) {
        collaboNotificationPopup.classList.add("hidden");
    }
});

// Close Collaboration notification Popup
document
    .getElementById("closeCollaboPopup")
    .addEventListener("click", function () {
        const collaboNotificationPopup = document.getElementById(
            "collaboNotificationPopup"
        );
        collaboNotificationPopup.classList.add("hidden");
    });
