<div class="relative" x-data="{ open: false }" x-on:click.away="open = false">
    <button type="button"
        class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-secondary-700 dark:focus:ring-gray-600"
        x-on:click="open = !open">
        <span class="sr-only">Open user menu</span>
        <img class="w-8 h-8 rounded-full" src="{{ verifyAvatar(Auth::user()->avatar()) }}" alt="user photo">
    </button>

    <div class="absolute right-0 z-50 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
        id="dropdown-user" x-show="open" x-cloak>
        <div class="px-4 py-3" role="none">
            <p class="text-sm text-gray-900 dark:text-white" role="none">
                {{ Auth::user()->names }}
            </p>
            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                {{ Auth::user()->email }}
            </p>
        </div>
        <ul class="py-1" role="none">

            @if (!$isAdmin)
                <li>
                    <a href="{{ route('profile.show') }}" wire:navigate.hover
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                        role="menuitem">Perfil</a>
                </li>
            @endif

            <li>
                <a href="{{ route('clinic.setting') }}" wire:navigate.hover
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                    role="menuitem">Ajuste de horarios</a>
            </li>

            <li>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <a href="{{ route('logout') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                        @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
                {{-- <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Salir</a> --}}
            </li>
        </ul>
    </div>

</div>
