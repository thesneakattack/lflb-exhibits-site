<div class="grid gap-5 mx-auto mt-10 sm:grid-cols-2 lg:grid-cols-3">

    <!-- Loop Through Posts Here -->
    @foreach($posts as $post)
    <article id="post-{{ $post->id }}" class="flex overflow-hidden flex-col rounded-lg shadow-lg" typeof="Article">

        <meta property="name" content="{{ $post->title }}">
        <meta property="author" typeof="Person" content="admin">
        <meta property="dateModified" content="{{ Carbon\Carbon::parse($post->updated_at)->toIso8601String() }}">
        <meta class="uk-margin-remove-adjacent" property="datePublished" content="{{ Carbon\Carbon::parse($post->created_at)->toIso8601String() }}">

        <div class="flex-shrink-0">
            <a href="{{ $post->link() }}">
                <img class="object-cover w-full h-48" src="{{ $post->image() }}" alt="">
            </a>
        </div>
        <div class="flex relative flex-col flex-1 justify-between p-6 bg-white">
            <div class="flex-1">
                <a href="{{ $post->link() }}" class="block">
                    <h3 class="mt-2 text-xl font-semibold leading-7 text-zinc-900">
                        {{ $post->title }}
                    </h3>
                </a>
                <a href="{{ $post->link() }}" class="block">
                    <p class="mt-3 text-base leading-6 text-zinc-500">
                        {{ substr(strip_tags($post->body), 0, 200) }}@if(strlen(strip_tags($post->body)) > 200){{ '...' }}@endif
                    </p>
                </a>
            </div>
            <p class="inline-block relative self-start px-2 py-1 mt-4 text-xs font-medium leading-5 uppercase rounded text-zinc-400 bg-zinc-100">
                <a href="/blog/{{ $post->category->slug }}" class="text-zinc-700 hover:underline" rel="category">
                    {{ $post->category->name }}
                </a>
            </p>
        </div>

        <div class="flex items-center p-6 bg-zinc-50">
            <div class="flex-shrink-0">
                <a href="#">
                    <img class="w-10 h-10 rounded-full" src="{{ $post->user->avatar() }}" alt="">
                </a>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium leading-5 text-zinc-900">
                    Written by <a href="#" class="hover:underline">{{ $post->user->name }}</a>
                </p>
                <div class="flex text-sm leading-5 text-zinc-500">
                    on <time datetime="{{ Carbon\Carbon::parse($post->created_at)->toIso8601String() }}" class="ml-1">{{ Carbon\Carbon::parse($post->created_at)->toFormattedDateString() }}</time>
                </div>
            </div>
        </div>

    </article>
    @endforeach
    <!-- End Post Loop Here -->
</div>