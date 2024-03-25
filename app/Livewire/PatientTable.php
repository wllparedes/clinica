<?php

namespace App\Livewire;

use App\Models\User;
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

final class PatientTable extends PowerGridComponent
{
    use WithExport;

    public bool $deferLoading = true;

    public string $loadingComponent = 'components.loading';

    protected $listeners = ['patientCreated' => 'refresh'];

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
        $patient = User::where([
            'id' => $id,
            'role' => 'patient'
        ]);

        $patient->update([$field => $value]);
    }

    public function datasource(): Builder
    {
        return User::where('role', 'patient')->orderBy('id', 'desc');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('names')
            ->add('paternal')
            ->add('maternal')
            ->add('dni')
            ->add('phone_number')
            ->add('emergency_phone_number', function ($dish) {
                return $dish->emergency_phone_number ?? 'N/A';
            })
            // ->add('birth_date', function($dish) {
            //     return $dish->birth_date ?? 'N/A';
            // })
            ->add('nationality', function ($dish) {
                return $dish->nationality ?? 'N/A';
            })
            // ->add('address')
            ->add('gender', function ($dish) {
                return $dish->gender === 'M' ? __('Masculine') : __('Feminine');
            })
            ->add('email')
            // ->add('available')
            ->add('status');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make(__('Names'), 'names')
                ->sortable()
                ->searchable(),

            Column::make(__('Paternal'), 'paternal')
                ->sortable()
                ->searchable(),

            Column::make(__('Maternal'), 'maternal')
                ->sortable()
                ->searchable(),

            Column::make('Dni', 'dni')
                ->sortable()
                ->searchable(),

            Column::make(__('Phone number'), 'phone_number')
                ->sortable()
                ->searchable(),

            Column::make(__('Emergency phone number'), 'emergency_phone_number')
                ->sortable()
                ->searchable(),

            // Column::make(__('Birth date'), 'birth_date')
            //     ->sortable()
            //     ->searchable(),

            Column::make(__('Nationality'), 'nationality')
                ->sortable()
                ->searchable(),

            // Column::make(__('Address'), 'address')
            //     ->sortable()
            //     ->searchable(),

            Column::make(__('Gender'), 'gender')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            // Column::make('Available', 'available')
            //     ->sortable()
            //     ->searchable(),

            Column::make(__('Status'), 'status')
                ->toggleable(),

            // Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    // #[\Livewire\Attributes\On('edit')]
    // public function edit($rowId): void
    // {
    //     $this->js('alert(' . $rowId . ')');
    // }

    // public function actions(User $row): array
    // {
    //     return [
    //         Button::add('edit')
    //             ->slot('Edit: ' . $row->id)
    //             ->id()
    //             ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
    //             ->dispatch('edit', ['rowId' => $row->id])
    //     ];
    // }

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
