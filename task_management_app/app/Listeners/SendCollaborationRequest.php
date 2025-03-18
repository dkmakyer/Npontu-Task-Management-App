<?php

namespace App\Listeners;

use App\Events\CollaborationEvent;
use App\Models\CollaborationNotification;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCollaborationRequest
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CollaborationEvent $event): void
    {
        $sender = User::find($event->sender->id);
        CollaborationNotification::create([
            'body' => "$sender->username just sent you a collaboration request",
            'user_id' => $sender->id,
            'receiver_email' => $event->receiverMail
        ]);
    }
}
