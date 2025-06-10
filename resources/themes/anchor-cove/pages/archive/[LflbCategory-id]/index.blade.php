<?php
use function Laravel\Folio\name;
name('archive.topic');
?>

<x-layouts.marketing>
    @php
        $subtopics = $lflbCategory->lflbSubCategories()->paginate(6);
    @endphp

    <x-container>
        <div class="relative pt-10">
            <x-marketing.heading title="{{ $lflbCategory->title }} Articles"
                description="Our latest {{ $lflbCategory->title }} posts below." align="left" />

            {{-- @include("theme::partials.archive.subtopics") --}}
            @include("theme::partials.archive.subtopics-loop", ["subtopics" => $subtopics])
        </div>

        <div class="flex justify-center my-10">
            {{-- {{ $posts->links("theme::partials.pagination") }} --}}
        </div>
    </x-container>
</x-layouts.marketing>
