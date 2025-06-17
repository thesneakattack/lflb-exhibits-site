<?php

use App\Models\LflbCategory;
use App\Models\LflbStory;

use function Laravel\Folio\name;
name('archive');

// $stories = LflbStory::orderBy('updated_at', 'DESC')->paginate(6);
$topics = LflbCategory::where('featured', 'TRUE')->whereHas('lflbSubCategories')->with('lflbSubCategories')->orderBy('title', 'ASC')->paginate(6);
// $singleTopic = LflbCategory::find(33);
// $topicStories = $singleTopic->exhibits_stories(); // a Collection of LflbStory models
// $topicStoriesBySubCategory = $singleTopic->exhibits_stories_by_sub_category(); // Collection keyed by sub‐cat title
$breadcrumbs = [
    // ['label' => 'Home', 'url' => url('/')],
    ['label' => 'Topics', 'url' => null],
];
?>



<x-layouts.marketing :seo="[
    'title' => 'Topics',
    'description' => 'Our Topics',
]">
    <x-container>
        <div class="relative pt-5">
            <x-tag-filtered-content
    model-class="\App\Models\LflbStory"
    tag-filters='{"feature":"hero"}'
    limit="1"
    mode="random"
    view="hero"
/>
            {{-- <x-custom.hero></x-custom.hero> --}}
            <x-custom.df-breadcrumbs :breadcrumbs="$breadcrumbs" />
            <x-custom.df-heading title="From The Archives" description="Check out some of our latest topics below." align="left" />

            @include("theme::partials.archive.topics")
            @include("theme::partials.archive.topics-loop")
        </div>

        <div class="flex justify-center my-10">
            {{ $topics->links("theme::partials.pagination") }}
        </div>
    </x-container>
</x-layouts.marketing>
