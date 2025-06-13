@php
    use App\Models\Tag;
    $slugs = $tagFilters['category'] ?? [];
@endphp
<div class="grid gap-5 mx-auto mt-10 sm:grid-cols-2 lg:grid-cols-4">

    @foreach ($slugs as $slug)
        @php
            $tag = Tag::where('slug', $slug)->first();
            $story = $tag?->stories()?->latest()?->first(); // assumes Tag has a 'stories' relation
        @endphp

        @if ($tag && $story)
            <div class="relative group overflow-hidden shadow-md ">
                <a href="/tagged/{{ $tag->slug }}">
                    <img 
                        src="{{ $story->main_image_url() ?? '/placeholder.jpg' }}"
                        alt="{{ $story->title }}"
                        class="w-full h-64 sm:h-72 object-cover duration-300 transition-transform hover:scale-[1.10]"
                    />
                </a>
                <div class="absolute bottom-0 left-0 w-full bg-lfnavy-500 bg-opacity-70">
                    <h3 class="text-white font-semibold text-lg sm:text-xl capitalize tracking-tight px-4 py-1">
                        {{ $tag->name }}
                    </h3>
                </div>
            </div>
        @endif
    @endforeach
</div>
