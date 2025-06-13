@php
    $story = $items->first();
    $background = $story?->main_image_url();
    $orientation = method_exists($story, 'image_orientation') ? $story->image_orientation() : 'landscape';
    $textAsset = $story?->lflbAssets?->where('type', 'TEXT')?->sortBy('position')->first();
@endphp

@if ($story && $story?->main_image_url() && $background)
    <section class="relative w-full text-white overflow-hidden">
        @if ($orientation === 'portrait')
            <div class="absolute inset-0 -z-10">
                <img src="{{ $background }}" alt="{{ $story->title }}" class="w-full h-full object-cover @if($orientation === 'portrait') blur-sm brightness-75 scale-105 @endif">
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            </div>
        @else
            <div class="absolute inset-0 -z-10">
                <img src="{{ $background }}" alt="{{ $story->title }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            </div>
        @endif

        <div class="container mx-auto px-6 pt-6 pb-12 flex flex-col lg:flex-row items-start gap-8 h-[30vh]">
            <div class="lg:w-1/2 relative z-10 flex flex-col justify-between h-full">
                <h2 class="text-4xl font-extrabold mt-0 leading-tight break-words">
                    {{ \Illuminate\Support\Str::limit($story->title, 60) }}
                </h2>
                <div class="mt-auto">
                    <p class="text-base leading-relaxed mb-4">
                        {{ \Illuminate\Support\Str::limit(strip_tags($textAsset->cleanText ?? ''), 160) }}
                    </p>
                    <div class="w-fit">
                        <a href="/story/{{ $story->id }}" class="inline-flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-700 transition">
                            Read More
                        </a>
                    </div>
                </div>
            </div>

            @if ($orientation === 'portrait')
                <div class="lg:w-1/2 relative z-10 flex items-center justify-end h-full">
                    <img src="{{ $background }}" alt="{{ $story->title }}" class="h-full max-h-[300px] w-auto object-contain object-right">
                </div>
            @endif
        </div>
    </section>
@endif
