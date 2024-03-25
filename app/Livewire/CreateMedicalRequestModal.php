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
        $this->states = [
            ['label' => __('Pending'), 'value' => 'pending'],
            ['label' => __('Approved'), 'value' => 'approved'],
            ['label' => __('Rejected'), 'value' => 'rejected'],
        ];
    }


    public function save()
    {
        $this->createForm->save();
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
