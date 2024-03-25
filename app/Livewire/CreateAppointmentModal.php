<?php

namespace App\Livewire;

use App\Livewire\Forms\AppointmentCreateForm;
use Livewire\Component;
use WireUi\Traits\Actions;

class CreateAppointmentModal extends Component
{

    use Actions;

    public $open = false;

    public AppointmentCreateForm $createForm;

    public function openModal()
    {
        $this->open = true;
    }

    public function save()
    {
        $this->createForm->save();

        $this->dispatch('appointmentCreated');

        $this->open = false;

        $this->notification()->success(
            $title = __('Appointment created'),
            $description = __('The appointment has been created successfully'),
        );
        
    }


    public function render()
    {
        return view('livewire.create-appointment-modal');
    }
}
