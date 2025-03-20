<?php

namespace App\Listeners;

use App\Events\CalendarEvent;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\GoogleCalendar\Event;
use Exception;
use Illuminate\Support\Facades\Auth;

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
        $user = User::find(Auth::user()->id);
        if ($user->social_id != null) {
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
}
