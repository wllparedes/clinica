<div class="pt-4">

    @if (!$haveHistory)
        <x-button icon="calendar" teal label="{{ __('Assign a medical history') }}" wire:click="openModal" />

        <x-modal.card title="{{ __('Assign a medical history') }}" blur wire:model.defer="open">

            <x-errors class="mb-5" />

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <x-input label="{{ __('Weight') }} kg" placeholder="{{ __('Write the weight') }}"
                    wire:model.live='createForm.weight' />

                <x-input label="{{ __('Height') }} cm" placeholder="{{ __('Write the height') }}"
                    wire:model.live='createForm.height' />

                <x-input label="{{ __('Temperature') }} °C" placeholder="{{ __('Write the temperature') }}"
                    wire:model.live='createForm.temperature' />

                <div class="col-span-1 sm:col-span-2">
                    <x-textarea wire:model.live="createForm.symptoms" label="{{ __('Symptoms') }}"
                        placeholder="{{ __('Write the symptoms') }}" />
                </div>

                <div class="col-span-1 sm:col-span-2">
                    <x-textarea wire:model.live="createForm.diagnostic" label="{{ __('Diagnosis') }}"
                        placeholder="{{ __('Write the diagnosis') }}" />
                </div>
                <div class="col-span-1 sm:col-span-2">
                    <x-textarea wire:model.live="createForm.treatment" label="{{ __('Treatment') }}"
                        placeholder="{{ __('Write the treatment') }}" />
                </div>
                <div class="col-span-1 sm:col-span-2">
                    <x-textarea wire:model.live="createForm.medication" label="{{ __('Medication') }}"
                        placeholder="{{ __('Write the medication') }}" />
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
    @else
        <div class="p-4 border-2 border-gray-700 border-dashed rounded-lg dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Historial médico</h2>
            <div class="mt-4">

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold">ID:</span>
                    {{ $medicalHistory->id }}
                </p>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold">Peso:</span>
                    {{ $medicalHistory->weight }} kg
                </p>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold">Altura:</span>
                    {{ $medicalHistory->height }} cm
                </p>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold">Temperatura:</span>
                    {{ $medicalHistory->temperature }} °C
                </p>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold">Diagnostico:</span>
                    {{ $medicalHistory->diagnostic }}
                </p>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold">Tratamiento:</span>
                    {{ $medicalHistory->treatment }}
                </p>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold">Medicación:</span>
                    {{ $medicalHistory->medication }}
                </p>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold">Sintomas:</span>
                    {{ $medicalHistory->symptoms }}
                </p>

            </div>
        </div>
    @endif

</div>
