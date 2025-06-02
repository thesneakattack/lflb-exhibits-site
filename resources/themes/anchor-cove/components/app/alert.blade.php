@props([
    'type' => 'default' // default, info, success, warning, danger
])

@php
    $alertIcon = 'phosphor-info-duotone';
    $alertIcon = match($type)
    {
        'default' => 'phosphor-chat-teardrop-text',
        'info' => 'phosphor-info-duotone',
        'success' => 'phosphor-check-circle-duotone',
        'warning' => 'phosphor-warning-duotone',
        'danger' => 'phosphor-warning-circle-duotone',
    };
@endphp

<div
    x-data="{ closed: false }"
    x-show="!closed"
    @class([
        'rounded-lg sm:min-w-[300px] relative flex justify-center items-center w-full px-5 py-3',
        'bg-white dark:bg-gray-900 border shadow-sm border-gray-200 dark:border-gray-800 dark:text-gray-300 text-gray-600' => $type == 'default',
		'bg-blue-50 text-blue-700 border border-blue-300' => $type == 'info',
		'bg-green-50 text-green-700 border border-green-300' => $type == 'success',
		'bg-yellow-50 text-yellow-700 border border-yellow-300' => $type == 'warning',
		'bg-red-50 text-red-600 border border-red-300' => $type == 'danger'
    ])
>
    <span
        @class([
            'w-6 h-6 cursor-pointer absolute right-0 top-0 mr-3.5 mt-3 rounded-full flex items-center justify-center',
            'hover:bg-blue-100' => $type == 'info',
            'hover:bg-green-100' => $type == 'success',
            'hover:bg-yellow-100' => $type == 'warning',
            'hover:bg-coral-100' => $type == 'danger'
        ])
        @click="closed=true"
    ><x-phosphor-x-bold class="w-4 h-4" /></span>
    <div class="flex gap-0 justify-start items-start self-stretch pr-10 w-full">
        <p class="text-sm font-normal leading-6 opacity-70 flex items-center">{{ $slot }}</p>
    </div>
</div>