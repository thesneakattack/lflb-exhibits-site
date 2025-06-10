<?php

use App\Models\LflbCategory;
use App\Models\LflbStory;

use function Laravel\Folio\name;
name('archive');

// $stories = LflbStory::orderBy('updated_at', 'DESC')->paginate(6);
$topics = LflbCategory::where('featured', 'TRUE')->whereHas('exhibits_sub_categories')->with('exhibits_sub_categories')->orderBy('title', 'ASC')->paginate(6);
// $singleTopic = LflbCategory::find(33);
// $topicStories = $singleTopic->exhibits_stories(); // a Collection of LflbStory models
// $topicStoriesBySubCategory = $singleTopic->exhibits_stories_by_sub_category(); // Collection keyed by sub‐cat title

?>


{{-- Dump the flat stories collection --}}
<pre></pre>

{{-- Dump the grouped stories-by-subcategory --}}
<pre></pre>

<x-layouts.marketing :seo="[
    'title' => 'Topics',
    'description' => 'Our Topics',
]">
    <x-container>
        <div class="relative pt-5">
            {{-- <x-custom.hero></x-custom.hero> --}}
            <x-marketing.heading title="From The Archives" description="Check out some of our latest topics below." align="left" />

            @include("theme::partials.archive.topics")
            @include("theme::partials.archive.topics-loop")
        </div>

        <div class="flex justify-center my-10">
            {{ $topics->links("theme::partials.pagination") }}
        </div>
    </x-container>
</x-layouts.marketing>
