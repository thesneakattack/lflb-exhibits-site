<article class="border rounded overflow-hidden">
    <div class="p-4">
        <audio controls class="w-full">
            <source src="{{ Storage::disk('lflbassets')->url($asset->link) }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
        @if (!empty($asset->caption))
            <p class="text-sm text-gray-700 italic mt-2">{{ $asset->caption }}</p>
        @endif
    </div>
</article>
