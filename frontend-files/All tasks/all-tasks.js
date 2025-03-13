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