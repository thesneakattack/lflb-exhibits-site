@php $notifications_count = auth()->user()->unreadNotifications->count(); @endphp

    @php $unreadNotifications = auth()->user()->unreadNotifications->take(3); @endphp
    <div id="notification-list" @click.away="open = false" class="flex relative items-center h-full" x-data="{ open: false }">
        <div class="relative">
            <button @click="open = !open" class="relative p-1.5 ml-3 rounded-full transition duration-150 ease-in-out text-zinc-400 hover:text-zinc-500 focus:outline-none focus:text-zinc-500 focus:bg-gray-100">
                <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                @if($unreadNotifications && $notifications_count > 0) <span id="notification-count" class="flex absolute top-0 right-0 justify-center items-center mt-0.5 mr-0.5 w-4 h-4 text-xs text-red-100 bg-red-500 rounded-full">{{ $notifications_count }}</span> @endif
            </button>
        </div>

        <div x-show="open"
            x-transition:enter="duration-100 ease-out scale-95"
            x-transition:enter-start="opacity-50 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition duration-50 ease-in scale-100"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="overflow-hidden absolute top-0 right-0 mt-20 w-96 max-w-lg rounded-lg shadow-lg transform origin-top-right w-104" x-cloak>
    
        <div class="bg-white rounded-md border shadow-md border-zinc-100" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
        
            <div>
                <div id="notification-head-content" class="flex items-center px-3 py-3 w-full border-b text-zinc-600 border-zinc-200">
                    <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    Notifications
                </div>
            </div>

            <div id="notifications-none" class="@if($notifications_count > 0){{ 'hidden' }}@endif bg-zinc-150 flex items-center justify-center h-24 w-full text-zinc-600 font-medium">
                <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                All Caught Up!
            </div>

            <div class="relative">
                @foreach ($unreadNotifications as $index => $notification)
                    @php $notification_data = (object)$notification->data; @endphp
                    <div class="flex flex-col pb-5 border-b border-zinc-200 hover:bg-zinc-50">

                        <a href="{{ @$notification_data->link }}" class="flex items-start p-5 pb-2">
                            <div class="flex-shrink-0 pt-1">
                                <img class="w-8 h-8 rounded-full border border-gray-200" src="{{ @$notification_data->icon }}" alt="">
                            </div>
                            <div class="flex flex-col flex-1 items-start ml-3 w-0">
                                <p class="text-sm leading-5 text-zinc-600">
                                    <strong>{{ @$notification_data->user['username'] }} @if(isset($notification_data->type) && @$notification_data->type == 'message'){{ 'left a message' }}@else{{ 'said' }}@endif</strong>
                                    {{ @$notification_data->body }}
                                </p>
                            </div>
                        </a>
                        <span class="flex justify-start pl-16 ml-1 w-full text-xs cursor-pointer text-zinc-500 k hover:text-zinc-700">
                            <a href="/notifications" class="p-1 px-2 bg-white rounded-md border border-gray-200 hover:shadow-sm">
                                View Notifications
                            </a>
                        </span>

                    </div>
                @endforeach
            </div>

            <div class="flex justify-center items-center text-xs font-medium border-t text-zinc-600 bg-zinc-100 border-zinc-200">
                <a href="{{ route('notifications') }}" class="py-3 w-full text-center">View All Notifications</a>
            </div>
        </div>
    </div>
</div><!-- End of #notification-list -->
