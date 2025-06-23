<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomNotification;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Events\NotificationCreated;

class NotificationController extends Controller
{
    public function index(Request $req)
    {
        $perPage = $req->get('per_page',10);
        $pag = $req->user()
                   ->notifications()
                   ->withPivot('read_at')
                   ->orderBy('created_at','desc')
                   ->paginate($perPage);
        return response()->json($pag);
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'type'    => 'required|string',
        ]);

        $notif = null;
        DB::transaction(function() use($data, &$notif) {
            $notif = CustomNotification::create($data);

            $ids    = User::pluck('id')->all();
            $attach = array_fill(0, count($ids), ['read_at'=>null]);
            $notif->recipients()->sync(array_combine($ids, $attach));

            event(new NotificationCreated($notif));
        });
        return response()->json([
            'data'    => $notif,
            'message' => 'Created & broadcasted'
        ], 201);
    }

    public function update(Request $req, $id)
    {
        $data = $req->validate([
            'title'   => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'type'    => 'sometimes|string',
        ]);
        $notif = CustomNotification::findOrFail($id);
        $notif->update($data);
        event(new NotificationCreated($notif));
        return response()->json(['message'=>'Updated'],200);
    }

    public function destroy($id)
    {
        CustomNotification::findOrFail($id)->delete();
        return response()->json(['message'=>'Deleted'],200);
    }
    public function broadcast($id) {
        $notif = CustomNotification::findOrFail($id);
        // gán lại cho tất cả user với read_at = null
        $ids    = User::pluck('id')->all();
        $attach = array_fill(0, count($ids), ['read_at'=>null]);
        $notif->recipients()->syncWithoutDetaching(array_combine($ids,$attach));
        event(new NotificationCreated($notif));
        return response()->json(['message'=>'Re-broadcasted'],200);
    }


    public function markRead(Request $req, $id)
    {
        $req->user()
            ->notifications()
            ->updateExistingPivot($id, ['read_at'=>now()]);
        return response()->json(['message'=>'Marked read'],200);
    }
    public function markUnread(Request $req, $id)
    {
        $req->user()
            ->notifications()
            ->updateExistingPivot($id, ['read_at'=>null]);
        return response()->json(['message'=>'Marked unread'],200);
    }

    public function markAllRead(Request $req)
    {
        $req->user()
            ->notifications()
            ->newPivotStatement()
            ->where('user_id',$req->user()->id)
            ->update(['read_at'=>now()]);
        return response()->json(['message'=>'All marked read'],200);
    }
}
