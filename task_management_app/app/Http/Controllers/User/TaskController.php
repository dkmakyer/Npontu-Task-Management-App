<?php

namespace App\Http\Controllers\User;

use App\Events\CalendarEvent;
use App\Events\TaskEvent;
use App\Http\Controllers\Controller;
use App\Models\Collaborator;
use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;
use DivisionByZeroError;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = $this->getAuthUser();
        $tasks = $this->getMyTasks(user: $user, columnForCondition: 'completed', value: false, limit: 5);
        $completedTasks = $this->getMyTasks(user: $user, columnForCondition: 'completed', value: true, limit: null);

        $uncompletedTasks = $user->tasks()->where('completed', false)->where('due_date', '<', Carbon::now())->with(['user', 'notifications'])->latest()->get();
        $inProgress = $user->tasks()->where('completed', false)->where('due_date', '>', Carbon::now())->with(['user', 'notifications'])->latest()->get();

        $array = $this->getOwnerTasks($user->id);
        $ownerTasks = null;
        $uncompletedOwnerTasks = 0;
        if ($array) {
            $ownerTasks = $array[0];
            $uncompletedOwnerTasks = $array[1];
        }

        // $this->sendReminder();
        $collaborators = $user->collaborators;


        if ($collaborators->count()) {
            return view('user.my-task', ['tasks' => $tasks, 'collaborators' => $collaborators, 'ownerTasks' => $ownerTasks, 'completed' => $completedTasks->count(), 'uncompleted' => $uncompletedTasks->count(), 'inProgress' => $inProgress->count(), 'uncompletedCollabTasks' => $uncompletedOwnerTasks]);
        }

        return view('user.my-task', ['tasks' => $tasks, 'collaborators' => null, 'ownerTasks' => $ownerTasks, 'completed' => $completedTasks->count(), 'uncompleted' => $uncompletedTasks->count(), 'inProgress' => $inProgress->count(), 'uncompletedCollabTasks' => $uncompletedOwnerTasks]);
    }

    public function store(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'priority' => 'required',
            'description' => 'required',
            'image' => 'image',
            'category' => 'required|not_in:0'
        ]);

        // if the request has a file property, then we store the file in the path storage/app/public/profile
        $imagePath = $request->hasFile('image') ? $request->file('image')->store('profile', 'public') : '';
        $user = User::with(relations: ['notifications', 'collaborators', 'tasks', 'completedTasks'])->where('id', $id)->with('tasks')->first();
        try {
            $task = $user->tasks()->create([
                'title' => $request->title,
                'description' => $request->description,
                'image_url' => $imagePath,
                'priority' => $request->priority,
                'due_date' => $request->date,
                'category' => $request->category
            ]);
            // dispatch a calendar event once a user creates a new task for the reminders to be able to work
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
        } catch (ValidationException $e) {
            return back()->with(['error' => 'Please fill in this field']);
        }

        $user = $this->getAuthUser();

        // search through the users tasks to find the one that looks like the search field's value
        $result = $user->tasks()->latest()->where(column: 'title', operator: 'LIKE', value: "%$request->search%")->get();
        $response = $result->count() ? true : false;


        // return back with result which will be a session key
        return back()->with(['result' => $result]);
    }

    public function showTaskDetails(int $id)
    {
        $task = Task::with(['user', 'notifications'])->find($id);
        return back()->with(['selectedTask' => $task]);
    }

    public function destroy(int $id)
    {
        Task::with(['user', 'notifications'])->destroy($id);
        return back();
    }

    public function updateTask(int $id)
    {
        return view('user.update-task', ['id' => $id]);
    }

    public function storeUpdatedTask(Request $request, int $id)
    {
        $task = Task::with(['user', 'notifications'])->find($id);
        $message = null;
        switch ($request) {
            case $request->title != null:
                try {
                    $task->update($request->only('title'));
                } catch (Exception $e) {
                    $message = "Failed to update task an unexpected error occured";
                }
            case $request->priority != null:
                try {
                    $task->update($request->only('priority'));
                } catch (Exception $e) {
                    $message = "Failed to update task an unexpected error occured";
                }
            case $request->description != null:
                try {
                    $task->update($request->only('description'));
                } catch (Exception $e) {
                    $message = "Failed to update task an unexpected error occured";
                }
            case $request->category != null:
                $request->validate([
                    'category' => 'in:Educational, Health and Fitness'
                ]);
                try {
                    $task->update($request->only('category'));
                } catch (Exception $e) {
                    $message = "Failed to update task an unexpected error occured";
                }
            case $request->date != null:
                $request->validate([
                    'date' => 'date'
                ]);
                try {
                    $task->update($request->only('date'));
                } catch (Exception $e) {
                    $message = "Failed to update task an unexpected error occured";
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
                    $message = "Failed to update task an unexpected error occured";
                }
        }
        $message ?? "Task updated successfully";
        return redirect(route('tasks'))->with(['message' => $message]);
    }

    public function showRecentlyCompletedTasks()
    {
        // to get the currently authenticated user
        $user = $this->getAuthUser();
        // getting tasks that belongs to the authenticated user and have the status completed from the database
        $completedTasks = $user->completedTasks()->where('completed', true)->get();
        $allTasks = $this->getMyTasks($user, 'completed', value: false, limit: null);
        return view('user.all-tasks', ['completedTasks' => $completedTasks, 'tasks' => $allTasks]);
    }

    public function filterTasks($filter)
    {
        $user = $this->getAuthUser();
        switch ($filter) {
            case 'educational':
                $tasks = $user->completedTasks()->where('completed', true)->where('category', 'Educational')->get();
                $allTasksFilter = $this->getMyTasks($user, 'completed', value: 'Educational', limit: null);
                break;
            case 'health':
                $tasks = $user->completedTasks()->where('completed', true)->where('category', 'Health and Fitness')->get();
                $allTasksFilter = $this->getMyTasks($user, 'completed', value: 'Health and Fitness', limit: null);
                break;
            case 'all':
                $tasks = $user->completedTasks()->where('completed', true)->get();
                $allTasksFilter = $this->getMyTasks($user, 'completed', value: false, limit: null);

                break;
            default:
                $tasks = null;
        }

        if ($tasks && $allTasksFilter) return back()->with(['filtered' => $allTasksFilter, 'filteredCompletedTasks' => $tasks]);
    }

    public function taskCompleted(int $id)
    {
        // when the task is marked as completed, 
        // we update it by marking the completed column for the particular task as true
        $task = Task::with(['user', 'notifications'])->find($id);
        $task->update(['completed' => true, 'date_completed' => Carbon::now()]);
        return back();
    }

    public function sendReminder()
    {
        if (Auth::user()) {
            $user = User::with(relations: ['notifications', 'collaborators', 'tasks', 'completedTasks'])->find(Auth::user()->id);
            $tasks = $user->tasks()->with(['user', 'notifications'])->latest()->where('completed', false)->get();
            foreach ($tasks as $task) {
                // the reminders will be sent based on the priority level set by the user
                if ($task->priority === 'high' && $task->due_date->toDateString() === Carbon::now()->addDays(2)->toDateString()) {
                    event(new TaskEvent($task, ['message' => "$task->title is due to be completed on " . $task->due_date->toFormattedDateString()]));
                } else if ($task->priority === 'medium' && $task->due_date->toDateString() === Carbon::now()->addDays(1)->toDateString()) {
                    event(new TaskEvent($task, ['message' => "$task->title is due to be completed on " . $task->due_date->toFormattedDateString()]));
                } else if ($task->priority === 'low' && $task->due_date->toDateString() == Carbon::now()->toDateString()) {
                    event(new TaskEvent($task, ['message' => "$task->title is due today. \nTry your best to complete it.  "]));
                }
            }
        }
    }

    public function getOwnerTasks($id)
    {
        $ownerTasks = collect();

        try {
            $collaborator = Collaborator::with(['users', 'user'])->where('collaborated_by', $id)->firstOrFail();
            $owners = $collaborator->users;
            if ($owners->count()) {
                foreach ($owners as $owner) {
                    $task = $owner->tasks()->latest()->where('completed', false)->where('due_date', '>', Carbon::now())->get();
                    global $uncompletedTask;
                    $uncompletedTask = $owner->tasks()->latest()->where('due_date', '<', Carbon::now())->where('completed', false)->get()->count();
                    foreach ($task as $ownerTask) {
                        $ownerTasks->push($ownerTask);
                    }
                }
            }

            if ($ownerTasks->count()) return [$ownerTasks, $uncompletedTask];
            return null;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function calculatePercentage(int $total, int $count)
    {
        try {
            $percentage = ($count / $total) * 100;
            if ($percentage === 100) {
                return $percentage;
            }
            return number_format($percentage, 1);
        } catch (DivisionByZeroError $e) {
            return 0;
        }
    }

    public function getMyTasks($user, ?string $columnForCondition, null|bool|string|object $value, ?int $limit, string $operator = '=',)
    {

        if ($columnForCondition) {
            return $user->tasks()->where($columnForCondition, $operator, $value)->with(['user', 'notifications'])->latest()->get();
        } else if ($columnForCondition && $limit) {
            return $user->tasks()->where($columnForCondition, $operator, $value)->with(['user', 'notifications'])->latest()->limit($limit)->get();
        } else if ($limit) {
            return $user->tasks()->with(['user', 'notifications'])->latest()->limit($limit)->get();
        }

        return $user->tasks()->with(['user', 'notifications'])->latest()->get();
    }

    public function getAuthUser()
    {
        return User::with(['notifications', 'collaborators', 'tasks', 'completedTasks'])->find(Auth::user()->id);
    }
}
