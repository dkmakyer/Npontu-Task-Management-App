<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $tasks = $user->tasks()->where('status', '!=', 'completed')->get();
        $completedTasks = $user->tasks->where('status', 'completed');
        return view('user.dashboard', ['tasks' => $tasks, 'completedTasks' => $completedTasks]);
    }
}
