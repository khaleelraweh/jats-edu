<?php

namespace App\Http\Livewire\Backend\Topbar;

use Livewire\Component;

class NotificationComponent extends Component
{

    public $unreadNotificationsCount = '';

    public function mount()
    {
        $this->unreadNotificationsCount = auth()->user()->unreadNotifications->count();
    }

    public function render()
    {
        return view('livewire.backend.topbar.notification-component');
    }
}
