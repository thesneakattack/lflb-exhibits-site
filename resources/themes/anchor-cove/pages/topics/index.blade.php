<?php

use App\Models\LflbCategory;
use App\Models\LflbStory;

use function Laravel\Folio\name;

name('topics');

$stories = LflbStory::orderBy('updated_at', 'DESC')->paginate(6);
$topics = LflbCategory::where('featured', 'TRUE')->whereHas('exhibits_sub_categories')->with('exhibits_sub_categories')->orderBy('title', 'ASC')->paginate(6);
$lflb_category = LflbCategory::find(33);
$allStories = $lflb_category->exhibits_stories(); // a Collection of LflbStory models
$storiesBySubCategory = $lflb_category->exhibits_stories_by_sub_category(); // Collection keyed by sub‐cat title

$posts = \Wave\Post::orderBy('created_at', 'DESC')->paginate(6);
$categories = \Wave\Category::all();
?>
{{-- Dump the flat stories collection --}}
<pre>
{{ print_r($allStories->toArray(), true) }}
</pre>

{{-- Dump the grouped stories-by-subcategory --}}
<pre>
{{ print_r($storiesBySubCategory->toArray(), true) }}
</pre>

<x-layouts.marketing :seo="[
    'title' => 'Topics',
    'description' => 'Our Topics',
]">
    <x-container>
        <div class="relative pt-5">
            <x-marketing.heading title="From The Museum" description="Check out some of our latest topics below." align="left" />

            @include("theme::partials.topics.categories")
            @include("theme::partials.topics.posts-loop")
        </div>

        <div class="flex justify-center my-10">
            {{ $posts->links("theme::partials.pagination") }}
        </div>
    </x-container>
</x-layouts.marketing>
