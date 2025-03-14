function openModal() {
    document.getElementById('addTaskModal').classList.add('show');
  }
  
  function closeModal() {
    document.getElementById('addTaskModal').classList.remove('show');
  }
  
  document.addEventListener('click', function (event) {
    const modal = document.getElementById('addTaskModal');
    if (modal && modal.classList.contains('show') && !event.target.closest('.modal') && !event.target.closest('button')) {
      closeModal();
    }
  });
  
  document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-task');
    const deleteButtons = document.querySelectorAll('.delete-task');
    const editModal = document.getElementById('edit-task-modal');
    const saveButton = document.getElementById('save-task-status');
    const cancelButton = document.getElementById('cancel-edit');
    let currentTaskElement = null;
  
    editButtons.forEach(button => {
      button.addEventListener('click', function () {
        currentTaskElement = this.closest('[data-task-id]');
        editModal.classList.remove('hidden');
      });
    });
  
    deleteButtons.forEach(button => {
      button.addEventListener('click', function () {
        const taskElement = this.closest('[data-task-id]');
        taskElement.remove();
      });
    });
  
    saveButton.addEventListener('click', function () {
      const newStatus = document.getElementById('task-status').value;
      if (currentTaskElement) {
        currentTaskElement.querySelector('.task-status').textContent = newStatus;
      }
      editModal.classList.add('hidden');
    });
  
    cancelButton.addEventListener('click', function () {
      editModal.classList.add('hidden');
    });
  });
  





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
