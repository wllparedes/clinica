<div>
    <div class="flex items-center"> <button type="button" aria-expanded="false"
            data-dropdown-toggle="dropdown-notifications">
            <x-icon name="bell" class="w-5 h-5 text-white" solid />

            {{-- @if ($unreadNotificationCount)
                <span
                    class="px-2 py-1 text-xs font-semibold text-white bg-red-500 rounded-full dark:bg-red-600 ">
                    {{ $unreadNotificationCount }}
                </span>
            @endif --}}

        </button>
    </div>

    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
        id="dropdown-notifications">
        <div class="px-4 py-3" role="none">
            @forelse ($notifications as $notification)
                <div
                    class="flex items-center justify-between mb-2 {{ $notification->is_read ? 'bg-gray-50' : 'bg-white' }} p-2 rounded">
                    <div class="flex items-center">
                        <div class="mr-2">
                            @if ($notification->is_read)
                                <x-icon name="check-circle" class="w-4 h-4 text-green-500" solid />
                            @else
                                <x-icon name="x-circle" class="w-4 h-4 text-red-500" solid />
                            @endif
                        </div>
                        <div>
                            <span class="font-medium">{{ __($notification->title) }}</span>
                            <p class="text-sm text-gray-500">{{ __($notification->description) }}</p>
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
                <p class="text-sm text-gray-500">{{ __('No notifications') }} </p>
            @endforelse
        </div>
    </div>
</div>
