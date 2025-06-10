<article class="border rounded overflow-hidden">
    <div class="aspect-w-16 aspect-h-9">
        <video controls class="w-full h-auto">
            <source src="{{ Storage::disk('lflbassets')->url($asset->link) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    <div class="p-4">
        @if (!empty($asset->caption))
            <p class="text-sm text-gray-700 italic">{{ $asset->caption }}</p>
        @endif
    </div>
</article>