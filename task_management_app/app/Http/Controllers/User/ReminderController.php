<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reminder;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::with('task')->whereHas('task', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        return view('reminders.index', compact('reminders'));
    }

    public function create()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return view('reminders.create', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'reminder_time' => 'required|date',
            'is_recurring' => 'boolean',
            'recurrence_pattern' => 'nullable|string',
        ]);

        $task = Task::findOrFail($request->task_id);
        if ($task->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized access to this task.');
        }

        Reminder::create([
            'task_id' => $request->task_id,
            'reminder_time' => $request->reminder_time,
            'is_recurring' => $request->is_recurring,
            'recurrence_pattern' => $request->recurrence_pattern,
        ]);

        return redirect()->route('reminders.index')->with('success', 'Reminder created successfully.');
    }

    public function show(Reminder $reminder)
    {
        if ($reminder->task->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized access to this reminder.');
        }

        return view('reminders.show', compact('reminder'));
    }

    public function edit(Reminder $reminder)
    {
        if ($reminder->task->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized access to this reminder.');
        }

        $tasks = Task::where('user_id', Auth::id())->get();
        return view('reminders.edit', compact('reminder', 'tasks'));
    }

    public function update(Request $request, Reminder $reminder)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'reminder_time' => 'required|date',
            'is_recurring' => 'boolean',
            'recurrence_pattern' => 'nullable|string',
        ]);

        $task = Task::findOrFail($request->task_id);
        if ($task->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized access to this task.');
        }

        $reminder->update($request->all());

        return redirect()->route('reminders.index')->with('success', 'Reminder updated successfully.');
    }

    public function destroy(Reminder $reminder)
    {

        if ($reminder->task->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized access to this reminder.');
        }

        $reminder->delete();
        return redirect()->route('reminders.index')->with('success', 'Reminder deleted successfully.');
    }
}
