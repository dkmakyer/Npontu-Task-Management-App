document.addEventListener("DOMContentLoaded", function () {
    const filterDropdown = document.querySelector("#selectFilter");
    const tasks = document.querySelectorAll(".task, .study, health");

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
});
//notification popup
document.getElementById('notificationButton').addEventListener('click', function() {
    document.getElementById('notificationPopup').classList.remove('hidden');
});

document.getElementById('closePopup').addEventListener('click', function() {
    document.getElementById('notificationPopup').classList.add('hidden');
});

document.getElementById('notificationPopup').addEventListener('click', function(event) {
    if (event.target === this) {
        document.getElementById('notificationPopup').classList.add('hidden');
    }
});