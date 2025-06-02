<section class="relative z-40 pt-10 pb-16 w-full bg-gradient-to-b from-blue-500 via-blue-600 to-blue-400 lg:pt-5 xl:-mt-24">
    <div class="flex relative z-20 flex-col justify-start items-start px-8 mx-auto max-w-7xl sm:items-center xl:px-5">
        <h2 class="text-4xl font-medium leading-9 text-white">Awesome Features</h2>
        <p class="mt-4 leading-6 text-blue-200 sm:text-center">Wave has some cool features to help you rapidly build your Software as a Service.<br class="hidden md:block"> Here are a few awesome features you're going to love!</p>

        <div class="grid gap-y-10 mt-16 sm:grid-cols-2 sm:gap-x-8 md:gap-x-12 lg:grid-cols-3 xl:grid-cols-4 lg:gap-20">
            @foreach(config('features') as $feature)
                <div>
                    <img src="{{ $feature->image }}" class="w-16 rounded sm:mx-auto">
                    <h3 class="mt-6 text-sm font-semibold leading-6 text-blue-100 sm:text-center">{{ $feature->title }}</h3>
                    <p class="mt-2 text-sm leading-5 text-blue-200 sm:text-center">{{ $feature->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>