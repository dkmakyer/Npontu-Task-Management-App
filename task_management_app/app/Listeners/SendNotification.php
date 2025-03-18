<?php

namespace App\Listeners;

use App\Events\TaskEvent;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotification
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
    public function handle(TaskEvent $event): void
    {
        // to check if the task that is being passed is already in the notifications table 
        $notifications = Notification::with(['task'])->where('task_id', $event->task->id)->get();
        if (!$notifications->count()) {
            $event->task->notifications()->create([
                'title' => $event->data['message'],
            ]);
        }
    }
}
