<?php
use function Laravel\Folio\name;
name('archive.subtopic');
?>
<x-layouts.marketing>
    @php
        $stories = $lflbSubCategory->lflbStories()->paginate(6);
    @endphp
    <x-container>
        <x-custom.heading
            title="{{ $lflbSubCategory->title }}"
            description="Choose a story below"
            align="left"
        />
        @include('theme::partials.stories-loop', ['stories' => $stories])
        <div class="my-10">{{ $stories->links('theme::partials.pagination') }}</div>
    </x-container>
</x-layouts.marketing>