<?php
use function Laravel\Folio\name;
name('archive.story');
?>
<x-layouts.marketing>
    <x-container>
        <x-custom.heading
            title="{{ $lflbStory->title }}"
            description="Detailed view of this story"
            align="left"
        />
        <div class="prose max-w-4xl mx-auto">
            {!! $lflbStory->body !!}
        </div>

@if ($lflbStory->lflbAssets->isNotEmpty())
    <div class="max-w-5xl mx-auto space-y-10 mt-12">
        @foreach ($lflbStory->lflbAssets as $asset)
            @switch(strtoupper($asset->type))
                @case('IMAGE')
                    <x-lflb-asset.image :asset="$asset" />
                    @break

                @case('TEXT')
                    <x-lflb-asset.text :asset="$asset" />
                    @break

                @case('VIDEO')
                    <x-lflb-asset.video :asset="$asset" />
                    @break

                @case('AUDIO')
                    <x-lflb-asset.audio :asset="$asset" />
                    @break                    

                @default
                    {{-- Optional fallback for unknown types --}}
            @endswitch
        @endforeach
    </div>
@endif
    </x-container>
</x-layouts.marketing>