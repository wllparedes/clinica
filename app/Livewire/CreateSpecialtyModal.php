<?php

namespace App\Livewire;

use App\Livewire\Forms\SpecialtyCreateForm;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use WireUi\Traits\Actions;

class CreateSpecialtyModal extends Component
{

    use Actions;

    public $open = false;

    public SpecialtyCreateForm $createForm;

    public function openModal()
    {
        $this->open = true;
    }

    public function save()
    {
        $this->createForm->save();

        $this->dispatch('specialtyCreated');

        $this->open = false;

        $this->notification()->success(
            $title = __('Specialty Created'),
            $message = __('The specialty has been created successfully.')
        );
    }

    public function render(): View
    {
        return view('livewire.create-specialty-modal');
    }
}
