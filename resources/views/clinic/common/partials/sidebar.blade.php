<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full  border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto dark:bg-gray-800 soft-scrollbar">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('clinic.dashboard') }}"
                    class="{{ setActive('clinic.dashboard') }} flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group text-black hover:text-black">
                    <x-icon name="home" class="w-5 h-5" />
                    <span class="ms-3"> {{ __('Home') }} </span>
                </a>
            </li>

            @can('denyDoctor')
                <li>
                    <a href="{{ route('clinic.appointments') }}"
                        class="{{ setActive('clinic.appointments') }} flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group text-black hover:text-black">
                        <x-icon name="annotation" class="w-5 h-5" />
                        <span class="flex-1 ms-3 whitespace-nowrap">{{ __('Appointment requests') }}</span>
                    </a>
                </li>
            @endcan

            <li>
                <a href="{{ route('clinic.medical-requests') }}"
                    class="{{ setActive('clinic.medical-requests') }} flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group text-black hover:text-black">
                    <x-icon name="calendar" class="w-5 h-5" />
                    <span class="flex-1 ms-3 whitespace-nowrap">{{ __('Medical appointments') }} </span>
                </a>
            </li>


        </ul>
    </div>
</aside>
