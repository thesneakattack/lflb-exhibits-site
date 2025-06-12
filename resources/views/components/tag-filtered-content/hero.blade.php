@php
$story = $items->first(); // Only show first matched item
@endphp
@if ($story)
    @php($background = $story->main_image_url())
    @php($orientation = method_exists($story, 'image_orientation') ? $story->image_orientation() : 'landscape')

    <section class="relative w-full text-white overflow-hidden">
        @if ($orientation === 'portrait')
            <!-- Portrait: Blurred background -->
            <div class="absolute inset-0 -z-10">
                <img src="{{ $background }}" alt="{{ $story->title }}" class="w-full h-full object-cover blur-md opacity-30">
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            </div>
        @else
            <!-- Landscape -->
            <div class="absolute inset-0 -z-10">
                <img src="{{ $background }}" alt="{{ $story->title }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            </div>
        @endif

        <div class="container mx-auto px-6 py-12 flex flex-col lg:flex-row items-center gap-8 h-[30vh]">
            <div class="lg:w-1/2 relative z-10">
                <h2 class="text-4xl font-extrabold mb-4">Featured Article</h2>
                <h3 class="text-2xl font-semibold mb-2">{{ $story->title }}</h3>
                <p class="text-base leading-relaxed mb-4">
                    {{ Str::limit($story->description ?? 'Short Description of the article goes here.', 160) }}
                </p>
                <a href="/story/{{ $story->id }}"
                   class="inline-flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-700 transition">
                    Read More
                </a>
            </div>

            @if ($orientation === 'portrait')
                <div class="lg:w-1/2 relative z-10 flex items-center justify-end h-full">
                    <img src="{{ $background }}"
                         alt="{{ $story->title }}"
                         class="h-full max-h-[300px] w-auto object-contain object-right">
                </div>
            @endif
        </div>
    </section>
@endif
