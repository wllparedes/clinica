<?php

namespace App\Livewire\Forms;

use App\Models\AppointmentRequest;
use App\Models\MedicalRequest;
use DateTime;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MedicalRequestCreateForm extends Form
{
    #[Validate('required|exists:appointment_requests,id')]
    public $appointment_id;
    #[Validate('required|exists:users,id')]
    public $doctor_id;
    #[Validate('required|in:pending,approved,rejected')]
    public $status;
    #[Validate('required')]
    public $estimate = '';

    public function save(): MedicalRequest
    {
        $this->validate();

        $appointmentRequest = AppointmentRequest::find($this->appointment_id);

        $dateTime = new DateTime($this->estimate);
        $time = $dateTime->format('H:i:s');
        $date = $dateTime->format('Y-m-d');

        $medicalRequest = $appointmentRequest->medicalRequest()->create([
            'doctor_id' => $this->doctor_id,
            'status' => $this->status,
            'time' => $time,
            'date' => $date,
        ]);

        $this->reset();

        return $medicalRequest;
    }
}
