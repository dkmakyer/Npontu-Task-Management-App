<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $tasks = $user->tasks()->latest()->where('status', '!=', 'completed')->get();
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


        // dd('validation has no errors');
        $imagePath = $request->hasFile('image') ? $request->file('image')->store('profile', 'public') : '';
        $user = User::where('id', $id)->with('tasks')->first();
        try {
            $user->tasks()->create([
                'title' => $request->title,
                'description' => $request->description,
                'image_url' => $imagePath,
                'priority' => $request->priority,
                'due_date' => $request->date,
                'category' => $request->category
            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
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
        $result = $user->tasks()->latest()->where(column: 'title', operator: 'LIKE', value: "%$request->search%")->get();
        $response = $result->count() ? $result : "Task not found";
        return back()->with(['result' => $result]);
    }

    public function showTaskDetails(int $id)
    {
        $task = Task::find($id);
        return back()->with(['selectedTask' => $task]);
    }
}
