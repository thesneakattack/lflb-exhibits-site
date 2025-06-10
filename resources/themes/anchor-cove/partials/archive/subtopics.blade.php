<div class="flex items-center justify-start w-full sm:justify-center lg:mt-5">
    <ul class="inline-flex self-start w-auto py-2 mt-1 text-sm font-medium text-gray-600 rounded-full">
        <li class="hidden mr-4 font-bold text-black uppercase sm:block">Topics:</li>
        <li class="@if(!isset($topic)){{ 'text-blue-600' }}@endif"><a href="{{ route("archive") }}">View All</a></li>
        <li class="mx-2">&middot;</li>
        @foreach (\App\Models\LflbCategory::all() as $cat)
            <li class="@if(isset($topic) && isset($topic->title) && ($topic->title == $cat->title)){{ 'text-blue-700' }}@endif">
                <a href="{{ route("archive.topic", ["lflbCategory" => $cat]) }}">{{ $cat->id }}</a>
            </li>
            @if (! $loop->last)
                <li class="mx-2">&middot;</li>
            @endif
        @endforeach
    </ul>
</div>
