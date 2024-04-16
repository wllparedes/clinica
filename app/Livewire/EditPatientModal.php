<?php

namespace App\Livewire;

use App\Livewire\Forms\PatientEditForm;
use App\Models\User;
use Livewire\Component;
use WireUi\Traits\Actions;

class EditPatientModal extends Component
{
    use Actions;

    public PatientEditForm $editForm;
    public User $patient;
    public $open = false;

    protected $listeners = ['editPatient' => 'openModal'];

    public function openModal(User $patient)
    {

        $this->patient = $patient;
        $this->editForm->names = $patient->names;
        $this->editForm->paternal = $patient->paternal;
        $this->editForm->maternal = $patient->maternal;
        $this->editForm->dni = $patient->dni;
        $this->editForm->phoneNumber = $patient->phone_number;
        $this->editForm->email = $patient->email;
        $this->editForm->gender = $patient->gender;

        $this->open = true;
    }

    public function update()
    {
        $this->editForm->update($this->patient);

        $this->open = false;

        $this->dispatch('patientUpdated');

        $this->notification()->success(
            $title = __('Patient Updated'),
            $message = __('The patient has been updated successfully.')
        );
    }


    public function render()
    {
        return view('livewire.edit-patient-modal');
    }
}
