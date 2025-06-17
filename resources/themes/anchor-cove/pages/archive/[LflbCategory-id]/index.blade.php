<?php
use function Laravel\Folio\name;
name('archive.topic');
?>

<x-layouts.marketing>
    @php
        $subtopics = $lflbCategory->lflbSubCategories()->paginate(6);
        if ($subtopics->count() === 1) {
            $subtopic = $subtopics->first();
            header("Location: /archive/{$lflbCategory->id}/{$subtopic->id}");
            exit;
        }        
        $breadcrumbs = [
            // ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Topics', 'url' => route('archive')],
            ['label' => $lflbCategory->title, 'url' => null],
        ];        
    @endphp

    <x-container>
        <div class="relative pt-10">
            <x-custom.df-heading title="{{ $lflbCategory->title }}"
                description="Choose a subtopic below for articles." align="left" />
            <x-custom.df-breadcrumbs :breadcrumbs="$breadcrumbs" />

            {{-- @include("theme::partials.archive.subtopics") --}}
            @include("theme::partials.archive.subtopics-loop", ["subtopics" => $subtopics])
        </div>

        <div class="flex justify-center my-10">
            {{-- {{ $posts->links("theme::partials.pagination") }} --}}
        </div>
    </x-container>
</x-layouts.marketing>
