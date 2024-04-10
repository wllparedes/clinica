<div>
    <x-button icon="annotation" dark label="{{ __('Assign a medical appointment') }}" wire:click="openModal" />

    <x-modal.card title="{{ __('Assign a medical appointment') }}" blur wire:model.defer="open">

        <x-errors class="mb-5" />

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <div class="col-span-1 sm:col-span-2">
                <x-select label="Seleccione una solicitud de cita" wire:model.live="createForm.appointment_id"
                    wire:onSelect="loadAppointmentData" placeholder="Seleccione una solicitud de cita" :async-data="route('clinic.appointment.all')"
                    option-label="id" option-description="motive" option-value="id" />
            </div>

            <x-select label="Seleccione un doctor" wire:model.live="createForm.doctor_id"
                placeholder="Selecciona un doctor" :async-data="route('clinic.doctor.all')" option-label="names" option-value="id" />

            <x-datetime-picker label="Fecha y hora de la cita" placeholder="Fecha y hora de la cita"
                parse-format="YYYY-MM-DD HH:mm" wire:model="createForm.estimate" :min="now()" :max="now()->addDays(30)->hours(12)->minutes(30)" />

            <x-select label="Seleccione un estado" wire:model.live="createForm.status" :options="$states"
                placeholder="Seleccione un estado" option-label="label" option-value="value" />

        </div>

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <div class="flex">
                    <x-button flat label="Cancelar" x-on:click="close" />
                    <x-button info label="Guardar" wire:click="save" />
                </div>
            </div>
        </x-slot>
    </x-modal.card>

</div>
