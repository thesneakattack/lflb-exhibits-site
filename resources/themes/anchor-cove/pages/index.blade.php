<?php
    use function Laravel\Folio\{name};
    name('home');
?>

<x-layouts.marketing
    :seo="[
        'title'         => setting('site.title', 'Laravel Wave'),
        'description'   => setting('site.description', 'Software as a Service Starter Kit'),
        'image'         => url('/og_image.png'),
        'type'          => 'website'
    ]"
>
{{-- <x-marketing.hero></x-marketing.hero> --}}
<x-container>
    <div class="relative pt-5">
        <x-tag-filtered-content 
            model-class="App\Models\LflbStory" 
            tag-filters='{"category" : ["photos","statistics","primary-documents","print-publications"]}'
            limit="1"
            view="tag-loop"
            mode="all"
        /> 
        <x-tag-filtered-content
        model-class="\App\Models\LflbStory"
        tag-filters='{"feature": "featured-stories"}'
        view="featured-loop"
        mode="random"
        limit="3"
        />
    </div>
</x-container>
{{-- <x-marketing.waves></x-marketing.waves> --}}
{{-- <x-marketing.features></x-marketing.features> --}}
{{-- <x-marketing.wave-bottom></x-marketing.wave-bottom> --}}
{{-- <x-marketing.testimonials></x-marketing.testimonials> --}}
{{-- <x-marketing.pricing></x-marketing.pricing> --}}
</x-layouts.marketing>
