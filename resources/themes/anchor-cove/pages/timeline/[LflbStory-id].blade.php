<?php
use function Laravel\Folio\name;
name('timeline.story');
?>

<x-layouts.marketing>
    @php
        $breadcrumbs = [
            // ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Timeline', 'url' => route('timeline')],
            ['label' => $lflbStory->title, 'url' => null],
        ];
    @endphp      
    <x-container>
        <div class="relative py-5">

            <x-custom.df-breadcrumbs :breadcrumbs="$breadcrumbs" />
            <x-custom.df-heading
                title="{{ $lflbStory->title }}"
                description="{{ $lflbStory->description }}"
                align="left"
            />

            @php
                $imageAsset = $lflbStory->lflbAssets->where('type', 'IMAGE')->first();
            @endphp

            @if ($imageAsset)
                <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 mt-10 items-center">
                    {{-- Left: Preview Image + Caption --}}
                    <div>
                        <img src="{{ Storage::disk('lflbassets')->url($imageAsset->link) }}"
                             alt="{{ $lflbStory->title }}"
                             class="w-full h-auto max-h-[400px] object-contain rounded shadow mb-2">
                        @if ($imageAsset->caption)
                            <p class="text-sm text-zinc-500 italic">{{ $imageAsset->caption }}</p>
                        @endif
                    </div>

                    {{-- Right: Title & Description --}}
                    <div class="space-y-4">
                        <h2 class="text-2xl font-bold text-zinc-900">{{ $lflbStory->title }}</h2>
                        <p class="text-zinc-700 text-base leading-relaxed">{{ $lflbStory->description }}</p>
                    </div>
                </div>
            @endif

            @php
                $mediaAssets = $lflbStory->lflbAssets
                    ->whereIn('type', ['IMAGE', 'VIDEO', 'AUDIO'])
                    ->values()
                    ->slice($imageAsset ? 1 : 0); // Skip first IMAGE asset if shown above

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
