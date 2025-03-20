<?php

namespace App\View\Components;

use App\Http\Controllers\User\CollaborationController;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class CollaborationNotificationComponent extends Component
{
    /**
     * Create a new component instance.
     */

    public $owners, $collaborationNotification;
    public function __construct()
    {
        $collaborationController = new CollaborationController;
        $userAndOwnerArray = $collaborationController->showCollaborators();
        $this->collaborationNotification = $userAndOwnerArray[0];
        $this->owners = $userAndOwnerArray[1];
    }



    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.collaboration-notification-component');
    }
}
