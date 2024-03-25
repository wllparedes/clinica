<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class MedicalRequestCreateForm extends Form
{
    #[Validate('required')]
    public $appointment_id;
    #[Validate('required')]
    public $doctor_id;
    #[Validate('required')]
    public $status;


    public function save()
    {
        $this->validate();


        // Execution doesn't reach here if validation fails.

        // Persist the medical request
    }
}
