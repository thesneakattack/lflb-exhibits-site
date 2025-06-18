<?php
use function Laravel\Folio\name;
name('tagged.tag');

use App\Models\LflbStory;
use App\Models\Tag;
$tag = request()->route('tag');
// Paginate all LflbStories tagged as biographies
$tagModel = Tag::where('slug', $tag)->first();

$stories = LflbStory::whereHas('tags', function ($q) use ($tag) {
    $q->where('type', 'category')->where('slug', $tag);
})->latest()->paginate(9);
?>

<x-layouts.marketing>
    <x-container>
        <div class="relative pt-5">


            {{-- Page header --}}

            {{-- Livewire-powered content sections --}}
            <x-tag-filtered-content 
                :model-class="'App\\Models\\LflbStory'" 
                :tag-filters="json_encode([$tag])"
                :limit="1" 
                view="hero"
                mode="random" 
            />

            <x-custom.df-heading title="{{ $tagModel->name }}" description="All content tagged with '{{ $tagModel->name }}'." />


            @include('theme::partials.stories-loop', ['stories' => $stories])
        </div>

            {{-- Pagination links using Wave3's partial --}}
            <div class="flex justify-center my-10">
                {{ $stories->links('theme::partials.pagination') }}
            </div>        
    </x-container>
</x-layouts.marketing>