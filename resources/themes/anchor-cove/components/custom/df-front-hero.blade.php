@php
    // $story = $items->first();
    $background = asset(setting('site.hero-image'));
    
    $orientation = 'landscape';
    // $textAsset = $story?->lflbAssets?->where('type', 'TEXT')?->sortBy('position')->first();

    $heroParagraph = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas neque neque, semper nec enim at, venenatis placerat turpis. Aenean mattis est eget faucibus imperdiet. Vivamus ligula risus, congue in ipsum nec, fermentum interdum odio. Nulla finibus, lectus vestibulum efficitur lobortis, lorem tortor viverra enim, eget aliquet elit ante nec nunc. ";
@endphp

@if ($background)
    <section class="relative w-full text-white overflow-hidden">
        @if ($orientation === 'portrait')
            <div class="absolute inset-0 -z-10">
                <img src="{{ $background }}" alt="The History Center of Lake Forest-Lake Bluff" class="w-full h-full object-cover @if($orientation === 'portrait') blur-sm brightness-75 scale-105 @endif">
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            </div>
        @else
            <div class="absolute inset-0 -z-10">
                <img src="{{ $background }}" alt="The History Center of Lake Forest-Lake Bluff" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            </div>
        @endif

        <div class="container mx-auto px-6 pt-6 pb-12 flex flex-col lg:flex-row items-start gap-8 h-[30vh]">
            <div class="lg:w-1/2 relative z-10 flex flex-col justify-between h-full">
                <h2 class="text-4xl font-extrabold mt-0 leading-tight break-words">
                    The History Center of Lake Forest-Lake Bluff
                </h2>
                <div class="mt-auto">
                    <p class="text-base leading-relaxed mb-4">

                        {{ \Illuminate\Support\Str::limit(strip_tags($heroParagraph ?? ''), 160) }}
                    </p>
                    <div class="w-fit">
                        <a href="/archive/" class="inline-flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-700 transition">
                            Browse the Collections
                        </a>
                    </div>
                </div>
            </div>

            @if ($orientation === 'portrait')
                <div class="lg:w-1/2 relative z-10 flex items-center justify-end h-full">
                    <img src="{{ $background }}" alt="The History Center of Lake Forest-Lake Bluff" class="h-full max-h-[300px] w-auto object-contain object-right">
                </div>
            @endif
        </div>
    </section>
@endif
