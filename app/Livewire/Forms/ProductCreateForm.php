<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use App\Services\FileService;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductCreateForm extends Form
{
    #[Validate('required')]
    public $name;
    public $description;
    #[Validate('required|numeric|integer|min:0|max:1000')]
    public $stock;
    #[Validate('required')]
    public $price;
    #[Validate('required')]
    public $status = 1;
    #[Validate('required|exists:categories,id')]
    public $category_id;
    #[Validate('required|exists:subcategories,id')]
    public $subcategory_id;
    #[Validate('required')]
    public $image;

    public $fileService;

    public function saveImage($product, $image, $category, $file, $storage, $belongsTo, $relation)
    {
        $this->fileService = new FileService();
        $this->fileService->store($product, $image, $category, $file, $storage, $belongsTo, $relation);
    }

    public function save()
    {
        $this->validate();

        $product = Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'stock' => $this->stock,
            'price' => $this->price,
            'status' => $this->status,
            'subcategory_id' => $this->subcategory_id,
        ]);

        $storage = env('FILESYSTEM_DISK');

        if ($this->image) {

            $this->saveImage($product, 'images', 'products', $this->image, $storage, 'products', 'one_one');
        }


        $this->reset();
    }
}
