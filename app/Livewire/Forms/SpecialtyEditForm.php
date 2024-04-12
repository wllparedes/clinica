<?php

namespace App\Livewire\Forms;

use App\Models\Specialty;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SpecialtyEditForm extends Form
{

    #[validate('required|max:150')]
    public $name;
    #[validate('max:255')]
    public $description;

    public function update(Specialty $specialty): void
    {
        $this->validate();

        $specialty->update([
            'name' => $this->name,
            'description' => $this->description
        ]);

        $this->reset();
    }
}
