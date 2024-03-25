<?php

namespace App\Livewire;

use App\Models\AppointmentRequest;
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

final class AppointmentRequestTable extends PowerGridComponent
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

    public function datasource(): Builder
    {
        return AppointmentRequest::where('patient_id', auth()->id())
            ->with('user')
            ->orderBy('created_at', 'desc');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('estimated_datetime')
            ->add('is_urgent', function ($dish) {
                return $dish->is_urgent ? __('Yes') : __('No');
            })
            ->add('comment')
            ->add('status', function ($dish) {
                return match ($dish->status) {
                    'pending' => __('Pending'),
                    'approved' => __('Approved'),
                    'rejected' => __('Rejected'),
                    default => __('Unknown')
                };
            })
            ->add('motive')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),

            Column::make(__('Estimated datetime'), 'estimated_datetime')
                ->sortable()
                ->searchable(),

            Column::make(__('Is urgent'), 'is_urgent')
                ->sortable()
                ->searchable(),

            Column::make(__('Comment'), 'comment')
                ->sortable()
                ->searchable(),

            Column::make(__('Status'), 'status')
                ->sortable()
                ->searchable(),


            Column::make(__('Motive'), 'motive')
                ->sortable()
                ->searchable(),

            Column::make(__('Created at'), 'created_at')
                ->sortable()
                ->searchable(),

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

    // public function actions(AppointmentRequest $row): array
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
