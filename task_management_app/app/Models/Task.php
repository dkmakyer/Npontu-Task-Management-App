<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'user_id',
        'description',
        'image_url',
        'due_date',
        'date_completed',
        'category',
        'priority',
        'completed',
    ];

    protected $casts = ['due_date' => 'datetime', 'date_completed' => 'datetime'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImgUrl()
    {
        if ($this->image_url) {
            return url("storage/$this->image_url");
        } else {
            return url("https://api.dicebear.com/9.x/adventurer/svg?seed=Chase");
        }
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
