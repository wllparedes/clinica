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

                            <a href="{{ route('clinic.setting') }}"
                                class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                                {{ __('Settings') }}
                            </a>
                        </div>
                    </li>
                </ol>
            </nav>

        </div>
    </div>


    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-400 border-dashed rounded-lg dark:border-gray-700">

            <form action="" method="POST">
                @csrf
                <div class="mb-4">
                    <x-select label="Dias laborable" placeholder="Selecciona los dias laborables" multiselect>
                        <x-select.option label="Lunes" value="lunes" />
                        <x-select.option label="Martes" value="lunes" />
                        <x-select.option label="Miercoles" value="lunes" />
                        <x-select.option label="Jueves" value="lunes" />
                        <x-select.option label="Viernes" value="lunes" />
                        <x-select.option label="Sabado" value="lunes" />
                    </x-select>
                </div>
                <div class="mb-4">
                    <label for="start_time" class="block text-sm font-medium text-gray-700">Hora de inicio</label>
                    <input type="time" id="start_time" name="start_time"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="end_time" class="block text-sm font-medium text-gray-700">Hora de finalización</label>
                    <input type="time" id="end_time" name="end_time"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="capacity" class="block text-sm font-medium text-gray-700">Capacidad</label>
                    <input type="number" id="capacity" name="capacity"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                        Save
                    </button>
                </div>
            </form>

        </div>
    </div>

</x-app-layout-clinic>
