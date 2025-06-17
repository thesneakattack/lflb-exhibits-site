<?php
use function Laravel\Folio\name;
name('archive.subtopic');
?>
<x-layouts.marketing>
    @php
        $stories = $lflbSubCategory->lflbStories()->paginate(6);

        $breadcrumbs = [
            // ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Topics', 'url' => route('archive')],
            ['label' => $lflbCategory->title, 'url' => url("/archive/{$lflbCategory->id}")],
            ['label' => $lflbSubCategory->title, 'url' => null],
        ];
    @endphp
    <x-container>
        <div class="relative pt-10">

        <x-custom.df-heading
            title="{{ $lflbSubCategory->title }}"
            description="Choose a story below"
            align="left"
        />
        <x-custom.df-breadcrumbs :breadcrumbs="$breadcrumbs" />
        @include('theme::partials.stories-loop', ['stories' => $stories])
        </div>

        <div class="flex justify-center my-10">{{ $stories->links('theme::partials.pagination') }}</div>
    </x-container>
</x-layouts.marketing>