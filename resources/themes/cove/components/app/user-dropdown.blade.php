<div x-data="{ open: false }" @click.away="open = false" class="relative flex items-center h-full ml-3">
    <div>
        <button @click="open = !open" class="flex text-sm transition duration-150 ease-in-out border-2 border-transparent rounded-full focus:outline-none focus:border-zinc-300" id="user-menu" aria-label="User menu" aria-haspopup="true" x-bind:aria-expanded="open" aria-expanded="true">
            <img class="w-8 h-8 rounded-full" src="{{ auth()->user()->avatar() . '?' . time() }}" alt="{{ auth()->user()->name }}'s Avatar">
        </button>
    </div>
    
    <div
        x-show="open"
        x-transition:enter="duration-100 ease-out scale-95"
        x-transition:enter-start="opacity-50 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition duration-50 ease-in scale-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute top-0 right-0 w-56 mt-20 origin-top-right transform rounded-xl" x-cloak>

        <div class="bg-white border shadow-md rounded-xl border-zinc-100" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
            <a href="/profile/{{ auth()->user()->username }}" class="block px-4 py-3 text-zinc-700 hover:text-zinc-800">
                <span class="block text-sm font-medium leading-tight truncate">{{ auth()->user()->name }}</span>
                <span class="text-xs leading-5 text-zinc-600">View Profile</span>
            </a>
            <div class="border-t border-zinc-100"></div>
            <div class="py-1">
                @notsubscriber
                    <x-app.dropdown-link tag="a" href="/settings/subscription" icon="phosphor-sparkle-duotone" :highlight="true">Upgrade</x-app.dropdown-link>
                @endnotsubscriber
                @if(auth()->user()->isAdmin())
                    <x-app.dropdown-link href="/admin">View Admin</x-app.dropdown-link>
                @endif
                <x-app.dropdown-link tag="a" href="{{ route('notifications') }}">Notifications</x-app.sidebar-link>
                <x-app.dropdown-link tag="a" href="{{ route('settings.profile') }}">Settings</x-app.dropdown-link>
            </div>
            <div class="border-t border-zinc-100"></div>
            <div class="py-1">
                @impersonating
                    <x-app.dropdown-link href="{{ route('impersonate.leave') }}">Leave impersonation</x-app.dropdown-link>
                @endImpersonating
                <x-app.dropdown-link href="{{ route('logout') }}">Sign out</x-app.dropdown-link>
            </div>
        </div>
    </div>
</div>