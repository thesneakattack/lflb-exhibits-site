<a href="{{ $href }}" wire:navigate class="block relative w-full flex items-center px-4 sm:px-6 py-2 sm:py-3 text-sm font-medium leading-5 @if(Request::is('settings/profile')){{ 'text-zinc-900' }}@else{{ 'text-zinc-600' }}@endif transition duration-150 ease-in-out rounded-md group hover:text-zinc-900 hover:bg-zinc-50 focus:outline-none focus:text-zinc-900 focus:bg-zinc-50">
    <x-dynamic-component :component="$icon" 
        @class([
            'flex-shrink-0 w-5 h-5 md:mr-3 -ml-1 transition duration-150 ease-in-out group-hover:text-zinc-500 group-focus:text-zinc-500',
            'text-zinc-500' => ($active ?? false)
        ]) />
    <span class="hidden truncate md:inline-block">{{ $slot }}</span>
    <span class="absolute left-0 block w-1 transition-all duration-300 ease-out rounded-full @if(($active ?? false)){{ 'bg-blue-500 h-full top-0' }}@else{{ 'top-1/2 bg-zinc-300 group-hover:top-0 h-0 group-hover:h-full' }}@endif "></span>
</a>