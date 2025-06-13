<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach ($items as $item)
        {{-- <x-custom.article-card :item="$item" /> --}}
        @php(dump($item))
    @endforeach
</div>
{{-- 
USAGE:
<x-tag-filtered-content
    model-class="App\\Models\\LflbStory"
    tag-filters='{"primary": "biography", "section": "hero"}'
    limit="1"
    view="default" />
--}
