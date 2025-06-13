<?php
use function Laravel\Folio\name;
name('tagged.tag');
?>

<x-layouts.marketing>
    <x-container class="pt-10 space-y-12">

        {{-- Page header --}}
        <x-custom.heading title="Tagged: {{ ucwords(str_replace('-', ' ', $tag)) }}" description="All content tagged with '{{ $tag }}'." />

        {{-- Livewire-powered content sections --}}
        <x-tag-filtered-content 
            :model-class="'App\\Models\\LflbStory'" 
            :tag-filters="json_encode([$tag])"
            :limit="12" 
            view="hero"
            mode="all" 
        />

    </x-container>
</x-layouts.marketing>