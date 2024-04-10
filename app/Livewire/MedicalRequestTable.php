<?php

namespace App\Livewire;

use App\Models\MedicalRequest;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
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

    public $user;

    public function setUp(): array
    {
        $this->showCheckBox();

        $this->user = Auth::user();

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

        if ($this->user->role == 'doctor') {
            return MedicalRequest::where('doctor_id', $this->user->id)->with('appointment.patient');
        } elseif ($this->user->role == 'patient') {
            return MedicalRequest::whereHas('appointment', function ($query) {
                $query->where('patient_id', $this->user->id);
            });
        } elseif ($this->user->role == 'admin' || $this->user->role == 'super_admin' || $this->user->role == 'receptionist') {
            return MedicalRequest::with('doctor')->with('appointment.patient');
        }
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {

        $powerGrid = PowerGrid::fields()
            ->add('id')
            ->add('appointment_id')
            ->add('patient_name', function ($dish) {
                return $dish->appointment->patient->full_name;
            })
            ->add('date_formatted', fn (MedicalRequest $model) => Carbon::parse($model->date)->format('d/m/Y'))
            ->add('time')
            ->add('status', function ($dish) {
                return setStatus($dish);
            })
            ->add('created_at');


        if ($this->user->role !== 'doctor') {
            $powerGrid->add('doctor_names', function ($dish) {
                return $dish->doctor->full_name;
            });
        }

        return $powerGrid;
    }

    public function columns(): array
    {

        $columns = [
            Column::make('Id', 'id'),
            Column::make('Appointment id', 'appointment_id'),
            Column::make('Patient', 'patient_name')->searchable(),
        ];

        if ($this->user->role !== 'doctor') {
            array_push($columns, Column::make('Date', 'date_formatted', 'date')->sortable());
        }

        array_push(
            $columns,
            Column::make('Date', 'date_formatted', 'date')->sortable(),
            Column::make(__('Time'), 'time')
                ->sortable()
                ->searchable(),
            Column::make(__('Status'), 'status')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable()
        );

        return $columns;
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
