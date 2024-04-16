<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StaffEditForm extends Form
{
    #[Validate('required')]
    public $names;
    #[Validate('required')]
    public $paternal;
    #[Validate('required')]
    public $maternal;
    #[Validate('required')]
    public $dni;
    #[Validate('required')]
    public $phoneNumber;
    #[Validate('required')]
    public $email;
    #[Validate('required')]
    public $gender;


    public function update(User $staff)
    {

        $this->validate([
            'dni' => [Rule::unique('users', 'dni')->ignore($staff->id)],
            'email' => [Rule::unique('users', 'email')->ignore($staff->id)]
        ]);

        $staff->update([
            'names' => $this->names,
            'paternal' => $this->paternal,
            'maternal' => $this->maternal,
            'dni' => $this->dni,
            'phone_number' => $this->phoneNumber,
            'email' => $this->email,
            'gender' => $this->gender
        ]);

        $this->reset();
    }
}
