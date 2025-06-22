<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\CustomNotification;

class NotificationCreated implements ShouldBroadcast
{
    public $notif;

    public function __construct(CustomNotification $notif)
    {
        $this->notif = $notif->loadCount([
            'recipients as unread_count' => fn($q)=>$q->whereNull('notification_user.read_at')
        ]);
    }

    public function broadcastOn()      { return new Channel('notifications'); }
    public function broadcastWith()    {
        return [
            'id'           => $this->notif->id,
            'title'        => $this->notif->title,
            'content'      => $this->notif->content,
            'type'         => $this->notif->type,
            'unread_count' => $this->notif->unread_count,
            'created_at'   => $this->notif->created_at->toDateTimeString(),
        ];
    }
}
