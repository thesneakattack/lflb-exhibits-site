<?php
    use function Laravel\Folio\{middleware, name};
    middleware('auth');
    name('dashboard');
?>

<x-layouts.app>
    <x-app.container-full>
        <div class="flex flex-col w-full lg:flex-row lg:pb-0 pb-5">
            <div class="flex flex-col justify-start flex-1 mb-5 overflow-hidden bg-white border rounded-xl lg:mr-3 lg:mb-0 border-zinc-150">
                <div class="flex flex-wrap items-center justify-between p-6 bg-white border-b border-zinc-150 sm:flex-no-wrap">
                    <div class="relative flex-1">
                        <h3 class="text-lg font-medium leading-6 text-zinc-700">Welcome to your Dashboard</h3>
                        <p class="text-sm leading-5 text-zinc-500 mt">Learn More Below</p>
                    </div>
                </div>
                <div class="relative p-6 text-sm">
                    <p class="leading-loose text-zinc-500">This is your application <a href="{{ route('dashboard') }}" class="text-blue-500 underline">dashboard</a>, you can customize this view inside of <span class="sm:hidden inline">the cove theme folder.</span> <code class="px-2 py-1 font-mono font-medium sm:inline hidden rounded-md text-zinc-600 bg-zinc-100">{{ theme_folder('/dashboard/index.blade.php') }}</code><br><br> (Themes are located inside the <code>resources/themes</code> folder)</p>
                    <span class="inline-flex mt-5 rounded-md shadow-sm">
                        <a href="{{ url('docs') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 transition duration-150 ease-in-out bg-white border rounded-md text-zinc-700 border-zinc-300 hover:text-zinc-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-zinc-800 active:bg-zinc-50">
                            Read The Docs
                        </a>
                    </span>
                </div>
            </div>
            <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-xl lg:ml-3 border-zinc-150">
                <div class="flex flex-wrap items-center justify-between p-6 bg-white border-b border-zinc-150 sm:flex-no-wrap">
                    <div class="relative flex-1">
                        <h3 class="text-lg font-medium leading-6 text-zinc-700">Learn more about Wave</h3>
                        <p class="text-sm leading-5 text-zinc-500 mt">Are you more of a visual learner?</p>
                    </div>
                </div>
                <div class="relative p-6 text-sm">
                    <p class="leading-loose text-zinc-500">Make sure to head on over to the Wave Video Tutorials to learn more how to use and customize Wave.<br><br>Click on the button below to checkout the video tutorials.</p>
                    <span class="inline-flex mt-5 rounded-md shadow-sm">
                        <a href="https://devdojo.com/course/wave" target="_blank" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 transition duration-150 ease-in-out bg-white border rounded-md text-zinc-700 border-zinc-300 hover:text-zinc-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-zinc-800 active:bg-zinc-50">
                            Watch The Videos
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </x-app.container-full>
</x-layouts.app>
