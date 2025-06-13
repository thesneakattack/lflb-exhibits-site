@props(['title', 'slug', 'limit' => 6])

@php($stories = \App\Models\Tag::storiesForSection($slug, $limit))

@if ($stories && $stories->isNotEmpty())
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-4">{{ $title }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($stories as $story)
                <x-archive.story-preview :story="$story" />
            @endforeach
        </div>
    </div>
</section>
@endif
