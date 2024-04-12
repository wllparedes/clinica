<?php

namespace App\Livewire;

use App\Livewire\Forms\ProductCreateForm;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class CreateProductModal extends Component
{

    use Actions;
    use WithFileUploads;

    public $open = false;

    public ProductCreateForm $createForm;

    public function openModal()
    {
        $this->open = true;
    }

    public function save()
    {
        $this->createForm->save();

        $this->open = false;

        $this->notification()->success(
            $title = __('Product created'),
            $description = __('The product has been created successfully.'),
        );

        $this->dispatch('productCreated');
    }

    public function render()
    {
        return view('livewire.create-product-modal');
    }
}
