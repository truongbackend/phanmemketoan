<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\notification;
use Illuminate\Http\Request;

class notificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $notifications = Notification::orderBy('timestamp', 'desc')->paginate($perPage);

        return response()->json($notifications);
    }

    public function show(Notification $notification)
    {
        return response()->json($notification);
    }
    public function markAsRead(Notification $notification)
    {
        $notification->is_read = true;
        $notification->save();

        return response()->json(['message' => 'Notification marked as read.']);
    }
    public function destroy(Notification $notification)
    {
        $notification->delete();

        return response()->json(['message' => 'Notification deleted successfully.']);
    }
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $notification = Notification::create([
            'type' => $request->type,
            'content' => $request->content,
            'is_read' => false, // New notifications are unread by default
        ]);

        return response()->json($notification, 201); // 201 Created
    }
}
