<?php

namespace App\Http\Livewire\Frontend\Header;

use Livewire\Component;

class CustomerNotificationsComponent extends Component
{


    public $unreadNotificationsCount = '';
    public $unreadNotifications;

    public $activeTab = 'instructor'; // Default active tab

    // to refresh the notification count in realtime 
    public function getListeners(): array
    {
        $userId = auth()->id();
        return [
            "echo-notification:App.Models.User.{$userId},notification" => 'mount'
        ];
    }

    public function mount()
    {
        $this->unreadNotificationsCount = auth()->user()->unreadNotifications->count();
        $this->unreadNotifications = auth()->user()->unreadNotifications;
    }

    // to mark notification to readed on click on it 
    public function markAsRead($id)
    {
        $notification = auth()->user()->unreadNotifications->where('id', $id)->first();
        $notification->markAsRead();
        return redirect()->to($notification->data['order_url']);
    }

    public function render()
    {
        return view('livewire.frontend.header.customer-notifications-component');
    }
}
