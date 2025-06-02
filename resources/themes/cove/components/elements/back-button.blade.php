<div class="max-w-4xl md:px-5 mx-auto mt-5 lg:px-0">
    <a href="{{ $href ?? '' }}" wire:navigate class="flex items-center mb-6 font-mono text-sm font-bold text-blue-500 cursor-pointer">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        {{ $text ?? '' }}
    </a>
</div>