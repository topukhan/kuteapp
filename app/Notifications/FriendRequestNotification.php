<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FriendRequestNotification extends Notification
{
    use Queueable;

    protected $sender;

    protected $accepted;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $sender, $accepted = false)
    {
        $this->sender = $sender;
        $this->accepted = $accepted;
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

    public function toDatabase($notifiable)
    {
        return [
            'sender_name' => $this->sender->name,
            'sender_id' => $this->sender->id,
            'receiver_name' => $notifiable->name, // Assuming the notifiable is the receiver user
            'receiver_id' => $notifiable->id,     // Assuming the notifiable is the receiver user
            'accepted' => $this->accepted,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
