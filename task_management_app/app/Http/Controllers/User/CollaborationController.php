<?php

namespace App\Http\Controllers\User;

use App\Events\CollaborationEvent;
use App\Http\Controllers\Controller;
use App\Models\CollaborationNotification;
use App\Models\Collaborator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CollaborationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        try {
            $receipient = User::where('email', $request->email)->with(['notifications', 'collaborators', 'tasks', 'completedTasks'])->firstOrFail();
            if ($receipient) {
                if ($receipient->id != Auth::user()->id) {
                    $sender = User::with(relations: ['notifications', 'collaborators', 'tasks', 'completedTasks'])->find(Auth::user()->id);
                    event(new CollaborationEvent($sender, $request->email));
                } else {
                    dd('cannot send a collaboration request to yourself');
                }
            } else {
                dd('user not found');
            }
            return back();
        } catch (ModelNotFoundException $e) {
            dd($e->getMessage());
        }
    }

    public function showCollaborators()
    {
        $authUser = User::with(['collaborators', 'tasks', 'notifications', 'completedTasks'])->find(Auth::user()->id);
        $receipientOfCollaborationRequest = CollaborationNotification::where('receiver_email', $authUser->email)->get();

        $owners = $this->getOwners($authUser->id);

        return [$receipientOfCollaborationRequest, $owners];
    }

    public function acceptCollaboration(int $id)
    {
        $request = CollaborationNotification::find($id);
        $sender = $request->user_id;
        $receipient = User::where('email', $request->receiver_email)->with(['tasks', 'completedTasks', 'notifications', 'collaborators'])->first();

        try {
            $collaborator = Collaborator::where(['collaborated_by' => $receipient->id])->firstOrFail();
            $collaborator->users()->attach($sender);
            $request->delete();
            return back();
        } catch (ModelNotFoundException $e) {
            $collaborator = Collaborator::create(['collaborated_by' => $receipient->id]);
            $collaborator->users()->attach($sender);
            $request->delete();
            return back();
        }
    }

    public function rejectCollaboration(int $id)
    {
        CollaborationNotification::destroy($id);
        return back();
    }

    public function getOwners($id)
    {
        $collaborator = Collaborator::with(['users', 'user'])->where('collaborated_by', $id)->with(['user', 'users'])->first();

        if ($collaborator) {
            $owners = $collaborator->users;
            if ($owners->count()) {
                return $owners;
            }
        }
        return null;
    }
    public function leaveCollaboration(int $ownerId)
    {
        $owner = User::find($ownerId);
        try {
            $collaborator = Collaborator::with(['users', 'user'])->where('collaborated_by', Auth::user()->id)->firstOrFail();
            $owner->collaborators()->detach($collaborator->id);
            return back();
        } catch (MOdelNotFoundException $e) {
            return back()->with(['error' => 'Something unexpected happened']);
        }
    }
}
