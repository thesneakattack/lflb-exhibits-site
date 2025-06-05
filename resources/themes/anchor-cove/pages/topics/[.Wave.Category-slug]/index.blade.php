<?php
use function Laravel\Folio\name;

name('topics.category');
?>


<x-layouts.marketing>
    @php
        $posts = $category->posts()->paginate(6);
    @endphp

    <x-container>
        <div class="relative pt-10">
            <x-marketing.heading title="{{ $category->name }} Articles" description="Our latest {{ $category->name }} posts below." align="left" />

            @include("theme::partials.topics.categories")
            @include("theme::partials.topics.posts-loop", ["posts" => $posts])
        </div>

        <div class="flex justify-center my-10">
            {{ $posts->links("theme::partials.pagination") }}
        </div>
    </x-container>
</x-layouts.marketing>
