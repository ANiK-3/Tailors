<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as TailorRequest;
use App\Models\Status;
use App\Events\SendHireNotificationEvent;
use App\Events\RequestAcceptedEvent;
use App\Events\RequestDeclinedEvent;
use App\Jobs\CancelRequestJob;

class RequestController extends Controller
{
    public function sendHireNotification(Request $request)
    {
        $hireRequest = TailorRequest::create([
            'customer_id' => $request->customer_id,
            'tailor_id' => $request->tailor_id,
            'status_id' => Status::where('name', 'pending')->first()->id,
        ]);

        // send hire notification to the tailor
        event(new SendHireNotificationEvent($hireRequest));

        // job to cancel the request after 30 minutes if not accepted
        dispatch(new CancelRequestJob($hireRequest))->delay(now()->addMinutes(30));

        // return redirect()->back()->with('success', 'Hire notification sent, You\'ll be notified within 30 minutes.');
        return response()->json(['message' => 'Hire notification sent, You\'ll be notified within 30 minutes.']);
    }

    public function showRequest($id)
    {
        $request = TailorRequest::findOrFail($id);
        $customer = $request->customer;
        return view('tailor.tailor_request', compact('request', 'customer'));
    }

    public function acceptRequest($requestId)
    {
        $request = TailorRequest::find($requestId);
        $acceptedStatus = Status::where('name', 'accepted')->first();
        $request->update([
            'status_id' => $acceptedStatus->id
        ]);
        // $request->status_id = $acceptedStatus->id;
        // $request->save();

        event(new RequestAcceptedEvent($request));

        return redirect()->route('tailor.dashboard');

        // return redirect()->route('fabric_details', ['requestId' => $requestId]);
    }

    public function declineRequest($requestId, $message = "Request has been declined successfully.")
    {
        $request = TailorRequest::find($requestId);
        $declinedStatus = Status::where('name', 'declined')->first();
        $request->update([
            'status_id' => $declinedStatus->id
        ]);
        // $request->status_id = $declinedStatus->id;
        // $request->save();

        event(new RequestDeclinedEvent($request));

        return response()->json(['message' => $message]);
    }
}
