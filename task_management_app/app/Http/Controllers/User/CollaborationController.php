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
            $receipient = User::where('email', $request->email)->with(['notifications', 'collaborators', 'tasks', 'completedTasks'])->first();
            if ($receipient) {
                $sender = User::with(relations: ['notifications', 'collaborators', 'tasks', 'completedTasks'])->find(Auth::user()->id);
                event(new CollaborationEvent($sender, $request->email));
            } else {
                dd('user not found');
            }
            return back();
        } catch (Exception $e) {
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
        $collaborator = Collaborator::create(['collaborated_by' => $receipient->id]);
        try {
            $collaborator->users()->attach($sender);
            $request->delete();
            return back();
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function getOwners($id)
    {
        // creating a collection instance representing the owners of a collaboration
        $owners = collect();
        $collaborators = Collaborator::where('collaborated_by', $id)->with(['user', 'users'])->get();

        if ($collaborators->count()) {
            foreach ($collaborators as $collaborator) {
                $owner = $collaborator->users;
                foreach ($owner as $manager) {
                    $owners->push($manager);
                }
            }
        }
        if ($owners->count()) {
            return $owners;
        }
        return null;
    }

    public function leaveCollaboration(int $ownerId)
    {
        $owner = User::find($ownerId);
        $collaborators = $owner->collaborators;

        foreach ($collaborators as $collaborator) {
            if ($collaborator->collaborated_by === Auth::user()->id) {
                Collaborator::destroy($collaborator->id);
                break;
            }
        }
        return back();
    }
}
