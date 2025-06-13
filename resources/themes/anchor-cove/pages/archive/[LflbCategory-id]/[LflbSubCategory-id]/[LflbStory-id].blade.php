<?php
use function Laravel\Folio\name;
name('archive.story');
?>
<x-layouts.marketing>
    <x-container>
        <div class="relative pt-10">

            <x-custom.heading
                title="{{ $lflbStory->title }}"
                description="{{ $lflbStory->description }}"
                align="left"
            />
            {{-- Optional story body --}}
            {{-- <div class="prose max-w-4xl mx-auto mb-12">
                {!! $lflbStory->body !!}
            </div> --}}

    @php
        $mediaAssets = $lflbStory->lflbAssets->whereIn('type', ['IMAGE', 'VIDEO', 'AUDIO']);
        $textAssets = $lflbStory->lflbAssets->where('type', 'TEXT');
    @endphp

    @if ($mediaAssets->isNotEmpty() || $textAssets->isNotEmpty())
        @if ($textAssets->isEmpty())
            {{-- No text assets: Display all media in 2-column order --}}
            <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 gap-8 mt-8">
                @foreach ($mediaAssets as $asset)
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
        @else
            {{-- Default split layout: media (left) and text (right) --}}
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                {{-- LEFT COLUMN: Media Assets --}}
                <div class="space-y-8">
                    @foreach ($mediaAssets as $asset)
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
                    @foreach ($textAssets as $asset)
                        <x-lflb-asset.text :asset="$asset" />
                    @endforeach
                </div>
            </div>
        @endif
    @endif
    </div>
    </x-container>
</x-layouts.marketing>