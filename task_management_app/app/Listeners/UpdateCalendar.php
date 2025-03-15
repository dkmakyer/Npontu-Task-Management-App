<?php

namespace App\Listeners;

use App\Events\CalendarEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\GoogleCalendar\Event;
use Exception;

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
    public function handle(CalendarEvent $event): void
    {

        try {
            $calendarEvent = new Event;
            $calendarEvent->name = $event->task->title;
            $calendarEvent->startDateTime = $event->task->created_at;
            $calendarEvent->endDateTime = $event->task->due_date;
            $calendarEvent->save();
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
