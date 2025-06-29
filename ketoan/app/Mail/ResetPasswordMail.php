<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $newPassword;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $newPassword)
    {
        $this->user = $user;
        $this->newPassword = $newPassword;
    }

    public function build()
    {
        return $this->subject('Mật khẩu mới của bạn')
                    ->markdown('emails.reset-password')
                    ->with([
                        'user' => $this->user,
                        'newPassword' => $this->newPassword,
                    ]);
    }
}
