<?php
    use function Laravel\Folio\{name};
    name('blog');

    $posts = \Wave\Post::orderBy('created_at', 'DESC')->paginate(6);
    $categories = \Wave\Category::all();
?>

<x-layouts.marketing
    :seo="[
        'title' => 'Blog',
        'description' => 'Our Blog',
    ]"
>
    <x-container>
        <div class="relative pt-5">
            <x-marketing.heading
                title="From The Blog"
                description="Check out some of our latest blog posts below."
                align="left"
            />
            
            @include('theme::partials.blog.categories')
            @include('theme::partials.blog.posts-loop')

        </div>

        <div class="flex justify-center my-10">
            {{ $posts->links('theme::partials.pagination') }}
        </div>

    </x-container>
</x-layouts.marketing>
