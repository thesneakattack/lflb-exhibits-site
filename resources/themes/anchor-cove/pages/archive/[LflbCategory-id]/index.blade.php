<?php
use function Laravel\Folio\name;

name("archive.topic");
?>

<x-layouts.marketing>
    @php
    $subTopics = $topic
    ->exhibits_sub_categories() // your existing relationship
    ->orderBy("title", "ASC")
    ->paginate(6);
    @endphp

    <x-container>
        <div class="relative pt-10">
            <x-marketing.heading title="{{ $topic->title }} Articles"
                description="Our latest {{ $topic->title }} posts below." align="left" />

            @include("theme::partials.archive.topic")
            @include("theme::partials.archive.topics-loop", ["posts" => $posts])
        </div>

        <div class="flex justify-center my-10">
            {{ $posts->links("theme::partials.pagination") }}
        </div>
    </x-container>
</x-layouts.marketing>
