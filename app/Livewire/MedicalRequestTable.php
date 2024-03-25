<?php

namespace App\Livewire;

use App\Models\MedicalRequest;
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
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class MedicalRequestTable extends PowerGridComponent
{
    use WithExport;

    public bool $deferLoading = true;

    public string $loadingComponent = 'components.loading';

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
        ];
    }

    public function datasource(): Builder
    {
        $user = auth()->user();

        if ($user->role == 'doctor') {
            return MedicalRequest::where('doctor_id', $user->id);
        } elseif ($user->role == 'patient') {
            return MedicalRequest::whereHas('appointment', function ($query) use ($user) {
                $query->where('patient_id', $user->id);
            });
        } elseif ($user->role == 'admin' || $user->role == 'super_admin') {
            return MedicalRequest::query();
        }
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('appointment_id')
            ->add('doctor_id')
            ->add('date_formatted', fn (MedicalRequest $model) => Carbon::parse($model->date)->format('d/m/Y'))
            ->add('time')
            ->add('status')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Appointment id', 'appointment_id'),
            Column::make('Doctor id', 'doctor_id'),
            Column::make('Date', 'date_formatted', 'date')
                ->sortable(),

            Column::make('Time', 'time')
                ->sortable()
                ->searchable(),

            Column::make(__('Status'), 'status')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable()

            // Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('date'),
        ];
    }

    // #[\Livewire\Attributes\On('edit')]
    // public function edit($rowId): void
    // {
    //     $this->js('alert(' . $rowId . ')');
    // }

    // public function actions(MedicalRequest $row): array
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
