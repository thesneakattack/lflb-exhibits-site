@props([
    'level' => 'h1',
    'title' => 'No Heading Title Entered',
    'description' => 'Be sure to include the description attribute',
    'align' => 'center'
])


<div {{ $attributes->class([
        'relative w-full',
        'text-left' => $align == 'left',
        'text-right' => $align == 'right',
        'text-center' => $align != 'left' && $align != 'right'
    ]) }}>
    <{{ $level }} class="text-4xl font-extrabold sm:text-center text-left text-gray-900 lg:text-5xl">{!! $title!!}</{{ $level }}>
    <p class="w-full my-1 text-base text-gray-900 opacity-75 sm:text-center text-left sm:my-2 sm:text-xl">It's easy to customize the pricing of your Software as a Service</p>
</div>