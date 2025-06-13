<article class="border rounded-lg overflow-hidden">
    <div class="relative w-full max-w-4xl mx-auto">
        <img
            src="{{ Storage::disk('lflbassets')->url($asset->link) }}"
            alt="{{ $asset->caption }}"
            class="mx-auto max-h-[80vh] w-auto h-auto object-contain rounded"
        />
    </div>

    <div class="p-4">
        @if (!empty($asset->caption))
            <p class="text-sm text-gray-700 italic text-center">{{ $asset->caption }}</p>
        @endif
    </div>
</article>