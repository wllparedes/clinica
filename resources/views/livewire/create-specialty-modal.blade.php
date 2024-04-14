<div>
    <x-button icon="academic-cap" teal label="{{ __('Create a new specialty') }}" wire:click="openModal" />

    <x-modal.card title="{{ __('Create a new specialty') }}" blur wire:model.defer="open">

        <x-errors class="mb-5" />

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <x-input label="{{ __('Name') }}" placeholder="{{ __('Enter the name') }}"
                wire:model.live='createForm.name' />

            <div class="col-span-1 sm:col-span-2">

                <x-textarea wire:model.live="createForm.description" label="{{ __('Description') }}"
                    placeholder="{{ __('Enter the description') }}" />

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
