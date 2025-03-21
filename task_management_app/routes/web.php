<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\User\TaskController;
use App\Http\Controllers\User\CollaborationController;
use App\Http\Controllers\UserController;


// method for grouping all routes that make use of a common controller for easy reading and understanding
Route::controller(UserController::class)->group(function () {

    // route to show an authenticated user his or her profile 
    // for him or her to be able to update it
    Route::get('profile', 'index')->name('profile');
    Route::get('cancel-update',  'cancel')->name('cancel.update');

    // route to show the user the page to update his profile and also
    // route for logic in updating and storing the users updated profile
    Route::get('profile-update', 'showUpdateProfileView')->name('update.profile');
    Route::post('profile-update', 'storeUpdatedProfile')->name('store.update');

    // route to show the user the page for changing password and 
    // route to store the changed password after some logic has been defined
    Route::get('change-password', 'showChangePasswordView')->name('change.password');
    Route::post('change-password',  'storeChangedPassword');
});


// grouping all routes that make use of the task controller class for easy reading 
Route::controller(TaskController::class)->group(function () {

    // Route to show the task page and also
    // route which provides logic for storing a newly created task in the database
    Route::get('tasks', 'index')->name('tasks');
    Route::post('{id}/task/store', 'store')->name('store.task');

    // route for searching the database for a particular task to show
    // also route for showing the details of a tasks when it clicked on
    Route::get('search', 'search')->name('search.task');
    Route::get('task/{id}', 'showTaskDetails')->name('show.task.details');

    // route for deleting a task from the database 
    // and also route for showing the page for updating a task
    Route::get('task/{id}/delete', 'destroy')->name('delete.task');
    Route::get('task/{id}/update', 'updateTask')->name('update.task');


    // route for storing the updated task and also 
    // route for displaying the recently completed tasks page
    Route::post('task/{id}/update', [TaskController::class, 'storeUpdatedTask']);
    Route::get('all-tasks', [TaskController::class, 'showRecentlyCompletedTasks'])->name('all.tasks');

    // route for filtering the tasks that are being shown in the completed tasks page 
    // and also route providing the logic for marking a task as completed in the tasks page
    Route::get('task/completed/{filter}', [TaskController::class, 'filterTasks'])->name('filtered.tasks');
    Route::get('task/{id}/completed', [TaskController::class, 'taskCompleted'])->name('task.completed');
});


// grouping all routes that make use of the collaboration controller for easy reading
Route::controller(CollaborationController::class)->group(function () {

    // Route for sending an invite request to a user
    Route::post('/send/invite',  'send')->name('send.invite');

    // Route for accepting a collaboration logic
    Route::get('/collaboration/{id}/accept', 'acceptCollaboration')->name('accept.collaboration');
    Route::get('collaboration/{id}/reject', 'rejectCollaboration')->name('reject.collaboration');

    // leave collaboration route
    Route::get('collaboration/{id}/leave', 'leaveCollaboration')->name('leave.collaboration');
});


// Route to show views directly
Route::view('settings', 'settings.settings')->name('settings')->middleware('auth');
Route::view('notifications/settings', 'settings.notifications')->name('notification.settings')->middleware('auth');
Route::view('help', 'help')->name('help')->middleware('auth');

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


// route for logging a user out 
// this route is only available to authenticated users
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');
