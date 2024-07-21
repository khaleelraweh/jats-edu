<?php

namespace App\Notifications\Frontend\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestTeachNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $request_teach;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request_teach)
    {
        $this->request_teach = $request_teach;
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
            'customer_id'   =>  $this->request_teach->user_id,
            'customer_name' =>  $this->request_teach->full_name,
            'request_to_teaches_id'      =>  $this->request_teach->id,
            'request_teach_url'     =>  route('admin.orders.show', $this->request_teach->id),
            'created_date'    =>  $this->request_teach->created_at->format('M d, Y'),
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'data'  => [
                'customer_id'   =>  $this->request_teach->user_id,
                'customer_name' =>  $this->request_teach->full_name,
                'request_to_teaches_id'      =>  $this->request_teach->id,
                'request_teach_url'     =>  route('admin.orders.show', $this->request_teach->id),
                'created_date'    =>  $this->request_teach->created_at->format('M d, Y'),
            ]
        ]);
    }
}
