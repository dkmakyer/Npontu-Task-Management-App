<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'user_id',
        'description',
        'image_url',
        'due_date',
        'status',
        'category',
        'priority',
        'category',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
