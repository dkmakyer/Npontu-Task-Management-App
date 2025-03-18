<?php

namespace App\View\Components;

use App\Models\Notification;
use App\Models\Task;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NotificationComponent extends Component
{
    /**
     * Create a new component instance.
     */

    public $id;
    public $notifications;
    public function __construct(int $id)
    {
        $this->id = $id;
        $user = User::with(relations: ['notifications', 'collaborators', 'tasks', 'completedTasks'])->find($this->id);
        $this->notifications = $user->notifications()->latest()->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.notification-component');
    }
}
