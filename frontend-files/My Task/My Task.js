// Modal Functions
function openModal() {
  document.getElementById("addTaskModal").classList.add("show");
}

function closeModal() {
  document.getElementById("addTaskModal").classList.remove("show");
}

// Close modal when clicking outside
document.addEventListener("click", function (event) {
  const modal = document.getElementById("addTaskModal");
  if (
    modal &&
    modal.classList.contains("show") &&
    !event.target.closest(".modal") &&
    !event.target.closest("button")
  ) {
    closeModal();
  }
});

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

// Toggle Collaboration Notification Popup
document.getElementById("collaboNotificationButton").addEventListener("click", function () {
  const collaboNotificationPopup = document.getElementById("collaboNotificationPopup");
  collaboNotificationPopup.classList.toggle("hidden");
});

// Close Collaboration notification popup when clicking outside
document.addEventListener("click", function (event) {
  const collaboNotificationPopup = document.getElementById("collaboNotificationPopup");
  if (
    collaboNotificationPopup &&
    !event.target.closest("#collaboNotificationButton") &&
    !event.target.closest("#collaboNotificationPopup")
  ) {
    collaboNotificationPopup.classList.add("hidden");
  }
});

// Close Collaboration notification Popup
document.getElementById("closeCollaboPopup").addEventListener("click", function () {
  const collaboNotificationPopup = document.getElementById("collaboNotificationPopup");
  collaboNotificationPopup.classList.add("hidden");
});



// Collaboration Modal Functions
function openCollaboration() {
  const collaborationModal = document.getElementById("addCollaboration");
  collaborationModal.style.display = "flex"; // Show the modal
}

function closeCollaboration() {
  const collaborationModal = document.getElementById("addCollaboration");
  collaborationModal.style.display = "none"; // Hide the modal
}

// DOM Content Loaded
document.addEventListener("DOMContentLoaded", function () {
  const editModal = document.getElementById("edit-task-modal");
  const saveButton = document.getElementById("save-task-status");
  const cancelButton = document.getElementById("cancel-edit");
  let currentTaskElement = null;

  // Edit Task
  function editTask(taskElement) {
    currentTaskElement = taskElement;
    const taskStatus = taskElement.querySelector(".task-status").textContent;
    document.getElementById("task-status").value = taskStatus;
    editModal.classList.remove("hidden");
  }

  // Delete Task
  function deleteTask(taskElement) {
    taskElement.remove();
    updateTaskStatus(); // Update task status percentages
  }

  // Save Task Status
  saveButton.addEventListener("click", function () {
    const newStatus = document.getElementById("task-status").value;
    if (currentTaskElement) {
      currentTaskElement.querySelector(".task-status").textContent = newStatus;
      updateTaskStatus(); // Update task status percentages
      displayTaskDetails(currentTaskElement); // Update task details display
    }
    editModal.classList.add("hidden");
  });

  // Cancel Edit
  cancelButton.addEventListener("click", function () {
    editModal.classList.add("hidden");
  });

  // Add Task Form Submission
  const addTaskForm = document.querySelector("#addTaskModal form");
  addTaskForm.addEventListener("submit", function (event) {
    event.preventDefault();

    // Get form values
    const title = this.title.value;
    const description = this.description.value;
    const priority = this.priority.value;
    const status = "Not Started"; // Default status
    const image = this.image.files[0]
      ? URL.createObjectURL(this.image.files[0])
      : "https://storage.googleapis.com/a1aa/image/t5yut9X4TtbC7SWBkiVsyxlbuWEwr9awoTNlapc04rc.jpg";

    // Create new task element
    const newTask = document.createElement("div");
    newTask.className =
      "dynamicTask p-4 border rounded-lg flex items-center justify-between cursor-pointer";
    newTask.setAttribute("data-task-id", Date.now()); // Unique ID
    newTask.innerHTML = `
          <div>
              <h3 class="text-lg font-bold text-red-500">${title}</h3>
              <p class="text-gray-500">${description}</p>
              <div class="text-sm text-gray-400">Priority: ${priority} | Status: <span class="task-status">${status}</span></div>
          </div>
          <div class="flex mt-2 flex-col gap-4 items-center">
              <img alt="Task illustration" class="rounded-lg" height="50" src="${image}" width="50" />
              <div class="flex flex-row">
                  <button class="bg-red-500 text-white px-4 py-2 rounded mr-2 edit-task">
                      <i class="fas fa-edit"></i>
                  </button>
                  <button class="bg-red-500 text-white px-4 py-2 rounded delete-task">
                      <i class="fas fa-trash"></i>
                  </button>
              </div>
          </div>
      `;

    // Append new task to the task list
    document.getElementById("task-list").appendChild(newTask);

    // Add click event to the new task to display its details
    newTask.addEventListener("click", function (event) {
      // Check if the click target is not a button
      if (
        !event.target.closest(".edit-task") &&
        !event.target.closest(".delete-task")
      ) {
        displayTaskDetails(this);
      }
    });

    // Add edit and delete functionality to the new task buttons
    newTask
      .querySelector(".edit-task")
      .addEventListener("click", function (event) {
        event.stopPropagation(); // Prevent triggering the task detail display
        editTask(newTask);
      });
    newTask
      .querySelector(".delete-task")
      .addEventListener("click", function (event) {
        event.stopPropagation(); // Prevent triggering the task detail display
        deleteTask(newTask);
      });

    // Close modal and reset form
    closeModal();
    this.reset();
    updateTaskStatus(); // Update task status percentages
  });

  // Function to display task details
  function displayTaskDetails(taskElement) {
    const taskDetails = document.querySelector(".task-details");
    const taskTitle = taskElement.querySelector("h3").textContent;
    const taskDescription = taskElement.querySelector("p").textContent;
    const taskPriority = taskElement
      .querySelector(".text-sm.text-gray-400")
      .textContent.split("|")[0]
      .trim();
    const taskStatus = taskElement.querySelector(".task-status").textContent;
    const taskImage = taskElement.querySelector("img").src;

    taskDetails.innerHTML = `
        <div class="flex items-center space-x-4 mb-4">
            <img alt="Task illustration" class="rounded-lg" height="100" src="${taskImage}" width="100" />
            <div>
                <h2 class="text-xl font-bold">${taskTitle}</h2>
                <div class="flex space-x-2 text-sm text-gray-400">
                    <span>${taskPriority}</span>
                    <span>Status: ${taskStatus}</span>
                </div>
            </div>
        </div>
        <div>
            <h3 class="font-bold">Task Title:</h3>
            <p>${taskTitle}</p>
        </div>
        <div>
            <h3 class="font-bold">Objective:</h3>
            <p>${taskDescription}</p>
        </div>
        <div>
            <h3 class="font-bold">Task Description:</h3>
            <p>${taskDescription}</p>
        </div>
    `;
  }

  // Add click event to existing tasks to display their details
  const existingTasks = document.querySelectorAll(".dynamicTask");
  existingTasks.forEach((task) => {
    task.addEventListener("click", function (event) {
      // Check if the click target is not a button
      if (
        !event.target.closest(".edit-task") &&
        !event.target.closest(".delete-task")
      ) {
        displayTaskDetails(this);
      }
    });

    // Add edit and delete functionality to existing task buttons
    task
      .querySelector(".edit-task")
      .addEventListener("click", function (event) {
        event.stopPropagation(); // Prevent triggering the task detail display
        editTask(task);
      });

    task
      .querySelector(".delete-task")
      .addEventListener("click", function (event) {
        event.stopPropagation(); // Prevent triggering the task detail display
        deleteTask(task);
      });
  });

  // Function to update task status percentages
  function updateTaskStatus() {
    const tasks = document.querySelectorAll("[data-task-id]");
    let completed = 0,
      inProgress = 0,
      notStarted = 0;

    tasks.forEach((task) => {
      const status = task.querySelector(".task-status").textContent;
      if (status === "Completed") completed++;
      else if (status === "In Progress") inProgress++;
      else notStarted++;
    });

    const totalTasks = tasks.length;
    const completedPercentage =
      totalTasks > 0 ? Math.round((completed / totalTasks) * 100) : 0;
    const inProgressPercentage =
      totalTasks > 0 ? Math.round((inProgress / totalTasks) * 100) : 0;
    const notStartedPercentage =
      totalTasks > 0 ? Math.round((notStarted / totalTasks) * 100) : 0;

    document.getElementById(
      "completedPercentage"
    ).textContent = `${completedPercentage}%`;
    document.getElementById(
      "inProgressPercentage"
    ).textContent = `${inProgressPercentage}%`;
    document.getElementById(
      "notStartedPercentage"
    ).textContent = `${notStartedPercentage}%`;
  }

  // Initial task status update
  updateTaskStatus();

  // Add Collaboration Invite Functionality
  const sendInviteButton = document.querySelector('#sendInviteButton');
  const emailInput = document.querySelector('#email');
  const goBackButton = document.querySelector('#collaboBackButton');
  const collaborationModal = document.getElementById("addCollaboration");

  // Open collaboration modal when "Invite" button is clicked
  document.querySelector('#mainInviteButton').addEventListener('click', openCollaboration);

  // Close collaboration modal when "Go Back" button is clicked
  goBackButton.addEventListener('click', function (event) {
    event.preventDefault(); // Prevent default link behavior
    closeCollaboration();
  });

  // Close collaboration modal when clicking outside the modal
  document.addEventListener('click', function (event) {
    if (
      collaborationModal.style.display === 'flex' && // Check if modal is open
      !event.target.closest('.bg-white') && // Check if click is outside the modal content
      !event.target.closest('button[onclick="openCollaboration()"]') // Ensure the "Invite" button doesn't close the modal
    ) {
      closeCollaboration();
    }
  });

  // Send invite functionality
  sendInviteButton.addEventListener('click', function () {
    const email = emailInput.value;

    // Check if the email input is not empty
    if (email) {
      // Send the email to the backend
      fetch('https://your-backend-endpoint.com/api/invite', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ email: email }),
      })
        .then(response => {
          if (response.ok) {
            alert('Invite sent successfully!');
            emailInput.value = ''; // Clear the input field
          } else {
            alert('Failed to send invite. Please try again.');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('An error occurred. Please try again later.');
        });
    } else {
      alert('Please enter a valid email address.');
    }
  });
});