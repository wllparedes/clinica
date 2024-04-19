<li>
    <a href="{{ route($route) }}" {{ $spa ? 'wire:navigate' : '' }}
        class="{{ setActive($route . '*') }} flex justify-between p-2 rounded-lg dark:text-white hover:bg-slate-700 dark:hover:bg-gray-700 group text-white hover:text-adp">

        <div class="flex items-center">
            <x-icon :name="$icon" class="w-5 h-5" />
            <span class="ms-3">{{ __($label) }}</span>
        </div>

        @if ($qty)
            <span
                class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-white rounded-full bg-gradient-to-r from-teal-500 to-sky-600">
                {{ $qty }}
            </span>
        @endif

    </a>
</li>
