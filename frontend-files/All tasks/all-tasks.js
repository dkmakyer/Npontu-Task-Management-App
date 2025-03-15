document.addEventListener("DOMContentLoaded", function () {
    const filterDropdown = document.querySelector("#selectFilter");
    const tasks = document.querySelectorAll(".task, .study, .health");

    // Filter tasks based on the selected filter
    filterDropdown.addEventListener("change", function () {
        const selectedFilter = filterDropdown.value;

        tasks.forEach(task => {
            if (selectedFilter === "" || selectedFilter === "task") {
                task.style.display = "flex"; // Show all tasks
            } else {
                if (task.classList.contains(selectedFilter)) {
                    task.style.display = "flex"; // Show matched tasks
                } else {
                    task.style.display = "none"; // Hide unmatched tasks
                }
            }
        });
    });

    // Notification popup functionality
    const notificationButton = document.getElementById('notificationButton');
    const notificationPopup = document.getElementById('notificationPopup');
    const closePopup = document.getElementById('closePopup');

    // Toggle notification popup visibility
    notificationButton.addEventListener('click', function () {
        notificationPopup.classList.toggle('hidden');
    });

    // Close notification popup when clicking the close button
    closePopup.addEventListener('click', function () {
        notificationPopup.classList.add('hidden');
    });

    // Close notification popup when clicking outside of it
    notificationPopup.addEventListener('click', function (event) {
        if (event.target === this) {
            notificationPopup.classList.add('hidden');
        }
    });
});