<div class="grid gap-5 mx-auto mt-10 sm:grid-cols-2 lg:grid-cols-3">
    <!-- Loop Through Items Here -->
    @foreach ($items as $story)
    @php
        $firstTextAsset = $story->lflbAssets
            ->where('type', 'TEXT')
            ->sortBy('position')
            ->first();
    @endphp    
    <article id="post-{{ $story->id }}" class="flex overflow-hidden flex-col rounded-lg shadow-lg" typeof="Article">

        <meta property="name" content="{{ $story->title }}">
        <meta property="author" typeof="Person" content="admin">
        <meta property="dateModified" content="{{ Carbon\Carbon::parse($story->updated_at)->toIso8601String() }}">
        <meta class="uk-margin-remove-adjacent" property="datePublished" content="{{ Carbon\Carbon::parse($story->created_at)->toIso8601String() }}">

        <div class="flex-shrink-0">
            <a href="/story/{{ $story->id }}">
                <img class="object-cover w-full h-48" src="{{ $story->main_image_url() }}" alt="">
            </a>
        </div>
        <div class="flex relative flex-col flex-1 justify-between p-6 bg-white">
            <div class="flex-1">
                <a href="/story/{{ $story->id }}" class="block">
                    <h3 class="mt-2 text-xl font-semibold leading-7 text-zinc-900">
                        {{ $story->title }}
                    </h3>
                </a>
                <a href="/story/{{ $story->id }}" class="block">
                    <p class="mt-3 text-base leading-6 text-zinc-500">
                        {{ \Illuminate\Support\Str::limit(strip_tags($story->description ?? ''), 200) }}
                    </p>
                    @if ($firstTextAsset)
                        <p class="mt-3 text-base leading-6 text-zinc-500">
                            {{ \Illuminate\Support\Str::limit(strip_tags($firstTextAsset->cleanText ?? ''), 200) }}
                        </p>
                    @endif                        
                </a>
            </div>
            {{-- <p class="inline-block relative self-start px-2 py-1 mt-4 text-xs font-medium leading-5 uppercase rounded text-zinc-400 bg-zinc-100">
                <a href="#" class="text-zinc-700 hover:underline" rel="category">
                    {{ $story->title }}
                </a>
            </p> --}}
        </div>

        {{-- <div class="flex items-center p-6 bg-zinc-50">
            <div class="flex-shrink-0">
                <img class="w-10 h-10 rounded-full" src="" alt="Author avatar">
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium leading-5 text-zinc-900">
                    Written by <span class="hover:underline">AUTHOR</span>
                </p>
                <div class="flex text-sm leading-5 text-zinc-500">
                    on <time datetime="{{ Carbon\Carbon::parse($story->created_at)->toIso8601String() }}" class="ml-1">
                        {{ Carbon\Carbon::parse($story->created_at)->toFormattedDateString() }}
                    </time>
                </div>
            </div>
        </div> --}}

    </article>
    @endforeach
    <!-- End Loop -->
</div>
