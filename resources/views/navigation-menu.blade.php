<nav class="fixed top-0 z-50 w-full bg-slate-100 dark:bg-gray-800 dark:border-gray-700 border-b border-slate-500">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-white rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 hover:text-gray-400 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <x-icon name="menu" class="w-6 h-6 text-slate-700" />
                </button>
                <a href="{{ route('admin.dashboard') }}" class="flex ms-2 md:me-24">
                    <img src="{{ asset('images/clinic/adp.png') }}" class="h-10 me-3" alt="APD Technology" />
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3 gap-3">

                    {{-- notifications --}}
                    <livewire:view-notifications />

                    {{-- profile --}}

                    <livewire:view-profile />

                </div>
            </div>
        </div>
    </div>
</nav>
