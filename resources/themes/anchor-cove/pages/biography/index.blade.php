<?php
    use function Laravel\Folio\{name};
    name('biography');

    use App\Models\LflbStory;

    // $posts = \Wave\Post::orderBy('created_at', 'DESC')->paginate(6);
    // $categories = \Wave\Category::all();
?>

<x-layouts.marketing
    :seo="[
        'title' => 'Biographies',
        'description' => 'Our Archive of Biographies',
    ]"
>
    <x-container>
        <div class="relative pt-5">
            <x-tag-filtered-content
                model-class="\App\Models\LflbStory"
                tag-filters='{"main": "biography","feature": "hero"}'
                view="hero"
                mode="random"
                limit="1"
            />

            <x-custom.heading
                title="Biography Archive"
                description="Learn about the people behind the history."
                align="left"
            />
            <x-tag-filtered-content
                model-class="\App\Models\LflbStory"
                tag-filters='{"main": "biography"}'
                view="stories-loop"
                limit="9"
            />
            
            {{-- @include('theme::partials.blog.categories') --}}
            {{-- @include('theme::partials.blog.posts-loop') --}}

        </div>

        <div class="flex justify-center my-10">
            {{-- {{ $posts->links('theme::partials.pagination') }} --}}
        </div>

    </x-container>
</x-layouts.marketing>
