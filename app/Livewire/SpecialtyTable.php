<?php

namespace App\Livewire;

use App\Models\Specialty;
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

final class SpecialtyTable extends PowerGridComponent
{
    use WithExport;
    use Actions;

    public bool $deferLoading = true;

    public string $loadingComponent = 'components.loading';

    protected $listeners = ['specialtyCreated' => 'refresh', 'specialtyUpdated' => 'refresh'];

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

    public function datasource(): Builder
    {
        return Specialty::orderBy('id', 'desc');
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
            ->add('created_at');
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

            Column::make(__('Created at'), 'created_at')
                ->sortable()
                ->searchable(),

            Column::action(__('Action'))
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $this->notification()->confirm([
            'title'       => __('Are you Sure?'),
            'description' => __('Delete this specialty?'),
            'acceptLabel' => __('Yes, delete it'),
            'method'      => 'deleteSpecialty',
            'params'      => $rowId,
            'reject' => [
                'label'  => __('Cancel'),
                'method' => 'cancel',
            ],
        ]);
    }

    public function deleteSpecialty(Specialty $specialty)
    {
        if ($specialty) {

            $specialty->delete();

            $this->notification()->success(__('The specialty has been deleted successfully.'));
        } else {

            $this->notification()->error(__('Specialty not found'));
        }
    }

    public function cancel(): void
    {
        $this->notification()->info(__('Operation canceled'));
    }


    public function actions(Specialty $row): array
    {
        return [
            Button::add('edit')
                ->slot('<x-icon name="pencil" class="w-5 h-5" />')
                ->id()
                ->class('pg-btn pg-btn-edit')
                ->dispatch('editSpecialty', [$row->id]),
            Button::add('delete')
                ->slot('<x-icon name="trash" class="w-5 h-5" />')
                ->id()
                ->class('pg-btn pg-btn-delete')
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
