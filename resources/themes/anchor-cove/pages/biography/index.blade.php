<?php

use function Laravel\Folio\name;
name('biography');

use App\Models\LflbStory;

// Paginate all LflbStories tagged as biographies
$stories = LflbStory::whereHas('tags', function ($q) {
    $q->where('type', 'main')->where('slug', 'biography');
})->latest()->paginate(9);
?>
@php
    $breadcrumbs = [
        ['label' => 'Biography', 'url' => null],
    ];
@endphp
<x-layouts.marketing
    :seo="[
        'title' => 'Biography',
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
            <x-custom.df-breadcrumbs :breadcrumbs="$breadcrumbs" />

            <x-custom.df-heading
                title="Biography"
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

        </div>

            {{-- Pagination links using Wave3's partial --}}
            <div class="flex justify-center my-10">
                {{ $stories->links('theme::partials.pagination') }}
            </div>

    </x-container>
</x-layouts.marketing>
