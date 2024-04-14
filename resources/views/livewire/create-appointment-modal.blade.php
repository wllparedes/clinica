<div>
    <x-button icon="annotation" teal label="{{ __('Medical appointment request') }}" wire:click="openModal" />

    <x-modal.card title="{{ __('Medical appointment request') }}" blur wire:model.defer="open">

        <x-errors class="mb-5" />

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <div class="col-span-1 sm:col-span-2">
                <x-textarea wire:model.live="createForm.motive" label="{{ __('Motive') }}"
                    placeholder="{{ __('Write the reason for the query') }}" />
            </div>

            <x-datetime-picker label="{{ __('Date and time') }}" placeholder="{{ __('Estimated date and time') }}"
                parse-format="YYYY-MM-DD HH:mm" wire:model="createForm.datetimeNow" :min="now()"
                :max="now()->addDays(150)->hours(12)->minutes(30)" />

            <div class="col-span-1 sm:col-span-2">
                <x-textarea wire:model.live1="createForm.comment" label="{{ __('Commentary') }}"
                    placeholder="{{ __('Enter the commentary') }}" />
            </div>

            <div class="col-span-1 sm:col-span-2">
                <x-toggle left-label="{{ __('It is urgent?') }}" wire:model.live="createForm.isUrgent" />
            </div>

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
