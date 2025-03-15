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

    // converting some of the fields in the table to specified types
    protected $casts = ['due_date' => 'datetime', 'date_completed' => 'datetime'];

    public function user()
    {
        // a task if for a user
        // this allows us to access the user who created a particular task
        return $this->belongsTo(User::class);
    }

    public function getImgUrl()
    {
        // getting the image url in the table
        // since it is nullable, 
        // we return a default picture when null
        if ($this->image_url) {
            return url("storage/$this->image_url");
        } else {
            return url("https://api.dicebear.com/9.x/adventurer/svg?seed=Chase");
        }
    }

    public function notifications()
    {
        // a particular task model can have numerous notifications
        // for example a task model can have a notification for completing a task 
        // and also a notification for creating a task 
        return $this->hasMany(Notification::class);
    }
}
