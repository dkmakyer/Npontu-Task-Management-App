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
        'priority',
        'category',
    ];

    protected $casts = ['due_date' => 'datetime'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImgUrl()
    {
        if ($this->image_url) {
            return url("storage/$this->image_url");
        } else {
            return url("https://api.dicebear.com/6.x/fun-emoji/svg?seed=$this->name");
        }
    }
}
