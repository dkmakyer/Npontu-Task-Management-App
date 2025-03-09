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
