<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
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

final class StaffTable extends PowerGridComponent
{
    use WithExport;

    use Actions;


    public bool $deferLoading = true;

    public string $loadingComponent = 'components.loading';

    protected $listeners = ['staffCreated' => 'refresh', 'staffUpdated' => 'refresh'];

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
        $staff = User::where('role', '!=', 'patient')
            ->where('id', $id);
        $staff->update([$field => $value]);
    }

    public function datasource(): Builder
    {
        return User::where('role', '!=', 'patient')->withCount('medicalRequests')->orderBy('id', 'desc');
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
            ->add('role', function ($dish) {
                return setRole($dish);
            })
            ->add('status')
            ->add('action');
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

            Column::make(__('Role'), 'role')
                ->sortable()
                ->searchable(),


            Column::make(__('Status'), 'status')
                ->toggleable(),

            Column::action(__('Action'), 'action')

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
            'description' => __('Delete this staff?'),
            'acceptLabel' => __('Yes, delete it'),
            'method'      => 'deleteStaff',
            'params'      => $rowId,
            'reject' => [
                'label'  => __('Cancel'),
                'method' => 'cancel',
            ],
        ]);
    }

    public function deleteStaff(User $staff)
    {
        if ($staff) {

            $staff->delete();

            $this->notification()->success(__('The staff has been deleted successfully.'));
        } else {

            $this->notification()->error(__('Staff not found'));
        }
    }


    public function cancel(): void
    {
        $this->notification()->info(__('Operation canceled'));
    }


    public function actions(User $row): array
    {

        $actions = [
            Button::add('edit')
                ->slot('<x-icon name="pencil" class="w-5 h-5" />')
                ->id()
                ->class('pg-btn pg-btn-edit')
                ->dispatch('editStaff', [$row->id]),
        ];

        if ($row->medical_requests_count === 0) {
            array_push($actions, Button::add('delete')
                ->slot('<x-icon name="trash" class="w-5 h-5" />')
                ->id()
                ->class('pg-btn pg-btn-delete')
                ->dispatch('delete', [$row->id]));
        }

        return $actions;
    }
}
