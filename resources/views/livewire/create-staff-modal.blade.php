<div>
    <x-button icon="users" teal label="{{ __('Create a new staff') }}" wire:click="openModal" />

    <x-modal.card title="{{ __('Create a new staff') }}" blur wire:model.defer="open">

        <x-errors class="mb-5" />

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <x-input label="{{ __('Names') }}" placeholder="{{ __('Enter the names') }}"
                wire:model.live='createForm.names' />

            <x-input label="{{ __('Paternal') }}" placeholder="{{ __('Enter paternal surnames') }}"
                wire:model.live='createForm.paternal' />

            <x-input label="{{ __('Maternal') }}" placeholder="{{ __('Enter maternal surnames') }}"
                wire:model.live='createForm.maternal' />

            <x-input label="{{ __('DNI') }}" placeholder="{{ __('Enter the DNI') }}"
                wire:model.live='createForm.dni' />

            <x-inputs.phone label="{{ __('Phone number') }}" mask="['+51 ###-###-###']"
                placeholder="{{ __('Enter the phone number') }}" wire:model.live='createForm.phoneNumber' />

            <x-input label="{{ __('Email') }}" placeholder="{{ __('Enter the email') }}"
                wire:model.live='createForm.email' />

            <x-select label="{{ __('Select a role') }}" placeholder="{{ __('Select a role') }}" :options="$roles"
                option-value="id" option-label="name" wire:model.live="createForm.role" />

            <x-inputs.password label="{{ __('Password') }}" placeholder="{{ __('Enter the password') }}"
                wire:model.live='createForm.password' />

            <div class="flex gap-3 items-center">

                <x-radio id="man" left-label="{{ __('Male') }}" value="M"
                    wire:model="createForm.gender" />
                <x-radio id="women" left-label="{{ __('Female') }}" value="W"
                    wire:model="createForm.gender" />

            </div>

            <x-toggle wire:model.defer="createForm.status" checked />

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
