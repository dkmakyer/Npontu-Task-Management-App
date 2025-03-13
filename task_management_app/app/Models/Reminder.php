<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'reminder_time',
        'is_recurring',
        'recurrence_pattern',
    ];

    // A reminder belongs to a task
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
