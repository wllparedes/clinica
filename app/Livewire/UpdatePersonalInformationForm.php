<?php

namespace App\Livewire;

use App\Livewire\Forms\UpdateProfileInformationForm;
use App\Models\User;
use Livewire\Component;

class UpdatePersonalInformationForm extends Component
{

    public $nationalities = [];
    public User $user;
    public UpdateProfileInformationForm $updateForm;


    public function mount()
    {
        $this->user = auth()->user();

        $this->updateForm->dni = $this->user->dni;
        $this->updateForm->phone = $this->user->phone_number;
        $this->updateForm->phoneEmergency = $this->user->emergency_phone_number;
        $this->updateForm->address = $this->user->address;
        $this->updateForm->nationality = $this->user->nationality;
        $this->updateForm->gender = $this->user->gender;

        $this->nationalities = config('parameters.nationalities');
    }

    public function updateProfileInformation()
    {
        $this->updateForm->save($this->user);
        $this->dispatch('saved');
    }


    public function render()
    {
        return view('profile.update-personal-information-form');
    }
}
