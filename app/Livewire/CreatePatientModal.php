<?php

namespace App\Livewire;

use App\Livewire\Forms\PatientCreateForm;
use Livewire\Component;
use WireUi\Traits\Actions;

class CreatePatientModal extends Component
{

    use Actions;

    public $open = false;

    public PatientCreateForm $createForm;

    public function save()
    {
        $this->createForm->save();

        $this->dispatch('staffCreated');

        $this->open = false;

        $this->notification()->success(
            $title = __('Staff created'),
            $description = __('The staff has been created successfully'),
        );
    }

    public function openModal()
    {
        $this->open = true;
    }

    public function render()
    {
        return view('livewire.create-patient-modal');
    }
}
