<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Task; // Assuming you have a Task model
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(int $id)
    {
        $user = User::findOrFail($id);
        $tasks = $user->tasks()->get();

        return view('tasks.index', compact('user', 'tasks'));
    }

    public function create(int $id)
    {
        $user = User::findOrFail($id);
        return view('tasks.create', compact('user'));
    }

    public function store(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'priority' => 'required',
            'description' => 'required',
            'image' => 'image'
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('profile', 'public') : '';
        $user = User::findOrFail($id);
        $user->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $imagePath,
            'priority' => $request->priority,
            'due_date' => $request->date,
        ]);

        return redirect()->route('tasks.index', $id)->with('success', 'Task created successfully.');
    }

    public function show(int $userId, int $taskId)
    {
        $task = Task::where('id', $taskId)->where('user_id', $userId)->firstOrFail();
        return view('tasks.show', compact('task'));
    }

    public function edit(int $userId, int $taskId)
    {
        $task = Task::where('id', $taskId)->where('user_id', $userId)->firstOrFail();
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, int $userId, int $taskId)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'priority' => 'required',
            'description' => 'required',
            'image' => 'image'
        ]);

        $task = Task::where('id', $taskId)->where('user_id', $userId)->firstOrFail();

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('profile', 'public') : $task->image_url;

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $imagePath,
            'priority' => $request->priority,
            'due_date' => $request->date,
        ]);

        return redirect()->route('tasks.index', $userId)->with('success', 'Task updated successfully.');
    }

    public function destroy(int $userId, int $taskId)
    {
        $task = Task::where('id', $taskId)->where('user_id', $userId)->firstOrFail();
        $task->delete();

        return redirect()->route('tasks.index', $userId)->with('success', 'Task deleted successfully.');
    }
}
