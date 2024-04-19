<div class="relative" x-data="{ open: false }" x-on:click.away="open = false">
    <div class="flex items-center">
        <button type="button" x-on:click="open = !open"
            class="transition-colors duration-200 ease-in-out hover:bg-slate-200 p-2 rounded-lg">

            <x-icon name="bell" class="w-5 h-5" x-show="!open" />
            <x-icon name="bell" class="w-5 h-5" solid x-show="open" x-cloak />

            @if ($unReadCount)
                <span class="absolute px-1 py-1 text-2xs text-white bg-red-600 rounded-full top-2">
                </span>
            @endif

        </button>
    </div>

    <div class="absolute right-0 z-500 w-96 mt-2 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
        id="dropdown-notifications" x-show="open" x-cloak>

        <div class="px-3 py-3">
            <span class="text-sm font-semibold">{{ __('Notifications') }}</span>
        </div>

        <div class="px-3 h-80 py-1" style="max-height: 500px; overflow-y: auto;">
            @forelse ($notifications as $notification)
                <div
                    class=" flex items-center justify-between mb-2 p-2 rounded border-dashed border-2 hover:bg-slate-50 {{ $notification->is_read ? 'border-teal-500' : 'border-yellow-400' }} hover:cursor-pointer transition-all ease-in-out">
                    <div class="flex items-center">
                        <div class="mr-2">
                            @if ($notification->is_read)
                                <x-icon name="check-circle" class="w-4 h-4 text-teal-500" solid />
                            @else
                                <x-icon name="information-circle" class="w-4 h-4 text-yellow-500" solid />
                            @endif
                        </div>
                        <div>
                            <span class="text-xs font-semibold">{{ __($notification->title) }}</span>
                            <p class=" text-gray-500 text-xs">{{ __($notification->description) }}</p>
                            <span
                                class="text-2xs text-gray-400">{{ getDateForHumans($notification->created_at) }}</span>
                        </div>
                    </div>
                    @if (!$notification->is_read)
                        <div>
                            <x-dropdown>
                                <x-dropdown.item wire:click='markAsRead({{ $notification }})'
                                    label="{{ __('Mark as read') }}" />
                            </x-dropdown>
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-sm p-4 text-center text-gray-500">{{ __('No notifications') }} </p>
            @endforelse
        </div>
{{--
        <div class="px-3 py-3 flex justify-center">
            <a href="{{ route('admin.notifications') }}"
                class="text-sm font-semibold text-center text-teal-500 hover:text-teal-600 p-2 hover:bg-teal-100 rounded-lg transition-all ease-in">
                {{ __('View all notifications') }}
            </a>
        </div> --}}


    </div>

</div>
