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

//Add Task
function openCalendar() {
    const dateInput = document.getElementById('taskDate');
    dateInput.focus(); // This will open the date picker in most browsers
}

function openAddTaskModal() {
    document.getElementById('addTaskModal').classList.remove('hidden');
}

function closeAddTaskModal(event) {
    if (!event || event.target === document.getElementById('addTaskModal')) {
        document.getElementById('addTaskModal').classList.add('hidden');
    }
}