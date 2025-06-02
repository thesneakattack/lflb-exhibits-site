
<section class="max-w-6xl px-6 pt-10 mx-auto md:px-8">

    <x-marketing.heading
        title="Pricing Plans"
        description="Everything you need to help you succeed. Simple transparent pricing to fit businesses of any size."
        align="center"
    />

    <div x-data="{ on: false, billing: '{{ get_default_billing_cycle() }}',
            toggleRepositionMarker(toggleButton){
                this.$refs.marker.style.width=toggleButton.offsetWidth + 'px';
                this.$refs.marker.style.height=toggleButton.offsetHeight + 'px';
                this.$refs.marker.style.left=toggleButton.offsetLeft + 'px';
            }
         }" 
        x-init="
                setTimeout(function(){ 
                    toggleRepositionMarker($refs.monthly); 
                    $refs.marker.classList.remove('opacity-0');
                    setTimeout(function(){ 
                        $refs.marker.classList.add('duration-300', 'ease-out');
                    }, 10); 
                }, 1);
        "
        class="w-full mx-auto my-12" x-cloak>

        @if(has_monthly_yearly_toggle())
            <div class="relative flex items-center justify-start pb-5 -translate-y-2 sm:justify-center">
                <div class="relative inline-flex items-center justify-center w-auto p-1 text-center -translate-y-3 border-2 border-blue-600 rounded-full sm:mx-auto">
                    <div x-ref="monthly" x-on:click="billing='Monthly'; toggleRepositionMarker($el)" :class="{ 'text-white': billing == 'Monthly' }" class="relative z-20 px-3.5 py-1 text-sm font-medium leading-6 text-gray-900 rounded-full duration-300 ease-out cursor-pointer">
                        Monthly
                    </div>
                    <div x-ref="yearly" x-on:click="billing='Yearly'; toggleRepositionMarker($el)" :class="{ 'text-white': billing == 'Yearly' }" class="relative z-20 px-3.5 py-1 text-sm font-medium leading-6 text-gray-900 rounded-full duration-300 ease-out cursor-pointer">
                        Yearly
                    </div>
                    <div x-ref="marker" class="absolute left-0 z-10 w-1/2 h-full opacity-0" x-cloak>
                        <div class="w-full h-full bg-blue-600 rounded-full shadow-sm"></div>
                    </div>
                </div>  
            </div>
        @endif

        <div class="flex flex-col flex-wrap lg:flex-row lg:space-x-5">

            @foreach(Wave\Plan::where('active', 1)->get() as $plan)
                @php $features = explode(',', $plan->features); @endphp
                <div 
                    {{--  Say that you have a monthly plan that doesn't have a yearly plan, in that case we will hide the place that doesn't have a price_id --}}
                    x-show="(billing == 'Monthly' && '{{ $plan->monthly_price_id }}' != '') || (billing == 'Yearly' && '{{ $plan->yearly_price_id }}' != '')" 
                    class="flex-1 px-0 mx-auto mb-6 w-full sm:max-w-lg lg:mb-0 @if($plan->default) lg:scale-105 @endif" x-cloak>
                    <div class="relative flex flex-col h-full mb-10 bg-white border rounded-lg shadow-xl border-zinc-200 text-zinc-800 sm:mb-0">
                    
                        
                        <div class="px-10 pt-7">
                            <div class="absolute right-0 inline-block mr-6 transform">
                                <h2 class="relative z-20 w-full h-full px-2 py-1 text-xs font-bold leading-tight tracking-wide text-center uppercase bg-white border-2 @if($plan->default){{ 'border-blue-400 text-blue-500' }}@else{{ 'border-zinc-900 text-zinc-800' }}@endif rounded">{{ $plan->name }}</h2>
                            </div>
                        </div>


                        <div class="px-8 mt-5">
                            <span class="font-mono text-5xl font-bold">$<span x-text="billing == 'Monthly' ? '{{ $plan->monthly_price }}' : '{{ $plan->yearly_price }}'"></span></span>
                            <span class="text-xl font-bold text-gray-500"><span x-text="billing == 'Monthly' ? 'per month' : 'per year'"></span></span>
                        </div>

                        <div class="px-8 mt-3">
                            <p class="text-base leading-7 text-gray-500">{{ $plan->description }}</p>
                        </div>

                        <div class="p-8 mt-auto rounded-b-lg">
                            <ul class="flex flex-col">
                                @foreach($features as $feature)
                                    <li class="mt-1">
                                        <span class="flex items-center text-green-500">
                                            <svg class="w-4 h-4 mr-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"></path></svg>
                                            <span class="text-gray-700">
                                                {{ $feature }}
                                            </span>
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="overflow-hidden rounded-b-lg">
                            <x-button class="w-full rounded-tl-none rounded-tr-none" :color="($plan->default) ? 'info' : null" tag="a" size="lg" href="/settings/subscription">
                                Get Started
                            </x-button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <p class="w-full text-center -translate-y-12 lg:my-8 lg:translate-y-0 text-zinc-500 sm:my-10">All plans are fully configurable in the Admin Area.</p>

    
</section>
