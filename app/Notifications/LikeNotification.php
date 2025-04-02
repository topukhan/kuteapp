<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LikeNotification extends Notification
{
    use Queueable;

    protected $sender;

    protected $post;

    protected $status;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $sender, Post $post, $status)
    {
        $this->sender = $sender;
        $this->post = $post;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'sender_name' => $this->sender->name,
            'sender_id' => $this->sender->id,
            'receiver_name' => $notifiable->name,
            'receiver_id' => $notifiable->id,
            'status' => $this->status,
            'post_id' => $this->post->id,
        ];
    }
}
