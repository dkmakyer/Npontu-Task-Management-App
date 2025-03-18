<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\User\TaskController;
use App\Http\Controllers\User\CollaborationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\UserController;

// routes to show login in page and handle logging in logic
// a user will access the login page only if him or her is a guest
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'store']);

// routes to handle logging in with googlge 
// since we implemented the calendar integration, the user to log in must provide his or her email for me to add to the google cloud platform as a test user
// before the logging in will be accepted by google  
Route::get('auth/google/login', [SocialiteController::class, 'login'])->name('google.login');
Route::get('auth/google/callback', [SocialiteController::class, 'callback'])->name('google.callback');

// routes for showing register page and handling logic for registering a user
// a user will only access the register page if he or she is a guest
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'store']);

// route to show an authenticated user his or her profile 
// for him or her to be able to update it
Route::get('profile', [UserController::class, 'index'])->name('profile');
Route::get('cancel-update', [UserController::class, 'cancel'])->name('cancel.update');

// route to show the user the page to update his profile and also
// route for logic in updating and storing the users updated profile
Route::get('profile-update', [UserController::class, 'showUpdateProfileView'])->name('update.profile');
Route::post('profile-update', [UserController::class, 'storeUpdatedProfile'])->name('store.update');

// route to show the user the page for changing password and 
// route to store the changed password after some logic has been defined
Route::get('change-password', [UserController::class, 'showChangePasswordView'])->name('change.password');
Route::post('change-password', [UserController::class, 'storeChangedPassword']);

// Route to show the task page and also
// route which provides logic for storing a newly created task in the database
Route::get('tasks', [TaskController::class, 'index'])->name('tasks');
Route::post('{id}/task/store', [TaskController::class, 'store'])->name('store.task');

// route for searching the database for a particular task to show
// also route for showing the details of a tasks when it clicked on
Route::get('search', [TaskController::class, 'search'])->name('search.task');
Route::get('task/{id}', [TaskController::class, 'showTaskDetails'])->name('show.task.details');

// route for deleting a task from the database 
// and also route for showing the page for updating a task
Route::get('task/{id}/delete', [TaskController::class, 'destroy'])->name('delete.task');
Route::get('task/{id}/update', [TaskController::class, 'updateTask'])->name('update.task');

// route for storing the updated task and also 
// route for displaying the recently completed tasks page
Route::post('task/{id}/update', [TaskController::class, 'storeUpdatedTask']);
Route::get('tasks/completed', [TaskController::class, 'showRecentlyCompletedTasks'])->name('completed.tasks');

// route for filtering the tasks that are being shown in the completed tasks page 
// and also route providing the logic for marking a task as completed in the tasks page
Route::get('task/completed/{filter}', [TaskController::class, 'filterTasks'])->name('filtered.tasks');
Route::get('task/{id}/completed', [TaskController::class, 'taskCompleted'])->name('task.completed');

// route for displaying the settings page 
// and also route for displaying the help page
Route::get('settings', [SettingsController::class, 'index'])->name('settings');
Route::get('help', [HelpController::class, 'index'])->name('help');

// Route for sending an invite request to a user
Route::post('/send/invite', [CollaborationController::class, 'send'])->name('send.invite');
Route::get('/collaboration', [CollaborationController::class, 'showCollaborators'])->name('collaboration');

// Route for accepting a collaboration logic
Route::get('/collaboration/{id}/accept', [CollaborationController::class, 'acceptCollaboration'])->name('accept.collaboration');
// leave collaboration route
Route::get('collaboration/{id}/leave', [CollaborationController::class, 'leaveCollaboration'])->name('leave.collaboration');

// Route to show notification settings page
Route::get('notifications/settings', function () {
    return view('settings.notifications');
})->name('notification.settings');

// route for logging a user out 
// this route is only available to authenticated users
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');
