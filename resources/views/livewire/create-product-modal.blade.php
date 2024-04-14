<div>
    <x-button icon="puzzle" teal label="{{ __('Create a new product') }}" wire:click="openModal" />

    <x-modal.card title="{{ __('Create a new product') }}" blur wire:model.defer="open">

        <x-errors class="mb-5" />

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <x-input label="{{ __('Name') }}" placeholder="{{ __('Enter the name') }}"
                wire:model.live='createForm.name' />

            <div class="col-span-1 sm:col-span-2">

                <x-textarea wire:model.live="createForm.description" label="{{ __('Description') }}"
                    placeholder="{{ __('Enter the description') }}" />

            </div>

            <x-input label="{{ __('Stock') }}" type="number" placeholder="{{ __('Enter the stock') }}"
                wire:model.live='createForm.stock' />

            <x-input label="{{ __('Price') }}" placeholder="{{ __('Enter the price') }}"
                wire:model.live='createForm.price' />

            <div class="col-span-1 sm:col-span-2">
                <x-select label="{{ __('Select a category') }}" wire:model.live="createForm.category_id"
                    placeholder="{{ __('Select a category') }}" :async-data="route('api.categories')" option-label="name"
                    option-value="id" />
            </div>

            @if ($createForm->category_id)
                <div class="col-span-1 sm:col-span-2">
                    <x-select label="{{ __('Select a Sub category') }}" wire:model.live="createForm.subcategory_id"
                        placeholder="{{ __('Select a Sub category') }}" :async-data="route('api.subCategories', $createForm->category_id)" option-label="name"
                        option-value="id" />
                </div>
            @endif

            <div class="col-span-1 sm:col-span-2">
                <input type="file" wire:model.live='createForm.image'>
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
