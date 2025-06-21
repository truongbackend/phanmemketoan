<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\notification;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification as NotificationFacade;
use App\Notifications\BroadcastNotification;
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
        $notifications = Notifications::orderBy('created_at', 'desc')
                                     ->paginate($perPage);

        return response()->json($notifications);
    }
    // app/Http/Controllers/Api/NotificationController.php

        public function store(Request $request)
        {
            // 1) Validate đủ 3 field: notification, content, type
            $data = $request->validate([
                'notification' => 'required|string|max:255',
                'content'      => 'required|string',
                'type'         => 'required|string', // hoặc 'required|integer' nếu bạn để type là số
            ]);

            // 2) Tạo record với cả 3 field
            $notification = Notifications::create($data);

            // 3) Trả về JSON
            return response()->json([
                'data'    => $notification,
                'message' => 'Notification created.'
            ], 201);
        }


    public function broadcast(Request $request)
    {
        $data = $request->validate([
            'notification_id' => 'required|integer|exists:notifications,id',
        ]);
        $notification = Notifications::findOrFail($data['notification_id']);
        $users = User::all();
        NotificationFacade::send($users, new BroadcastNotification($notification));
        return response()->json([
            'message' => 'Broadcast sent to all users.'
        ], 200);
    }
    public function markAllRead(Request $request)
    {
        $request->user()
            ->unreadNotifications
            ->markAsRead();

        return response()->json([
            'message' => 'All notifications marked as read.'
        ], 200);
    }

    public function markRead(Request $request, $id)
    {
        $notification = $request->user()
            ->unreadNotifications()
            ->where('id', $id)
            ->firstOrFail();

        $notification->markAsRead();

        return response()->json([
            'message' => 'Notification marked as read.'
        ], 200);
    }



}
