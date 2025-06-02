<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('theme::partials.head', ['seo' => ($seo ?? null) ])
</head>
<body class="flex flex-col min-h-screen @if(Request::is('/')){{ 'bg-white' }}@else{{ 'bg-zinc-50' }}@endif @if(config('wave.dev_bar')){{ 'pb-10' }}@endif">

    <x-app.header></x-app.header>

    <main class="flex-grow overflow-x-hidden">
        {{ $slot }}
    </main>

    @livewire('notifications')
    @if(!auth()->guest() && auth()->user()->hasChangelogNotifications())
        @include('theme::partials.changelogs')
    @endif
    @include('theme::partials.footer-scripts')
    {{ $javascript ?? '' }}



</body>
</html>
