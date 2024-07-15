<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\SendHireNotification;
use App\Events\HireAcceptedEvent;
use App\Models\User;
use App\Models\Tailor;

class HireController extends Controller
{
    public function send($id)
    {
        broadcast(new SendHireNotification($id, "Notification from customer"));

        $tailor = Tailor::where('user_id', $id)->get(['id'])->first();
        return redirect()->route('tailor.show', $tailor->id)->with('success', 'You will will notified within 30 minutes.');
    }

    public function responseHire(Request $request, $id)
    {
        $tailor = Auth::user();
        $acceptedUser = User::find(3); //* static vale

        $message = "Your request has been accepted by {$acceptedUser->name}.";

        event(new HireAcceptedEvent($tailor->id, $message));

        return response()->json(['message' => 'Hire request accepted']);
    }
}
