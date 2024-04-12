<?php

namespace App\Livewire;

use App\Livewire\Forms\MedicalRequestCreateForm;
use App\Models\MedicalRequest;
use App\Services\MedicalRequestService;
use Livewire\Component;
use WireUi\Traits\Actions;

class CreateMedicalRequestModal extends Component
{

    use Actions;


    public MedicalRequestCreateForm $createForm;

    public $open = false;
    public $appointmentInfo;
    public $states = [];

    public function openModal()
    {
        $this->open = true;
    }

    public function mount()
    {
        $this->states = config('parameters.states');
    }

    public function save()
    {
        $medicalRequest =  $this->createForm->save();

        if ($medicalRequest) {

            $this->createNotifications($medicalRequest);

            $this->dispatch('medicalRequestCreated');

            $this->open = false;

            $this->notification()->success(
                $title = __('Medical appointment created'),
                $description = __('The medical appointment has been created successfully'),
            );
        }
    }

    /**
     * Create notifications for the patient and the doctor.
     * $medicalRequest MedicalRequest
     * @return void
     */
    public function createNotifications(MedicalRequest $medicalRequest)
    {
        $medicalRequest->load('appointment', 'appointment.patient', 'doctor');

        $medicalRequest->appointment->patient->notifications()->create([
            'title' => 'You have a new medical appointment.',
            'description' => 'A new medical appointment has been assigned to you, check with details.',
            'type' => 'success',
        ]);

        $medicalRequest->doctor->notifications()->create([
            'title' => 'New medical appointment assigned to you.',
            'description' => 'A new medical appointment has been assigned to you, check with details.',
            'type' => 'success',
        ]);
    }

    public function render()
    {
        return view('livewire.create-medical-request-modal');
    }
}
