<?php
// Import the Folio helpers: 'name' sets the route name, 'render' sets up pre-render logic
use function Laravel\Folio\{name, render};

// Import the model class from your app namespace
use App\Models\LflbCategory;

// Define the route name for this page as 'archive.topic' — useful for route() and named URLs
name('archive.topic');

// Pre-render hook: run before the Blade view is rendered
// We use this to alias $lflbCategory (injected via Folio model binding) as $topic
render(function ($view, App\Models\LflbCategory $lflbCategory) {
    // Add the alias 'topic' to the view context so it's accessible in the Blade file
    return $view->with([
        'topic' => $lflbCategory,
        'subtopics' => $lflbCategory->exhibits_sub_categories()->paginate(6),
    ]);
});
?>

<x-layouts.marketing>
    @php
    // $subtopics = $topic
    // ->exhibits_sub_categories() // your existing relationship
    // ->orderBy("title", "ASC")
    // ->paginate(6);
    @endphp

    <x-container>
        <div class="relative pt-10">
            <x-marketing.heading title="{{ $topic->title }} Articles"
                description="Our latest {{ $topic->title }} posts below." align="left" />

            {{-- @include("theme::partials.archive.subtopics") --}}
            @include("theme::partials.archive.subtopics-loop", ["subtopics" => $subtopics])
        </div>

        <div class="flex justify-center my-10">
            {{-- {{ $posts->links("theme::partials.pagination") }} --}}
        </div>
    </x-container>
</x-layouts.marketing>
