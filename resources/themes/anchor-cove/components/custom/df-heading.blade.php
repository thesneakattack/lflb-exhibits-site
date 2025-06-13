@props([
    'level' => 'h1',
    'title' => 'No Heading Title Entered',
    'description' => 'Be sure to include the description attribute',
    'align' => 'left',
    'meta' => null, // optional metadata string (e.g. "Date - Location - Tags")
])

<div {{ $attributes->class('w-full') }}>
    {{-- Heading bar --}}
    <{{ $level }}
        class="mt-4 inline-block bg-teal-500 text-white px-4 py-2 text-lg sm:text-xl md:text-2xl font-bold tracking-tight leading-snug">
        {!! $title !!}
    </{{ $level }}>

    {{-- Description --}}
    @if ($description)
        <p class="mt-3 text-zinc-600 text-sm sm:text-base font-normal">
            {!! $description !!}
        </p>
    @endif

    {{-- Metadata --}}
    @if ($meta)
        <p class="mt-1 text-zinc-400 text-sm italic tracking-tight">
            {!! $meta !!}
        </p>
    @endif
</div>
