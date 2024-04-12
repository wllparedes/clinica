<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateProfileInformationForm extends Form
{
    #[Validate('required')]
    public $dni;
    #[Validate('required|numeric|digits:9')]
    public $phone;
    #[Validate('required')]
    public $nationality;
    #[Validate('required|numeric|digits:9')]
    public $phoneEmergency;
    #[Validate('required')]
    public $address;
    #[Validate('required|in:M,W')]
    public $gender;

    public function save(User $user)
    {
        $this->validate();

        $user->update([
            'dni' => $this->dni,
            'phone_number' => $this->phone,
            'emergency_phone_number' => $this->phoneEmergency,
            'address' => $this->address,
            'nationality' => $this->nationality,
            'gender' => $this->gender
        ]);
    }
}
