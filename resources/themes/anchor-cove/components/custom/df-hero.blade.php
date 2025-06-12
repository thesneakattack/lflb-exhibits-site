@php($story = \App\Models\Tag::randomHeroStory())
@php($background = $story->main_image_url())
@php($orientation = method_exists($story, 'image_orientation') ? $story->image_orientation() : 'landscape')
@if ($story)
<section class="relative w-full text-white overflow-hidden">
    <div class="container mx-auto px-6 py-12 flex flex-col lg:flex-row items-center gap-8">
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
            <div class="lg:w-1/2 relative flex items-center justify-end">
                <div class="absolute inset-y-0 left-0 w-2/3 bg-gradient-to-l from-transparent to-[#111] z-0"></div>
                <img src="{{ $background }}" alt="{{ $story->title }}" class="relative z-10 w-full max-h-[420px] object-contain ml-auto">
            </div>
        @else
            <div class="absolute inset-0 -z-10">
                <img src="{{ $background }}" alt="{{ $story->title }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            </div>
        @endif
    </div>
</section>
@endif