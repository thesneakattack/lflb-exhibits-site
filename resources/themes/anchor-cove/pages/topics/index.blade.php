<?php
use App\Models\LflbStory;

use function Laravel\Folio\name;

name('topics');

$stories = LflbStory::orderBy('updated_at', 'DESC')->paginate(6);

$posts = \Wave\Post::orderBy('created_at', 'DESC')->paginate(6);
$categories = \Wave\Category::all();
?>


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
