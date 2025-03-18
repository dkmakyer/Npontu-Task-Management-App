<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class ViewTaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function edit(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }
}
