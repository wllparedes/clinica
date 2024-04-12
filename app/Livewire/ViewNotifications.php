<?php

namespace App\Livewire;

use App\Models\Notification;
use App\Models\User;
use Livewire\Component;

class ViewNotifications extends Component
{

    public $notifications = [];
    public User $user;

    public function loadNotifications()
    {
        $this->user = auth()->user();

        return  $this->user->notifications()->get();
    }

    public function mount()
    {
        $this->notifications = $this->loadNotifications();
    }

    public function markAsRead(Notification $notification)
    {
        $notification->update([
            'is_read' => 1
        ]);

        $this->notifications = $this->loadNotifications();
    }

    public function render()
    {
        return view('livewire.view-notifications');
    }
}
