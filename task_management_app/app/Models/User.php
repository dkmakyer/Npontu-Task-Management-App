<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Notification;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'social_id',
        'json_token',
        'image_url'
    ];

    // casting the token_json field to an array format when its being fetched
    protected $casts = [
        'token_json' => 'array'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tasks()
    {
        // a particular has many tasks 
        // for example a health task and an educational task belongs to one user model
        return $this->hasMany(Task::class);
    }

    public function completedTasks()
    {
        // we are getting the tasks that are completed by the user in an orderly manner
        return $this->hasMany(Task::class)->orderBy('date_completed', 'desc');
    }

    public function notifications()
    {
        // a user has many notifications through a task model 
        // that is we are trying to access all the notifications a user has recieved 
        // but a user is not directly related to a notification
        // he or she receives a notification because he or she has either created a task
        // or missed a due task for a task completion.
        return $this->hasManyThrough(Notification::class, Task::class);
    }

    public function collaborators()
    {
        return $this->belongsToMany(Collaborator::class);
    }
}
