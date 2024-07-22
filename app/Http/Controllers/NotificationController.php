<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    // Retrieve notifications for a user
    public function index(Request $request)
    {
        $notifications = Notification::where('user_id', $request->user_id)->where('is_read', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notifications);
    }

    // Store a new notification
    public function store(Request $request)
    {
        $notification = Notification::create([
            'user_id' => $request->user_id,
            'request_id' => $request->request_id,
            'message' => $request->message,
        ]);

        return response()->json($notification);
    }

    // Mark a notification as read
    public function markAsRead($id)
    {
        $notification = Notification::find($id);
        if ($notification) {
            $notification->update(['is_read' => true]);
        }

        return response()->json($notification);
    }
}
