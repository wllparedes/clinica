<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ViewProfile extends Component
{

    public $open = false;
    public User $user;
    public $isAdmin = false;

    public function isAdmin()
    {
        return $this->user->role === 'admin' || $this->user->role === 'super_admin';
    }

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function close()
    {
        $this->open = false;
    }


    public function render()
    {
        return view('livewire.view-profile');
    }
}
