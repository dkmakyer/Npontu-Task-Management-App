<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        // Fetch the authenticated user
        $user = Auth::user();

        // Fetch tasks for the authenticated user
        $tasks = $user->tasks; // Assuming you have a relationship defined in the User model
        return view("tasks.all", compact("tasks"));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'priority' => 'required',
            'description' => 'required',
            'image' => 'image|nullable'
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('profile', 'public') : null;

        // Create the task associated with the user
        $user->tasks()->create([
            'user_id' => Auth::id(), // This line can be removed if you are using the $user instance
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $imagePath,
            'priority' => $request->priority,
            'due_date' => $request->date,
        ]);

        return back()->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        // Check if the authenticated user is authorized to view the task
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized access.');
        }

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        // Check if the authenticated user is authorized to edit the task
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized access.');
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'image|nullable',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);

        // Check if the authenticated user is authorized to update the task
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized access.');
        }

        // Handle the image upload
        $imagePath = $request->hasFile('image') ? $request->file('image')->store('profile', 'public') : $task->image_url;

        // Update the task with the request data
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $imagePath,
            'priority' => $request->priority,
            'due_date' => $request->date,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        // Check if the authenticated user is authorized to delete the task
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized access.');
        }

        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
