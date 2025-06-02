@props([
    'title' => '',
    'description' => ''
])

<div class="pb-5 space-y-0.5">
    <h3 class="text-xl font-semibold tracking-tight dark:text-zinc-100">{{ $title ?? '' }}</h3>
    <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ $description ?? '' }}</p>
</div>