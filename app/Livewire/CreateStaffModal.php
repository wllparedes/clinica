<?php

namespace App\Livewire;

use App\Livewire\Forms\StaffCreateForm;
use Livewire\Component;
use WireUi\Traits\Actions;

class CreateStaffModal extends Component
{
    use Actions;

    public $open = false;

    public StaffCreateForm $createForm;

    public $roles = [];

    public function mount()
    {
        $this->roles = [
            [
                'name' => "Doctor",
                'id' =>  "doctor"
            ],
            [
                'name' => "Recepcionista",
                'id' =>  "receptionist"
            ],
            [
                'name' => "Administrador",
                'id' =>  "admin"
            ]
        ];
    }

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
        return view('livewire.create-staff-modal');
    }
}
