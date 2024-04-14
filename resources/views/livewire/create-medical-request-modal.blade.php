<div>
    <x-button icon="annotation" teal label="{{ __('Assign a medical appointment') }}" wire:click="openModal" />

    <x-modal.card title="{{ __('Assign a medical appointment') }}" blur wire:model.defer="open">

        <x-errors class="mb-5" />

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <div class="col-span-1 sm:col-span-2">
                <x-select label="{{ __('Appointment request') }}" wire:model.live="createForm.appointment_id"
                    wire:onSelect="loadAppointmentData" placeholder="{{ __('Select an appointment request') }}"
                    :async-data="route('api.appointments')" option-label="id" option-description="motive" option-value="id" />
            </div>

            <x-select label="{{ __('Doctor') }}" wire:model.live="createForm.doctor_id"
                placeholder="{{ __('Select a doctor') }}" :async-data="route('api.doctors')" option-label="names" option-value="id" />

            <x-datetime-picker label="{{ __('Appointment date and time') }}"
                placeholder="{{ __('Select the date and time') }}" parse-format="YYYY-MM-DD HH:mm"
                wire:model="createForm.estimate" :min="now()" :max="now()->addDays(30)->hours(12)->minutes(30)" />

            <x-select label="{{ __('Status') }}" wire:model.live="createForm.status" :options="$states"
                placeholder="{{ __('Select a status') }}" option-label="label" option-value="value" />

        </div>

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <div class="flex">
                    <x-button flat label="{{ __('Cancel') }}" x-on:click="close" />
                    <x-button teal label="{{ __('Save') }}" wire:click="save" />
                </div>
            </div>
        </x-slot>
    </x-modal.card>

</div>
