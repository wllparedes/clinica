<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Responsive;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use WireUi\Traits\Actions;

final class ProductTable extends PowerGridComponent
{
    use WithExport;
    use Actions;


    public bool $deferLoading = true;

    public string $loadingComponent = 'components.loading';

    protected $listeners = ['productCreated' => 'refresh'];

    public function refresh(): void
    {
        $this->resetPage();
    }

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            // Exportable::make('export')
            //     ->striped()
            //     ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                ->showToggleColumns()
                ->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
            Responsive::make()
                ->fixedColumns('dishes.name', Responsive::ACTIONS_COLUMN_NAME),
        ];
    }

    public function onUpdatedToggleable(string|int $id, string $field, string $value): void
    {
        $product = Product::find($id);
        $product->update([$field => $value]);
    }

    public function datasource(): Builder
    {
        return Product::with('subcategory', 'subcategory.category')->orderBy('id', 'desc');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('description', function ($dish) {
                return $dish->description ?? '-';
            })
            ->add('price')
            ->add('stock')
            ->add('subcategory', function ($dish) {
                return $dish->subcategory->name;
            })
            ->add('category', function ($dish) {
                return $dish->subcategory->category->name;
            })
            ->add('status')
            ->add('action');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make(__('Name'), 'name')
                ->sortable()
                ->searchable(),

            Column::make(__('Description'), 'description')
                ->sortable()
                ->searchable(),

            Column::make(__('Price'), 'price')
                ->sortable()
                ->searchable(),

            Column::make(__('Stock'), 'stock')
                ->sortable()
                ->searchable(),

            Column::make(__('Subcategory'), 'subcategory'),

            Column::make(__('Category'), 'category'),

            Column::make(__('Status'), 'status')
                ->toggleable(),

            Column::action(__('Action'))
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {

        $this->notification()->confirm([
            'title'       => __('Are you Sure?'),
            'description' => __('Delete this product?'),
            'acceptLabel' => __('Yes, delete it'),
            'method'      => 'deleteProduct',
            'params'      => $rowId,
            'reject' => [
                'label'  => __('Cancel'),
                'method' => 'cancel',
            ],
        ]);
    }

    public function deleteProduct(Product $product): void
    {

        if ($product) {

            $product->delete();
            $this->notification()->success(__('The product has been deleted successfully.'));
        } else {

            $this->notification()->error(__('Product not found'));
        }
    }

    public function cancel(): void
    {
        $this->notification()->info(__('Operation canceled'));
    }

    public function actions(Product $row): array
    {
        return [
            Button::add('edit')
                ->slot('<x-icon name="pencil" class="w-5 h-5" />')
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id]),

            Button::add('delete')
                ->slot('<x-icon name="trash" class="w-5 h-5" />')
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('delete', ['rowId' => $row->id]),

        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
