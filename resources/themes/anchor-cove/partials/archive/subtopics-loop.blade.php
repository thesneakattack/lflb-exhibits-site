<div class="grid gap-5 mx-auto mt-10 sm:grid-cols-2 lg:grid-cols-3">
    <!-- Loop Through Topics Here -->
    @foreach ($subtopics as $subtopic)
        <article class="flex flex-col overflow-hidden rounded-lg shadow-lg" id="post-{{ $subtopic->id }}" typeof="Article">
            <meta property="name" content="{{ $subtopic->title }}" />
            <meta typeof="Person" property="author" content="admin" />
            <meta property="dateModified" content="{{ Carbon\Carbon::parse($subtopic->updated_at)->toIso8601String() }}" />
            <meta class="uk-margin-remove-adjacent" property="datePublished"
                content="{{ Carbon\Carbon::parse($subtopic->created_at)->toIso8601String() }}" />

            <div class="flex-shrink-0">
                <a href="/archive/{{ $lflbCategory->id }}/{{ $subtopic->id }}">
                    <img class="object-cover w-full h-48" src="{{ $subtopic->main_image_url() }}" alt="" />
                </a>
            </div>
            <div class="relative flex flex-col justify-between flex-1 p-6 bg-white">
                <div class="flex-1">
                    <a class="block" href="/archive/{{ $lflbCategory->id }}/{{ $subtopic->id }}">
                        <h3 class="mt-2 text-xl font-semibold leading-7 text-zinc-900">
                            {{ $subtopic->title }}
                        </h3>
                    </a>
                </div>
                <p
                    class="relative self-start inline-block px-2 py-1 mt-4 text-xs font-medium leading-5 uppercase rounded text-zinc-400 bg-zinc-100">
                    <a class="text-zinc-700 hover:underline" href="/archive/{{ $lflbCategory->id }}/{{ $subtopic->id }}" rel="category">
                        {{ $subtopic->title }}
                    </a>
                </p>
            </div>

            <div class="flex items-center p-6 bg-zinc-50">
                <div class="flex-shrink-0">
                    <a href="#">
                        <img class="w-10 h-10 rounded-full" src="" alt="" />
                    </a>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium leading-5 text-zinc-900">
                        Written by
                        <a class="hover:underline" href="#">AUTHOR</a>
                    </p>
                    <div class="flex text-sm leading-5 text-zinc-500">
                        on
                        <time class="ml-1"
                            datetime="{{ Carbon\Carbon::parse($subtopic->created_at)->toIso8601String() }}">
                            {{ Carbon\Carbon::parse($subtopic->created_at)->toFormattedDateString() }}
                        </time>
                    </div>
                </div>
            </div>
        </article>
    @endforeach

    <!-- End Post Loop Here -->
</div>
