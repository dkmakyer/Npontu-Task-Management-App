<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaborationNotification extends Model
{
    protected $table = 'collaboration_notifications';

    protected $fillable = ['body', 'user_id', 'receiver_email'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
