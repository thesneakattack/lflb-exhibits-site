<header x-data="{ mobileMenuOpen: false }" class="relative z-30 @if(Request::is('/')){{ 'bg-white' }}@else{{ 'bg-zinc-50' }}@endif">
    <x-app.container-full>
        <div class="relative z-30 flex items-center justify-between h-24 md:space-x-6">
            <div class="inline-flex">
                <a href="{{ route('home') }}" class="flex items-center justify-center space-x-3 text-blue-500 transition-all duration-1000 ease-out transform">
                   <x-logo class="w-auto h-8"></x-logo>
                </a>
            </div>
            <div class="flex justify-end flex-grow -my-2 -mr-2 md:hidden">
                <button x-show="!mobileMenuOpen" @click="mobileMenuOpen = true" type="button" class="inline-flex items-center justify-center p-2 transition duration-150 ease-in-out rounded-full text-zinc-400 hover:text-zinc-500 hover:bg-zinc-100 focus:outline-none focus:bg-zinc-100 focus:text-zinc-500">
                    <svg class="w-6 h-6" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path></svg>
                </button>
                <button x-show="mobileMenuOpen" @click="mobileMenuOpen = false" type="button" class="inline-flex items-center justify-center p-2 transition duration-150 ease-in-out rounded-full text-zinc-400 hover:text-zinc-500 hover:bg-zinc-100 focus:outline-none focus:bg-zinc-100 focus:text-zinc-500" x-cloak>
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div x-data="{ open: false }" class="flex h-full md:flex-1">
                <nav class="flex-1 hidden h-full space-x-4 lg:space-x-5 xl:space-x-8 md:flex">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none @if(Request::is('dashboard')){{ 'text-zinc-900' }}@else{{ 'text-zinc-500 hover:text-zinc-900' }}@endif">Dashboard</a>
                    <div x-data="{ dropdown: false }" @mouseenter="dropdown = true" @mouseleave="dropdown=false" @click.away="dropdown=false" class="relative inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out border-b-2 border-transparent cursor-pointer text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 focus:outline-none focus:text-zinc-700 focus:border-zinc-300">
                        <span>Resources</span>
                        <svg class="w-5 h-5 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <div x-show="dropdown"
                            x-transition:enter="duration-200 ease-out scale-95"
                            x-transition:enter-start="opacity-50 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition duration-100 ease-in scale-100"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute top-0 w-screen max-w-xs px-2 mt-20 transform -translate-x-1/2 left-1/2 sm:px-0" x-cloak>
                            <div class="border shadow-md rounded-xl border-zinc-100">
                                <div class="overflow-hidden shadow-xs rounded-xl">
                                    <div class="relative z-20 grid gap-6 px-5 py-6 bg-white sm:p-8 sm:gap-8">
                                        <a href="https://devdojo.com/wave/docs" target="_blank" class="block px-5 py-3 -m-3 space-y-1 transition duration-150 ease-in-out rounded-xl hover:bg-zinc-100">
                                            <p class="text-base font-medium leading-6 text-zinc-900">
                                                Documentation
                                            </p>
                                            <p class="text-xs leading-5 text-zinc-500">
                                                View The Wave Docs
                                            </p>
                                        </a>
                                        <a href="https://devdojo.com/course/wave" target="_blank" class="block px-5 py-3 -m-3 space-y-1 transition duration-150 ease-in-out rounded-xl hover:bg-zinc-100">
                                            <p class="text-base font-medium leading-6 text-zinc-900">
                                                Videos
                                            </p>
                                            <p class="text-xs leading-5 text-zinc-500">
                                                Watch videos to learn how to use Wave.
                                            </p>
                                        </a>
                                        <a href="{{ route('blog') }}" class="block px-5 py-3 -m-3 space-y-1 transition duration-150 ease-in-out rounded-xl hover:bg-zinc-100">
                                            <p class="text-base font-medium leading-6 text-zinc-900">
                                                From The Blog
                                            </p>
                                            <p class="text-xs leading-5 text-zinc-500">
                                                View your application blog.
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <a href="https://devdojo.com/questions" target="_blank" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out text-zinc-500 hover:text-zinc-700 focus:outline-none focus:text-zinc-700 focus:border-zinc-300">Questions</a>
                    <a href="/changelog" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out text-zinc-500 hover:text-zinc-700 focus:outline-none focus:text-zinc-700 focus:border-zinc-300">Changelog</a>
                </nav>

                <div class="flex lg:ml-6 sm:items-center">
                    @if( auth()->user()->onTrial() )
                        <div class="relative items-center justify-center hidden h-full md:flex">
                            <span class="px-3 py-1 text-xs text-red-600 bg-red-100 border rounded-md border-zinc-200">You have {{ auth()->user()->daysLeftOnTrial() }} @if(auth()->user()->daysLeftOnTrial() > 1){{ 'Days' }}@else{{ 'Day' }}@endif left on your Trial</span>
                        </div>
                    @endif                
                    <x-app.notifications-dropdown></x-app.notifications-dropdown>
                    <x-app.user-dropdown></x-app.user-dropdown>
                </div>
            </div>
        </div>
    </x-app.container.full>

    {{-- Mobile Menu --}}
    <div x-show="mobileMenuOpen" x-transition:enter="duration-300 ease-out scale-100" x-transition:enter-start="opacity-50" x-transition:enter-end="opacity-100" x-transition:leave="transition duration-75 ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-x-0 top-0 transition origin-top transform md:hidden">
        <div class="rounded-lg shadow-lg">
            <div class="bg-white divide-y-0 rounded-lg shadow-xs divide-zinc-50">
                <div class="px-8 pt-24 pb-8">
                    <nav class="grid row-gap-8">
                        <a href="{{ route('dashboard') }}" class="flex items-center p-3 -mx-2 space-x-3 transition duration-150 ease-in-out rounded-md hover:bg-zinc-50">
                            <x-phosphor-house-duotone class="flex-shrink-0 w-6 h-6 text-blue-600" />
                            <div class="text-base font-medium leading-6 text-zinc-900">
                                Dashboard
                            </div>
                        </a>
                        <a href="https://wave.devdojo.com/docs" target="_blank" class="flex items-center p-3 -mx-2 space-x-3 transition duration-150 ease-in-out rounded-md hover:bg-zinc-50">
                            <x-phosphor-book-duotone class="flex-shrink-0 w-6 h-6 text-blue-600" />
                            <div class="text-base font-medium leading-6 text-zinc-900">
                                Documentation
                            </div>
                        </a>
                        <a href="https://devdojo.com/course/wave" target="_blank" class="flex items-center p-3 -mx-2 space-x-3 transition duration-150 ease-in-out rounded-md hover:bg-zinc-50">
                            <x-phosphor-video-duotone class="flex-shrink-0 w-6 h-6 text-blue-600" />
                            <div class="text-base font-medium leading-6 text-zinc-900">
                                Videos
                            </div>
                        </a>
                        <a href="{{ route('blog') }}" class="flex items-center p-3 -mx-2 space-x-3 transition duration-150 ease-in-out rounded-md hover:bg-zinc-50">
                            <x-phosphor-newspaper-duotone class="flex-shrink-0 w-6 h-6 text-blue-600" />
                            <div class="text-base font-medium leading-6 text-zinc-900">
                                Blog
                            </div>
                        </a>
                        <a href="https://devdojo.com/questions" target="_blank" class="flex items-center p-3 -mx-2 space-x-3 transition duration-150 ease-in-out rounded-md hover:bg-zinc-50">
                            <x-phosphor-lifebuoy-duotone class="flex-shrink-0 w-6 h-6 text-blue-600" />
                            <div class="text-base font-medium leading-6 text-zinc-900">
                                Questions
                            </div>
                        </a>
                        <a href="/changelog" class="flex items-center p-3 -mx-2 space-x-3 transition duration-150 ease-in-out rounded-md hover:bg-zinc-50">
                            <x-phosphor-note-duotone class="flex-shrink-0 w-6 h-6 text-blue-600" />
                            <div class="text-base font-medium leading-6 text-zinc-900">
                                Changelog
                            </div>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- End Mobile Menu --}}
</header>
