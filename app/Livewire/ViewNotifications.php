<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Component;

class ViewNotifications extends Component
{

    public $notifications = [];
    public $user = null;

    public function loadNotifications()
    {
        $this->user = auth()->user();

        if ($this->user->role === 'doctor') {

            $notifications = Notification::whereHas('medicalRequest', function ($query) {
                $query->where('doctor_id', $this->user->id);
            })->get();
        } else if ($this->user->role === 'patient') {

            $notifications = Notification::whereHas('medicalRequest', function ($query) {
                $query->whereHas('appointment', function ($query) {
                    $query->where('patient_id', $this->user->id);
                });
            })->get();
        } else {
            $notifications = collect();
        }

        return $notifications;
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
