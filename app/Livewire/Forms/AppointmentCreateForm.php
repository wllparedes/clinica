<?php

namespace App\Livewire\Forms;

use App\Models\AppointmentRequest;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AppointmentCreateForm extends Form
{
    #[Validate('required|max:6000')]
    public $motive;
    #[Validate('required|max:6000')]
    public $comment;
    #[Validate('required')]
    public $isUrgent = false;
    #[Validate('required')]
    public $datetimeNow;

    public function mount()
    {
        $this->datetimeNow = getCurrentDateTime();
    }

    public function save(): void
    {
        $this->validate();

        AppointmentRequest::create([
            'motive' => $this->motive,
            'comment' => $this->comment,
            'is_urgent' => $this->isUrgent,
            'estimated_datetime' => $this->datetimeNow,
            'status' => 'pending',
            'patient_id' => auth()->id(),
        ]);

        $this->reset();
    }
}
