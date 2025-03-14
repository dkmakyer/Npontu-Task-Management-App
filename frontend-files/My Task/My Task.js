// Modal Functions
function openModal() {
  document.getElementById('addTaskModal').classList.add('show');
}

function closeModal() {
  document.getElementById('addTaskModal').classList.remove('show');
}

// Close modal when clicking outside
document.addEventListener('click', function (event) {
  const modal = document.getElementById('addTaskModal');
  if (modal && modal.classList.contains('show') && !event.target.closest('.modal') && !event.target.closest('button')) {
      closeModal();
  }
});

// DOM Content Loaded
document.addEventListener('DOMContentLoaded', function () {
  const editButtons = document.querySelectorAll('.edit-task');
  const deleteButtons = document.querySelectorAll('.delete-task');
  const editModal = document.getElementById('edit-task-modal');
  const saveButton = document.getElementById('save-task-status');
  const cancelButton = document.getElementById('cancel-edit');
  let currentTaskElement = null;

  // Edit Task
  editButtons.forEach(button => {
      button.addEventListener('click', function () {
          currentTaskElement = this.closest('[data-task-id]');
          editModal.classList.remove('hidden');
      });
  });

  // Delete Task
  deleteButtons.forEach(button => {
      button.addEventListener('click', function () {
          const taskElement = this.closest('[data-task-id]');
          taskElement.remove();
          updateTaskStatus(); // Update task status percentages
      });
  });

  // Save Task Status
  saveButton.addEventListener('click', function () {
      const newStatus = document.getElementById('task-status').value;
      if (currentTaskElement) {
          currentTaskElement.querySelector('.task-status').textContent = newStatus;
          updateTaskStatus(); // Update task status percentages
      }
      editModal.classList.add('hidden');
  });

  // Cancel Edit
  cancelButton.addEventListener('click', function () {
      editModal.classList.add('hidden');
  });

  // Add Task Form Submission
  const addTaskForm = document.querySelector('#addTaskModal form');
  addTaskForm.addEventListener('submit', function (event) {
      event.preventDefault();

      // Get form values
      const title = this.title.value;
      const description = this.description.value;
      const priority = this.priority.value;
      const status = 'Not Started'; // Default status
      const image = this.image.files[0] ? URL.createObjectURL(this.image.files[0]) : 'https://storage.googleapis.com/a1aa/image/t5yut9X4TtbC7SWBkiVsyxlbuWEwr9awoTNlapc04rc.jpg';

      // Create new task element
      const newTask = document.createElement('div');
      newTask.className = 'dynamicTask p-4 border rounded-lg flex items-center justify-between cursor-pointer';
      newTask.setAttribute('data-task-id', Date.now()); // Unique ID
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
      document.getElementById('task-list').appendChild(newTask);

      // Add click event to the new task to display its details
      newTask.addEventListener('click', function () {
          displayTaskDetails(this);
      });

      // Close modal and reset form
      closeModal();
      this.reset();
      updateTaskStatus(); // Update task status percentages
  });

  // Function to display task details
  function displayTaskDetails(taskElement) {
      const taskDetails = document.querySelector('.bg-white.p-6.rounded-lg.shadow-md.w-full.md\\:w-1\\/2');
      const taskTitle = taskElement.querySelector('h3').textContent;
      const taskDescription = taskElement.querySelector('p').textContent;
      const taskPriority = taskElement.querySelector('.text-sm.text-gray-400').textContent.split('|')[0].trim();
      const taskStatus = taskElement.querySelector('.task-status').textContent;
      const taskImage = taskElement.querySelector('img').src;

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
          <div>
              <h3 class="font-bold">Additional Notes:</h3>
              <ul class="list-disc list-inside">
                  <li>Ensure that documents are authentic and up-to-date.</li>
                  <li>Maintain confidentiality and security of sensitive information.</li>
                  <li>If there are specific guidelines or deadlines for submission, adhere to them diligently.</li>
              </ul>
          </div>
          <div>
              <h3 class="font-bold">Deadline for Submission:</h3>
              <p>End of Day</p>
          </div>
          <div class="flex">
              <button class="bg-red-500 text-white px-4 py-2 rounded mr-2 edit-task">
                  <i class="fas fa-edit"></i>
              </button>
              <button class="bg-red-500 text-white px-4 py-2 rounded delete-task">
                  <i class="fas fa-trash"></i>
              </button>
          </div>
      `;
  }

  // Add click event to existing tasks to display their details
  const existingTasks = document.querySelectorAll('.dynamicTask');
  existingTasks.forEach(task => {
      task.addEventListener('click', function () {
          displayTaskDetails(this);
      });
  });

  // Function to update task status percentages
  function updateTaskStatus() {
      const tasks = document.querySelectorAll('[data-task-id]');
      let completed = 0, inProgress = 0, notStarted = 0;

      tasks.forEach(task => {
          const status = task.querySelector('.task-status').textContent;
          if (status === 'Completed') completed++;
          else if (status === 'In Progress') inProgress++;
          else notStarted++;
      });

      const totalTasks = tasks.length;
      const completedPercentage = totalTasks > 0 ? Math.round((completed / totalTasks) * 100) : 0;
      const inProgressPercentage = totalTasks > 0 ? Math.round((inProgress / totalTasks) * 100) : 0;
      const notStartedPercentage = totalTasks > 0 ? Math.round((notStarted / totalTasks) * 100) : 0;

      document.getElementById('completedPercentage').textContent = `${completedPercentage}%`;
      document.getElementById('inProgressPercentage').textContent = `${inProgressPercentage}%`;
      document.getElementById('notStartedPercentage').textContent = `${notStartedPercentage}%`;
  }

  // Initial task status update
  updateTaskStatus();
});