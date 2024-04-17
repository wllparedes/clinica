<?php

namespace App\Livewire\Forms;

use App\Models\MedicalHistory;
use App\Models\MedicalRequest;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MedicalHistoryCreateForm extends Form
{
    #[Validate('required')]
    public $treatment;
    #[Validate('required')]
    public $diagnostic;
    #[Validate('required')]
    public $medication;
    #[Validate('required')]
    public $symptoms;
    #[Validate('required')]
    public $weight;
    #[Validate('required')]
    public $height;
    #[Validate('required')]
    public $temperature;


    public function save(MedicalRequest $medicalRequest): MedicalHistory
    {
        $this->validate();

        $medicalHistory  = $medicalRequest->medicalHistory()->create([
            'treatment' => $this->treatment,
            'diagnostic' => $this->diagnostic,
            'medication' => $this->medication,
            'symptoms' => $this->symptoms,
            'weight' => $this->weight,
            'height' => $this->height,
            'temperature' => $this->temperature,
        ]);

        $this->reset();


        return $medicalHistory;
    }
}
