<?php

namespace App\Http\Controllers\User;

use App\Events\CollaborationEvent;
use App\Http\Controllers\Controller;
use App\Models\CollaborationNotification;
use App\Models\Collaborator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
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
            $receipient = User::where('email', $request->email)->first();
            if ($receipient) {
                $sender = User::find(Auth::user()->id);
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
        $authUser = User::find(Auth::user()->id);
        $receipientOfCollaborationRequest = CollaborationNotification::where('receiver_email', $authUser->email)->get();

        $owners = $this->getOwners($authUser->id);

        if ($owners) {
            return view('user.collaboration', ['collaborationNotifications' => $receipientOfCollaborationRequest, 'owners' => $owners]);
        }
        return view('user.collaboration', ['collaborationNotifications' => $receipientOfCollaborationRequest, 'owners' => null]);
    }

    public function acceptCollaboration(int $id)
    {
        $request = CollaborationNotification::find($id);
        $sender = $request->user_id;
        $receipient = User::where('email', $request->receiver_email)->first();
        $collaborator = Collaborator::create(['user_id' => $receipient->id]);
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
        $collaborator = Collaborator::where('user_id', $id)->first();
        if ($collaborator) {
            $owners = $collaborator->users;
            if ($owners->count()) {
                return $owners;
            }
        }
        return null;
    }
}
