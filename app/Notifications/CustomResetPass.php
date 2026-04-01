<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPass extends Notification
{
    use Queueable;

    private $token;

    /**
     * Khởi tạo Notification với token reset
     *
     * @param string $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        // Tạo link reset với token + email người dùng
        $url = route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);

        return (new MailMessage)
            ->subject('🔐 Lấy lại mật khẩu - ' . config('app.name'))
            ->view('email_template.reset_pass', compact('url'));
    }
}