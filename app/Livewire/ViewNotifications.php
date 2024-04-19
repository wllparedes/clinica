<?php

namespace App\Livewire;

use App\Models\Notification;
use App\Models\User;
use Livewire\Component;

class ViewNotifications extends Component
{

    public $notifications = [];
    public User $user;
    public $unReadCount;

    public function loadNotifications()
    {
        $this->user = auth()->user();

        return  $this->user->notifications()->orderBy('id', 'desc')->get();
    }

    public function mount()
    {
        $this->notifications = $this->loadNotifications();
        $this->unReadCount = $this->notifications->where('is_read', 0)->count();
    }

    public function markAsRead(Notification $notification)
    {
        $notification->update([
            'is_read' => 1
        ]);

        $this->notifications = $this->loadNotifications();
        $this->unReadCount = $this->notifications->where('is_read', 0)->count();
    }

    public function render()
    {
        return view('livewire.view-notifications');
    }
}
