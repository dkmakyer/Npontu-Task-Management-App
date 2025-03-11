function openCalendar() {
    const dateInput = document.getElementById('taskDate');
    dateInput.focus(); // This will open the date picker in most browsers
}

function openModal() {
    document.getElementById('addTaskModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('addTaskModal').style.display = 'none';
}
// Sample task data (Replace this with real tasks from your database or UI)
let tasks = [
    { title: "Task 1", status: "Completed" },
    { title: "Task 2", status: "In Progress" },
    { title: "Task 3", status: "Not Started" },
    { title: "Task 4", status: "Completed" },
    { title: "Task 5", status: "In Progress" },
    { title: "Task 6", status: "Completed" }
];

// Function to update task status percentages
function updateTaskStatus() {
    let totalTasks = tasks.length;
    let completedTasks = tasks.filter(task => task.status === "Completed").length;
    let inProgressTasks = tasks.filter(task => task.status === "In Progress").length;
    let notStartedTasks = tasks.filter(task => task.status === "Not Started").length;

    // Calculate percentages
    let completedPercentage = totalTasks > 0 ? Math.round((completedTasks / totalTasks) * 100) : 0;
    let inProgressPercentage = totalTasks > 0 ? Math.round((inProgressTasks / totalTasks) * 100) : 0;
    let notStartedPercentage = totalTasks > 0 ? Math.round((notStartedTasks / totalTasks) * 100) : 0;

    // Update UI
    document.getElementById("completedPercentage").textContent = `${completedPercentage}%`;
    document.getElementById("inProgressPercentage").textContent = `${inProgressPercentage}%`;
    document.getElementById("notStartedPercentage").textContent = `${notStartedPercentage}%`;
}

// Run the function on page load
document.addEventListener("DOMContentLoaded", updateTaskStatus);
