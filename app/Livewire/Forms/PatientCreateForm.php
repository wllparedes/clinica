<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PatientCreateForm extends Form
{
    #[Validate('required')]
    public $names;
    #[Validate('required')]
    public $paternal;
    #[Validate('required')]
    public $maternal;
    #[Validate('required|unique:users,dni')]
    public $dni;
    #[Validate('required')]
    public $phoneNumber;
    #[Validate('required|unique:users,email')]
    public $email;
    #[Validate('required|min:8|max:16|different:email')]
    public $password;
    public $gender = 'M';
    public $status = true;

    public function save()
    {
        $this->validate();

        User::create([
            'names' => $this->names,
            'paternal' => $this->paternal,
            'maternal' => $this->maternal,
            'dni' => $this->dni,
            'gender' => $this->gender,
            'phone_number' => $this->phoneNumber,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'patient',
            'status' => $this->status
        ]);

        $this->reset();
    }
}
