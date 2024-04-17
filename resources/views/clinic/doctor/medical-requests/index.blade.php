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
                </ol>
            </nav>

        </div>
    </div>


    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-400 border-dashed rounded-lg dark:border-gray-700">

            <div id='calendar'></div>

        </div>
    </div>

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://unpkg.com/tippy.js@6"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let calendarEl = document.getElementById('calendar');
                let calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: 'es',
                    timeZone: 'local',
                    allDaySlot: false,
                    initialView: 'dayGridMonth',
                    events: @json($appointments),
                    eventDidMount: function(info) {
                        tippy(info.el, {
                            content: info.event.extendedProps.description,
                            allowHTML: true,
                        });
                    },
                    eventClick: function(info) {
                        window.location.href = "{{ route('clinic.medical-requests.show', '') }}/" + info
                            .event
                            .id;
                    },
                    buttonText: {
                        today: 'Hoy'
                    },
                });
                calendar.render();
            });
        </script>
    @endsection

</x-app-layout-clinic>
