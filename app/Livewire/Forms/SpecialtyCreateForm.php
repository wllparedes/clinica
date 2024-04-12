<?php

namespace App\Livewire\Forms;

use App\Models\Specialty;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SpecialtyCreateForm extends Form
{

    #[validate('required|max:150')]
    public $name;
    #[validate('max:255')]
    public $description;

    public function save(): void
    {
        $this->validate();

        Specialty::create([
            'name' => $this->name,
            'description' => $this->description
        ]);

        $this->reset();
    }
}
