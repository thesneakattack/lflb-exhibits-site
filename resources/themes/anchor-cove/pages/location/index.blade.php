<?php

use function Laravel\Folio\name;
name('location');

use App\Models\LflbStory;

// Paginate all LflbStories tagged as biographies
$stories = LflbStory::whereHas('tags', function ($q) {
    $q->where('type', 'main')->where('slug', 'location');
})->latest()->paginate(9);
?>
@php
    $breadcrumbs = [
        ['label' => 'Location', 'url' => null],
    ];
@endphp
<x-layouts.marketing
    :seo="[
        'title' => 'Locations',
        'description' => 'Our Archive of Locations',
    ]"
>
    <x-container>
        <div class="relative pt-5">

            {{-- Optional featured hero using TagFilteredContent --}}
            <x-tag-filtered-content
                model-class="\App\Models\LflbStory"
                tag-filters='{"main": "location","feature": "hero"}'
                view="hero"
                mode="random"
                limit="1"
            />
            <x-custom.df-breadcrumbs :breadcrumbs="$breadcrumbs" />

            <x-custom.df-heading
                title="Locations"
                description="Discover stories and artifacts tied to local places and landmarks in the community."
                align="left"
            />

            {{-- Loop through paginated location stories --}}
            {{-- <x-tag-filtered-content
                model-class="\App\Models\LflbStory"
                tag-filters='{"main": "location"}'
                view="stories-loop"
                limit="9"
            /> --}}
            @include('theme::partials.stories-loop', ['stories' => $stories])

        </div>

            {{-- Pagination links using Wave3's partial --}}
            <div class="flex justify-center my-10">
                {{ $stories->links('theme::partials.pagination') }}
            </div>

    </x-container>
</x-layouts.marketing>
