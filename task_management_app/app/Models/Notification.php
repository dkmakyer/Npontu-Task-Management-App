<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'title',
        'status',
        'task_id'
    ];

    public function task()
    {
        // a notification is for a task event
        return $this->belongsTo(Task::class);
    }
}
