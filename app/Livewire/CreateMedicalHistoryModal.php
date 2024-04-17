<?php

namespace App\Livewire;

use App\Livewire\Forms\MedicalHistoryCreateForm;
use App\Models\MedicalHistory;
use App\Models\MedicalRequest;
use Livewire\Component;
use WireUi\Traits\Actions;

class CreateMedicalHistoryModal extends Component
{
    use Actions;

    public $open = false;
    public $haveHistory = false;
    public MedicalHistory $medicalHistory;
    public MedicalRequest $medicalRequest;
    public MedicalHistoryCreateForm $createForm;


    public function haveMedicalHistory()
    {
        if ($this->haveHistory) {
            $this->medicalHistory = $this->medicalRequest->medicalHistory;
        }
    }

    public function mount(MedicalRequest $medicalRequest)
    {
        $this->medicalRequest = $medicalRequest;
        $this->haveHistory = $medicalRequest->medicalHistory()->exists();
        $this->haveMedicalHistory();
    }


    public function openModal()
    {
        $this->open = true;
    }

    public function save()
    {
        $this->createForm->save($this->medicalRequest);
        $this->open = false;
        $this->notification()->success(
            $title = __('Medical history created'),
            $message = __('The medical history has been created successfully.'),
        );
        $this->haveHistory = $this->medicalRequest->medicalHistory()->exists();
        $this->haveMedicalHistory();
    }

    public function render()
    {
        return view('livewire.create-medical-history-modal');
    }
}
