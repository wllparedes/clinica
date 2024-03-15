<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        {{-- <x-validation-errors class="mb-4" /> --}}

        <x-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="flex gap-3 form-control">
                <x-input icon="user" id="names" class=" mt-1 w-full" type="text" label="{{ __('Names') }}"
                    name="names" :value="old('names')" autofocus autocomplete="names" />

                <x-input icon="user" id="paternal" class=" mt-1 w-full" type="text" label="{{ __('Paternal') }}"
                    name="paternal" :value="old('paternal')" autofocus autocomplete="paternal" />
            </div>

            <div class="mt-4 flex gap-3 form-control">
                <x-input icon="user" id="maternal" class="block mt-1 w-full" type="text"
                    label="{{ __('Maternal') }}" name="maternal" :value="old('maternal')" autofocus autocomplete="maternal" />

                <x-input icon="hashtag" id="dni" class="block mt-1 w-full" label="{{ __('Dni') }}"
                    name="dni" :value="old('dni')" autofocus autocomplete="dni" />
            </div>

            <div class="mt-4 flex gap-3 form-control">
                <x-input icon="at-symbol" id="email" class="block mt-1 w-full" type="email"
                    label="{{ __('Email') }}" name="email" :value="old('email')" autocomplete="email" />

                <x-input icon="phone" id="phone" class="block mt-1 w-full" type="text"
                    label="{{ __('Phone') }}" name="phone" :value="old('phone')" autocomplete="phone" />
            </div>

            <div class="mt-4 flex gap-3 form-control">
                <x-label for="birthday">{{ __('Gender') }}:</x-label>
                <x-radio id="man" left-label="Masculino" name="gender" checked value="M" />
                <x-radio id="women" left-label="Femenino" name="gender" value="W" />
            </div>

            <div class="mt-4 flex gap-3 form-control">
                <x-inputs.password id="password" class="block mt-1 w-full" type="password" label="{{ __('Password') }}"
                    name="password" autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-inputs.password id="password_confirmation" class="block mt-1 w-full" type="password"
                    label="{{ __('Confirm Password') }}" name="password_confirmation" autocomplete="new-password" />
            </div>

            {{-- @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif --}}

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4" dark type="submit">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
