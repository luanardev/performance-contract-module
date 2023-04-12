<?php

namespace Lumis\PerformanceContract\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Lumis\PerformanceContract\Entities\Plan;

class PerformanceContractSubmission extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Plan
     */
    public Plan $plan;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Plan $plan)
    {
        $this->plan = $plan;
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
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->markdown('performancecontract::emails.performance_contract_submission', [
                'plan' => $this->plan
            ]);
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
