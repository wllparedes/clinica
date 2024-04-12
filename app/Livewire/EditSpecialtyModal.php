<?php

namespace App\Livewire;

use App\Livewire\Forms\SpecialtyEditForm;
use App\Models\Specialty;
use Livewire\Component;
use WireUi\Traits\Actions;

class EditSpecialtyModal extends Component
{
    use Actions;

    public SpecialtyEditForm $editForm;
    public Specialty $specialty;

    public $open = false;

    protected $listeners = ['editSpecialty' => 'openModal'];

    public function openModal(Specialty $specialty)
    {
        $this->specialty = $specialty;
        $this->editForm->name = $specialty->name;
        $this->editForm->description = $specialty->description;

        $this->open = true;
    }

    public function update()
    {
        $this->editForm->update($this->specialty);

        $this->dispatch('specialtyUpdated');

        $this->open = false;

        $this->notification()->success(
            $title = __('Specialty Updated'),
            $message = __('The specialty has been updated successfully.')
        );
    }

    public function render()
    {
        return view('livewire.edit-specialty-modal');
    }
}
