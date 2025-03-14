<?php

namespace App\Listeners;

use App\Events\TaskEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\GoogleCalendar\Event;

class UpdateCalendar
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
        if (!$event->data) {
            $calendarEvent = new Event;
            $calendarEvent->name = $event->task->title;
            $calendarEvent->startDateTime = $event->task->created_at;
            $calendarEvent->endDateTime = $event->task->due_date;
            $calendarEvent->save();
            $e = Event::get();
        }
    }
}
