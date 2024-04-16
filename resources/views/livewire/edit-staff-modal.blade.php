<div>
    <x-modal.card title="{{ __('Edit staff') }}" blur wire:model.defer="open">

        <x-errors class="mb-5" />

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <x-input label="{{ __('Names') }}" placeholder="{{ __('Enter the names') }}"
                wire:model.live='editForm.names' />

            <x-input label="{{ __('Paternal') }}" placeholder="{{ __('Enter paternal surnames') }}"
                wire:model.live='editForm.paternal' />

            <x-input label="{{ __('Maternal') }}" placeholder="{{ __('Enter maternal surnames') }}"
                wire:model.live='editForm.maternal' />

            <x-input label="{{ __('DNI') }}" placeholder="{{ __('Enter the DNI') }}"
                wire:model.live='editForm.dni' />

            <x-inputs.phone label="{{ __('Phone number') }}" mask="['+51 ###-###-###']"
                placeholder="{{ __('Enter the phone number') }}" wire:model.live='editForm.phoneNumber' />

            <x-input label="{{ __('Email') }}" placeholder="{{ __('Enter the email') }}"
                wire:model.live='editForm.email' />

            <div class="flex gap-3 items-center">

                <x-radio id="man" left-label="{{ __('Male') }}" value="M" wire:model="editForm.gender" />
                <x-radio id="women" left-label="{{ __('Female') }}" value="W" wire:model="editForm.gender" />

            </div>

            {{-- <div class="col-span-1 sm:col-span-2">
                <div class="flex gap-3 items-center">
                    <x-toggle wire:model.defer="editForm.status" wire:click="changeLabelStatus"
                        wire:loading.attr="disabled" />
                    <span for="" class="text-xs">{{ $labelStatus }}</span>
                </div>
            </div> --}}

        </div>

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <div class="flex">
                    <x-button flat label="{{ __('Cancel') }}" x-on:click="close" />
                    <x-button teal label="{{ __('Update') }}" wire:click="update" />
                </div>
            </div>
        </x-slot>

    </x-modal.card>
</div>
