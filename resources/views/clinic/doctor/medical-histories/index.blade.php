<x-app-layout-clinic>


    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-400 border-dashed rounded-lg dark:border-gray-700 mt-14">

            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('clinic.dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-cyan-600 dark:text-gray-400 dark:hover:text-white">
                            <x-icon name="home" class="w-3 h-3 me-2.5" solid />
                            {{ __('Home') }}
                        </a>
                    </li>

                    <li>
                        <div class="flex items-center">

                            <x-icon name="chevron-right" class="w-4 h-4 text-gray-600" />

                            <a href="{{ route('clinic.medical-requests') }}"
                                class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                                {{ __('Medical appointments') }}
                            </a>
                        </div>
                    </li>

                    <li>
                        <div class="flex items-center">

                            <x-icon name="chevron-right" class="w-4 h-4 text-gray-600" />

                            <a href="{{ route('clinic.medical-requests.show', $medicalRequest) }}"
                                class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                                {{ __('Appointment Details') }} #{{ $medicalRequest->id }}
                            </a>
                        </div>
                    </li>
                </ol>
            </nav>

        </div>
    </div>


    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-400 border-dashed rounded-lg dark:border-gray-700">

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="p-4 border-2 border-gray-400 border-dashed rounded-lg dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Detalles de la cita médica</h2>
                    <div class="mt-4">

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">ID:</span>
                            {{ $medicalRequest->id }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">Fecha:</span>
                            {{ getDateForHumansText($medicalRequest->date) }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">Hora:</span>
                            {{ $medicalRequest->time }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">Motivo:</span>
                            {{ $medicalRequest->appointment->motive }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">Comentario:</span>
                            {{ $medicalRequest->appointment->comment }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">Urgencia:</span>
                            {{ $medicalRequest->appointment->is_urgent ? 'Es urgente' : 'No urgente' }}
                        </p>

                    </div>
                </div>
                <div class="p-4 border-2 border-gray-400 border-dashed rounded-lg dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Detalles del Paciente</h2>

                    <div class="mt-4">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">Nombres:</span>
                            {{ $medicalRequest->appointment->patient->names }}
                        </p>

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">Apellido paterno:</span>
                            {{ $medicalRequest->appointment->patient->paternal }}
                        </p>

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">Apellido materno:</span>
                            {{ $medicalRequest->appointment->patient->maternal }}
                        </p>

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">DNI:</span>
                            {{ $medicalRequest->appointment->patient->dni }}
                        </p>

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">Correo:</span>
                            {{ $medicalRequest->appointment->patient->email }}
                        </p>

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">Número telefonico:</span>
                            {{ $medicalRequest->appointment->patient->phone_number }}
                        </p>

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">Número telefonico de emergencia:</span>
                            {{ $medicalRequest->appointment->patient->emergency_phone_number ?? '-' }}
                        </p>

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">Género:</span>
                            {{ getGenderForUser($medicalRequest->appointment->patient->gender) }}
                        </p>
                    </div>

                </div>
            </div>

            <livewire:create-medical-history-modal :medicalRequest="$medicalRequest" />

        </div>
    </div>


</x-app-layout-clinic>
