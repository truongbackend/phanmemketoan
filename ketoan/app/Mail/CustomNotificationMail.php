<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\CustomNotification;
class CustomNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $notification;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CustomNotification $notification)
    {
        $this->notification = $notification;
    }

    public function build()
    {
        return $this->subject('Thông báo mới: ' . $this->notification->title)
                    ->markdown('emails.custom-notification')
                    ->with(['notification' => $this->notification]);
    }

}
