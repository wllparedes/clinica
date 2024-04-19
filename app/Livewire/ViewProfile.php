<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ViewProfile extends Component
{

    public User $user;
    public $isAdmin = false;

    public function isAdmin()
    {
        return $this->user->role === 'admin' || $this->user->role === 'super_admin';
    }

    public function mount()
    {
        $this->user = auth()->user();
        $this->isAdmin = $this->isAdmin();
    }


    public function render()
    {
        return view('livewire.view-profile');
    }
}
