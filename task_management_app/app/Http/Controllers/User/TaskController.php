<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
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
        $user = User::where('id', $id)->with('tasks')->first();
        $user->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $imagePath,
            'priority' => $request->priority,
            'due_date' => $request->date,
        ]);

        return back();
    }
}
