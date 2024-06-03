<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminToUser extends Notification
{
    use Queueable;

    public $title;
    public $message_type;
    public $icon;
    public $body;

    public function __construct($title, $message_type, $icon, $body)
    {
        $this->title = $title;
        $this->message_type = $message_type;
        $this->icon = $icon;
        $this->body = $body;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => $this->title,
            'message_type' => $this->message_type,
            'icon' => $this->icon,
            'body' => $this->body
        ];
    }
}
