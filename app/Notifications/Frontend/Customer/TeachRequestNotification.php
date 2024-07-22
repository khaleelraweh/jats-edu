<?php

namespace App\Notifications\Frontend\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TeachRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $teach_request;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($teach_request)
    {
        $this->teach_request = $teach_request;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'customer_id'           =>  $this->teach_request->user_id,
            'customer_name'         =>  $this->teach_request->full_name,
            'teach_request_id'      =>  $this->teach_request->id,
            'order_url'             =>  route('admin.teach_requests.show', $this->teach_request->id),
            'created_date'          =>  $this->teach_request->created_at->format('M d, Y'),
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'data'  => [
                'customer_id'           =>  $this->teach_request->user_id,
                'customer_name'         =>  $this->teach_request->full_name,
                'teach_request_id'      =>  $this->teach_request->id,
                'order_url'             =>  route('admin.teach_requests.show', $this->teach_request->id),
                'created_date'          =>  $this->teach_request->created_at->format('M d, Y'),
            ]
        ]);
    }
}
