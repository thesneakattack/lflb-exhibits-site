<div class="flex items-center justify-start w-full sm:justify-center lg:mt-5">
    <ul class="inline-flex self-start w-auto py-2 mt-1 text-sm font-medium text-gray-600 rounded-full">
        <li class="hidden mr-4 font-bold text-black uppercase sm:block">Categories:</li>
        <li class="@if(!isset($category)){{ 'text-blue-600' }}@endif"><a href="{{ route('blog') }}">View All</a></li>
        <li class="mx-2">&middot;</li>
        @foreach(\Wave\Category::all() as $cat)
            <li class="@if(isset($category) && isset($category->slug) && ($category->slug == $cat->slug)){{ 'text-blue-700' }}@endif"><a href="{{ route('blog.category', ['category' => $cat]) }}">{{ $cat->name }}</a></li>
            @if(!$loop->last)
                <li class="mx-2">&middot;</li>
            @endif
        @endforeach
    </ul>
</div>