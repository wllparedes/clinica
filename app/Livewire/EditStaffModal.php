<?php

namespace App\Livewire;

use App\Livewire\Forms\StaffEditForm;
use App\Models\User;
use Livewire\Component;
use WireUi\Traits\Actions;

class EditStaffModal extends Component
{

    use Actions;

    public StaffEditForm $editForm;
    public User $staff;
    public $open = false;

    protected $listeners = ['editStaff' => 'openModal'];

    public function openModal(User $staff)
    {

        $this->staff = $staff;
        $this->editForm->names = $staff->names;
        $this->editForm->paternal = $staff->paternal;
        $this->editForm->maternal = $staff->maternal;
        $this->editForm->dni = $staff->dni;
        $this->editForm->phoneNumber = $staff->phone_number;
        $this->editForm->email = $staff->email;
        $this->editForm->gender = $staff->gender;

        $this->open = true;
    }

    public function update()
    {
        $this->editForm->update($this->staff);

        $this->open = false;

        $this->dispatch('staffUpdated');

        $this->notification()->success(
            $title = __('Staff Updated'),
            $message = __('The staff has been updated successfully.')
        );
    }


    public function render()
    {
        return view('livewire.edit-staff-modal');
    }
}
