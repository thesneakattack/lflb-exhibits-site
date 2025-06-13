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

        {{-- Optional story body --}}
        <div class="prose max-w-4xl mx-auto mb-12">
            {!! $lflbStory->body !!}
        </div>

        @if ($lflbStory->lflbAssets->isNotEmpty())
            {{-- Split layout: media (left) and text (right) --}}
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                {{-- LEFT COLUMN: Media Assets --}}
                <div class="space-y-8">
                    @foreach ($lflbStory->lflbAssets->whereIn('type', ['IMAGE', 'VIDEO', 'AUDIO']) as $asset)
                        @switch(strtoupper($asset->type))
                            @case('IMAGE')
                                <x-lflb-asset.image :asset="$asset" />
                                @break
                            @case('VIDEO')
                                <x-lflb-asset.video :asset="$asset" />
                                @break
                            @case('AUDIO')
                                <x-lflb-asset.audio :asset="$asset" />
                                @break
                        @endswitch
                    @endforeach
                </div>

                {{-- RIGHT COLUMN: Text Assets --}}
                <div class="space-y-8 prose prose-lg">
                    @foreach ($lflbStory->lflbAssets->where('type', 'TEXT') as $asset)
                        <x-lflb-asset.text :asset="$asset" />
                    @endforeach
                </div>
            </div>
        @endif
    </x-container>
</x-layouts.marketing>