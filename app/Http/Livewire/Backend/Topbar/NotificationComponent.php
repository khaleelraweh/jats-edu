<?php

namespace App\Http\Livewire\Backend\Topbar;

use Livewire\Component;

class NotificationComponent extends Component
{

    public $unreadNotificationsCount = '';
    public $unreadNotifications;

    public function mount()
    {
        $this->unreadNotificationsCount = auth()->user()->unreadNotifications->count();
        $this->unreadNotifications = auth()->user()->unreadNotifications;
    }

    public function render()
    {
        return view('livewire.backend.topbar.notification-component');
    }
}
