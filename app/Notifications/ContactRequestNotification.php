<?php

namespace App\Notifications;

use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ContactRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private Property $property, private array $data)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', "database"];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Vous avez une nouvelle demande de contact.')
            ->action('Voir la notification', url('/'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            "property_id" => $this->property->id,
            "title" => $this->property->title,
            "notification_title" => "Demande de Contact",
            "notification_description" => "Nouvelle demande de contact",
            ...$this->data,
        ];
    }
}
