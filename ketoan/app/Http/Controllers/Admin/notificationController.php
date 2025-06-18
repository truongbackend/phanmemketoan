<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\notification;
use Illuminate\Http\Request;
use App\Models\Notifications;
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

        // Order theo created_at thay vì timestamp
        $notifications = Notifications::orderBy('created_at', 'desc')
                                     ->paginate($perPage);

        return response()->json($notifications);
    }

    public function show(Notifications $notification)
    {
        return response()->json($notification);
    }
    public function markAsRead(Notifications $notification)
    {
        $notification->is_read = true;
        $notification->save();

        return response()->json(['message' => 'Notification marked as read.']);
    }
    public function destroy(Notifications $notification)
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

        $notification = Notifications::create([
            'type' => $request->type,
            'content' => $request->content,
            'is_read' => false,
        ]);

        return response()->json($notification, 201); // 201 Created
    }
}
