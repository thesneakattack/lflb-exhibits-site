<?php

use function Laravel\Folio\name;
name('timeline');

use App\Models\LflbStory;

// Paginate all LflbStories tagged as biographies
$stories = LflbStory::whereHas('tags', function ($q) {
    $q->where('type', 'main')->where('slug', 'timeline');
})->latest()->paginate(9);
?>

<x-layouts.marketing
    :seo="[
        'title' => 'Timelines',
        'description' => 'Our Archive of Timelines',
    ]"
>
    <x-container>
        <div class="relative pt-5">

            {{-- Optional featured hero using TagFilteredContent --}}
            <x-tag-filtered-content
                model-class="\App\Models\LflbStory"
                tag-filters='{"main": "timeline","feature": "hero"}'
                view="hero"
                mode="random"
                limit="1"
            />

            <x-custom.heading
                title="Timeline Archive"
                description="Learn about the people behind the history."
                align="left"
            />

            {{-- Loop through paginated timeline stories --}}
            {{-- <x-tag-filtered-content
                model-class="\App\Models\LflbStory"
                tag-filters='{"main": "timeline"}'
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
