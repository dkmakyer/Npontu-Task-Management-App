<?php

namespace App\Http\Controllers\User;

use App\Events\CalendarEvent;
use App\Events\TaskEvent;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $tasks = $user->tasks()->latest()->where('completed', false)->get();

        // logic for calling the remindUser method once to reduce latency
        if (date('H') == 21) {
            $this->remindUser($id);
        }
        return view('user.my-task', ['tasks' => $tasks]);
    }

    public function store(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'priority' => 'required',
            'description' => 'required',
            'image' => 'image',
            'category' => 'required|in:Educational, Health and Fitness'
        ]);

        // if the request has a file property, then we store the file in the path storage/app/public/profile
        $imagePath = $request->hasFile('image') ? $request->file('image')->store('profile', 'public') : '';
        $user = User::where('id', $id)->with('tasks')->first();
        try {
            $task = $user->tasks()->create([
                'title' => $request->title,
                'description' => $request->description,
                'image_url' => $imagePath,
                'priority' => $request->priority,
                'due_date' => $request->date,
                'category' => $request->category
            ]);
            event(new CalendarEvent($task));
        } catch (Exception $e) {
            return back()->with(['error' => 'Unexpected error occurred']);
        }

        return back();
    }

    public function search(Request $request)
    {
        try {
            $request->validate([
                'search' => 'required'
            ]);
        } catch (Exception $e) {
            return back()->with(['error' => 'Please fill in this field']);
        }

        $user = User::find(Auth::user()->id);

        // search through the users tasks to find the one that matches the search field's value
        $result = $user->tasks()->latest()->where(column: 'title', operator: 'LIKE', value: "%$request->search%")->get();
        $response = $result->count() ? true : false;

        if ($response) {
            return back()->with(['result' => $result]);
        }
    }

    public function showTaskDetails(int $id)
    {
        $task = Task::find($id);
        return back()->with(['selectedTask' => $task]);
    }

    public function destroy(int $id)
    {
        Task::destroy($id);
        return back();
    }

    public function updateTask(int $id)
    {
        return view('user.update-task', ['id' => $id]);
    }

    public function storeUpdatedTask(Request $request, int $id)
    {
        $task = Task::find($id);
        $message = null;
        switch ($request) {
            case $request->title != null:
                try {
                    $task->update($request->only('title'));
                } catch (Exception $e) {
                    $message = "Failed to update task and unexpected error occured";
                }
            case $request->priority != null:
                try {
                    $task->update($request->only('priority'));
                } catch (Exception $e) {
                    $message = "Failed to update task and unexpected error occured";
                }
            case $request->description != null:
                try {
                    $task->update($request->only('description'));
                } catch (Exception $e) {
                    $message = "Failed to update task and unexpected error occured";
                }
            case $request->category != null:
                $request->validate([
                    'category' => 'in:Educational, Health and Fitness'
                ]);
                try {
                    $task->update($request->only('category'));
                } catch (Exception $e) {
                    $message = "Failed to update task and unexpected error occured";
                }
            case $request->date != null:
                $request->validate([
                    'date' => 'date'
                ]);
                try {
                    $task->update($request->only('date'));
                } catch (Exception $e) {
                    $message = "Failed to update task and unexpected error occured";
                }
            case $request->image != null:
                $request->validate([
                    'image' => 'image'
                ]);
                try {
                    $imagePath = $request->hasFile('image') ? $request->file('image')->store('profile', 'public') : '';
                    $task->image_url ? Storage::disk('public')->delete($task->image_url) : '';
                    $task->update(['image_url' => $imagePath]);
                } catch (Exception $e) {
                    $message = "Failed to update task and unexpected error occured";
                }
        }
        $message ?? "Task updated successfully";
        return redirect(route('tasks'))->with(['message' => $message]);
    }

    public function showRecentlyCompletedTasks()
    {
        // to get the currently authenticated user
        $user = User::find(Auth::user()->id);
        // getting tasks that belongs to the authenticated user and have the status completed from the database
        $tasks = $user->completedTasks()->where('completed', true)->with('user')->get();
        return view('user.completed-tasks', ['tasks' => $tasks]);
    }

    public function filterTasks($filter)
    {
        $user = User::find(Auth::user()->id);
        switch ($filter) {
            case 'educational':
                $tasks = $user->completedTasks()->where('completed', true)->where('category', 'Educational')->get();
                break;
            case 'health':
                $tasks = $user->completedTasks()->where('completed', true)->where('category', 'Health and Fitness')->get();
                break;
            case 'all':
                $tasks = $user->completedTasks()->where('completed', true)->get();
                break;
            default:
                $tasks = null;
        }

        if ($tasks) return back()->with(['filtered' => $tasks]);
    }

    public function taskCompleted(int $id)
    {
        $task = Task::find($id);
        $task->update(['completed' => true, 'date_completed' => Carbon::now()]);
        return back();
    }

    public function remindUser(int $id)
    {
        // go through the uncompleted tasks and dispatch a task event to each for a listener to add to the notifications table 
        $tasks = $this->getUncompletedTasks($id);;
        if ($tasks->count()) {
            foreach ($tasks as $task) {
                event(new TaskEvent($task, ['message' => "$task->title uncompleted. Try your best to complete it."]));
            }
        }
    }

    public function getUncompletedTasks(int $id)
    {
        // first get all the tasks that the authenticated user has created
        $user = User::find($id);
        $tasks = $user->tasks()->with(['user', 'notifications'])->latest()
            ->where('completed', false)->where('due_date', '<', Carbon::now())->get();
        return $tasks;
    }
}
