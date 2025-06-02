@props([
    'href' => '',
    'highlight' => false
])

<a 
    href="{{ $href }}" 
    @class([
        'block px-4 py-2 text-sm leading-5 focus:outline-none',
        'text-zinc-700 hover:bg-zinc-100 hover:text-zinc-900 focus:bg-zinc-100 focus:text-zinc-900' => !$highlight,
        'text-blue-100 bg-blue-500 hover:bg-blue-600 hover:text-white' => $highlight
    ])>
    {{ $slot }}
</a>