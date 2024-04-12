<?php

namespace App\Livewire;

use App\Livewire\Forms\MedicalRequestCreateForm;
use App\Models\AppointmentRequest;
use Livewire\Component;
use WireUi\Traits\Actions;

class CreateMedicalRequestModal extends Component
{

    use Actions;

    public $open = false;
    public $appointmentInfo;
    public $states = [];

    public MedicalRequestCreateForm $createForm;

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

            $medicalRequest->notifications()->create([
                'title' => __('New medical appointment with identifier: ') . $medicalRequest->id,
                'description' => __('A new medical appointment has been assigned to you, check with details.'),
                'type' => 'success',
            ]);

            $this->dispatch('medicalRequestCreated');

            $this->open = false;

            $this->notification()->success(
                $title = __('Medical appointment created'),
                $description = __('The medical appointment has been created successfully'),
            );
        }
    }

    // public function loadAppointmentData()
    // {
    //     dd('loadAppointmentData is running');

    //     $this->dispatchBrowserEvent('contentChanged');
    // }

    public function render()
    {
        return view('livewire.create-medical-request-modal');
    }
}
