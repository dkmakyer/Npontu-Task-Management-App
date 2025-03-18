// Toggle Notification Popup
document.getElementById("notificationButton").addEventListener("click", function () {
    const notificationPopup = document.getElementById("notificationPopup");
    notificationPopup.classList.toggle("hidden");
  });

  // Close notification popup when clicking outside
  document.addEventListener("click", function (event) {
    const notificationPopup = document.getElementById("notificationPopup");
    if (
      notificationPopup &&
      !event.target.closest("#notificationButton") &&
      !event.target.closest("#notificationPopup")
    ) {
      notificationPopup.classList.add("hidden");
    }
  });

  // Close Notification Popup
  document.getElementById("closePopup").addEventListener("click", function () {
    const notificationPopup = document.getElementById("notificationPopup");
    notificationPopup.classList.add("hidden");
  });

  document.addEventListener('DOMContentLoaded', function () {
    const notificationButton = document.getElementById('notificationButton');
    const notificationPopup = document.getElementById('notificationPopup');
    const closePopup = document.getElementById('closePopup');
    const editTaskButton = document.getElementById('editTaskButton');
    const deleteTaskButton = document.getElementById('deleteTaskButton');
    const editTaskModal = document.getElementById('edit-task-modal');
    const deleteTaskModal = document.getElementById('delete-task-modal');
    const cancelEdit = document.getElementById('cancel-edit');
    const cancelDelete = document.getElementById('cancel-delete');

    notificationButton.addEventListener('click', function () {
        notificationPopup.classList.remove('hidden');
    });

    closePopup.addEventListener('click', function () {
        notificationPopup.classList.add('hidden');
    });

    editTaskButton.addEventListener('click', function () {
        editTaskModal.classList.remove('hidden');
    });

    deleteTaskButton.addEventListener('click', function () {
        deleteTaskModal.classList.remove('hidden');
    });

    cancelEdit.addEventListener('click', function () {
        editTaskModal.classList.add('hidden');
    });

    cancelDelete.addEventListener('click', function () {
        deleteTaskModal.classList.add('hidden');
    });
});