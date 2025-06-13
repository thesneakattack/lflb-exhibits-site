<?php

use function Laravel\Folio\name;
name('biography');

use App\Models\LflbStory;

// Paginate all LflbStories tagged as biographies
$stories = LflbStory::whereHas('tags', function ($q) {
    $q->where('type', 'main')->where('slug', 'biography');
})->latest()->paginate(9);
?>

<x-layouts.marketing
    :seo="[
        'title' => 'Biographies',
        'description' => 'Our Archive of Biographies',
    ]"
>
    <x-container>
        <div class="relative pt-5">

            {{-- Optional featured hero using TagFilteredContent --}}
            <x-tag-filtered-content
                model-class="\App\Models\LflbStory"
                tag-filters='{"main": "biography","feature": "hero"}'
                view="hero"
                mode="random"
                limit="1"
            />

            <x-custom.heading
                title="Biography Archive"
                description="Learn about the people behind the history."
                align="left"
            />

            {{-- Loop through paginated biography stories --}}
            {{-- <x-tag-filtered-content
                model-class="\App\Models\LflbStory"
                tag-filters='{"main": "biography"}'
                view="stories-loop"
                limit="9"
            /> --}}
            @include('theme::partials.stories-loop', ['stories' => $stories])


            {{-- Pagination links using Wave3's partial --}}
            <div class="my-10">
                {{ $stories->links('theme::partials.pagination') }}
            </div>

        </div>
    </x-container>
</x-layouts.marketing>
