<div>
    <x-form-section submit="updateProfileInformation">
        <x-slot name="title">
            {{ __('Personal Information') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Update your account personal information.') }}
        </x-slot>

        <x-slot name="form">


            <div class="col-span-6 sm:col-span-4">
                <x-input icon="hashtag" id="dni" class="mt-1 block w-full" label="{{ __('Dni') }}"
                    wire:model='updateForm.dni' placeholder='Ingrese su dni' />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-input icon="phone" id="phone" class="mt-1 block w-full" type="number"
                    label="{{ __('Phone') }}" wire:model='updateForm.phone' placeholder='Ingrese su telefono' />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-input icon="phone" id="phoneEmergency" class="mt-1 block w-full" type="number"
                    label="{{ __('Phone Emergency') }}" wire:model='updateForm.phoneEmergency'
                    placeholder='Ingrese su telefono de emergencia' />
            </div>


            {{-- <div class="col-span-6 sm:col-span-4"> --}}
            {{-- <x-datetime-picker label="{{ __('Birth date') }}" placeholder="{{ __('Birth date') }}"
                    wire:model.defer="normalPicker" /> --}}

            {{-- <x-wireui::datetime-picker label="{{ __('Birth date') }}" placeholder="{{ __('Birth date') }}"
                    wire:model.defer="birthDate" without-time /> --}}
            {{-- </div> --}}


            <div class="col-span-6 sm:col-span-4">
                <x-select label="Seleccionar nacionalidad" placeholder="Seleccionar nacionalidad"
                    wire:model="updateForm.nationality">
                    @foreach ($nationalities as $key => $nationality)
                        <x-select.user-option src="{{ getFlagCountry($key) }}" label="{{ $nationality }}"
                            value="{{ $key }}" />
                    @endforeach
                </x-select>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-textarea wire:model="updateForm.address" label="Dirección" placeholder="ingrese su dirección" />
            </div>

            <div class="col-span-6 sm:col-span-4 flex gap-3 ">
                <x-label for="gender">{{ __('Gender') }}:</x-label>
                <x-radio id="man" left-label="Masculino" value="M" wire:model="updateForm.gender" />
                <x-radio id="women" left-label="Femenino" value="W" wire:model="updateForm.gender" />
            </div>

            <!-- Email -->
            {{-- <div class="col-span-6 sm:col-span-4">
                <x-input id="email" type="email" label="{{ __('Email') }}" class="mt-1 block w-full"
                    wire:model="state.email" autocomplete="username" />
                <x-input-error for="email" class="mt-2" />

            </div> --}}
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="me-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <x-button wire:loading.attr="disabled" type="submit" dark>
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-form-section>

</div>
