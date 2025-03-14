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
async function fetchTaskStatus() {
    try {
        const response = await fetch('/task-status'); // Laravel API route
        const data = await response.json();

        // Update UI
        document.getElementById('completed-circle').textContent = data.completed + '%';
        document.getElementById('in-progress-circle').textContent = data.in_progress + '%';
        document.getElementById('not-started-circle').textContent = data.not_started + '%';
    } catch (error) {
        console.error('Error fetching task status:', error);
    }
}

fetchTaskStatus();

// Run the function on page load
document.addEventListener("DOMContentLoaded", updateTaskStatus);

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
