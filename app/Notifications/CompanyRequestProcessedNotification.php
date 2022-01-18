<?php

namespace App\Notifications;

use App\Models\CompanyRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompanyRequestProcessedNotification extends Notification
{
    use Queueable;

    public $companyRequest;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(CompanyRequest $companyRequest)
    {
        $this->companyRequest = $companyRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail()
    {
        return (new MailMessage)
            ->subject('Company Request Processed Notification')
            ->line('You are receiving this email because we processed a company request that you submitted.')
            ->line(sprintf('Company name: %s, Company domain: %s', $this->companyRequest->name, $this->companyRequest->domain))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
