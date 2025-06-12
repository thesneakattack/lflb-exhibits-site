<section class="bg-white py-12">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-lg font-bold uppercase tracking-wide text-white bg-teal-600 px-4 py-1 inline-block mb-8">
            From the Collection
        </h2>

        <div class="space-y-12">
            @foreach ($items as $index => $story)
                @php
                    // Prioritize performance by pre-sorting once
                    $sortedAssets = $story->lflbAssets->sortBy('position');
                    $image = $sortedAssets->firstWhere('type', 'IMAGE');
                    $text  = $sortedAssets->firstWhere('type', 'TEXT');
                    $isEven = $index % 2 === 0;
                @endphp

                <div class="md:flex md:items-start bg-zinc-50 rounded-lg shadow overflow-hidden">
                    @if ($isEven)
                        {{-- Image Left, Text Right --}}
                        <div class="md:w-1/2 w-full">
                            @if ($image)
                                <img src="{{ Storage::disk('lflbassets')->url($image->link) }}" alt="{{ $story->title }}" class="object-cover w-full h-full max-h-[300px]">
                            @endif
                        </div>
                        <div class="md:w-1/2 w-full px-6 py-4">
                            <h3 class="text-xl font-semibold text-zinc-800 mb-1">{{ $story->title }}</h3>
                            <h4 class="text-zinc-500 mb-3">Subheading</h4>
                            <p class="text-sm text-zinc-700 leading-relaxed mb-4">
                                {{ \Illuminate\Support\Str::limit(strip_tags($text->cleanText ?? ''), 400) }}
                            </p>
                            <a href="/story/{{ $story->id }}" class="inline-block px-4 py-2 bg-red-400 hover:bg-red-500 text-white text-sm font-semibold rounded shadow">
                                📄 Read More
                            </a>
                        </div>
                    @else
                        {{-- Text Left, Image Right --}}
                        <div class="md:w-1/2 w-full px-6 py-4 order-2 md:order-1">
                            <h3 class="text-xl font-semibold text-zinc-800 mb-1">{{ $story->title }}</h3>
                            <h4 class="text-zinc-500 mb-3">Subheading</h4>
                            <p class="text-sm text-zinc-700 leading-relaxed mb-4">
                                {{ \Illuminate\Support\Str::limit(strip_tags($text->cleanText ?? ''), 400) }}
                            </p>
                            <a href="/story/{{ $story->id }}" class="inline-block px-4 py-2 bg-red-400 hover:bg-red-500 text-white text-sm font-semibold rounded shadow">
                                📄 Read More
                            </a>
                        </div>
                        <div class="md:w-1/2 w-full order-1 md:order-2">
                            @if ($image)
                                <img src="{{ Storage::disk('lflbassets')->url($image->link) }}" alt="{{ $story->title }}" class="object-cover w-full h-full max-h-[300px]">
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
