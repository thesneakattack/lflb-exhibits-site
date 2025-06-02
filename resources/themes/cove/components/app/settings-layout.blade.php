<x-app.container-full>

    
    <div class="flex space-x-2 sm:space-x-6">
        <aside class="flex-shrink-0 space-y-2 sm:space-y-6 lg:w-64">
            <x-card class="py-2 sm:py-6">
                <h3 class="hidden px-6 pb-3 text-xs font-semibold leading-4 tracking-wider uppercase text-zinc-500 md:block">Settings</h3>
                <nav class="space-y-1">
                    <x-settings-sidebar-link :href="route('settings.profile')" icon="phosphor-user-circle-duotone" :active="Request::is('settings/profile')">Profile</x-settings-sidebar-link>
                    <x-settings-sidebar-link :href="route('settings.security')" icon="phosphor-lock-duotone" :active="Request::is('settings/security')">Security</x-settings-sidebar-link>
                    <x-settings-sidebar-link :href="route('settings.api')" icon="phosphor-code-duotone" :active="Request::is('settings/api')">API Keys</x-settings-sidebar-link>
                </nav>
            </x-card>
                
            <x-card class="py-2 sm:py-6">
                <h3 class="hidden px-6 pb-3 text-xs font-semibold leading-4 tracking-wider uppercase text-zinc-500 md:block">Billing</h3>
                <nav class="space-y-1">
                    <x-settings-sidebar-link :href="route('settings.subscription')" icon="phosphor-credit-card-duotone" :active="Request::is('settings/subscriptions')">Subscription</x-settings-sidebar-link>
                    <x-settings-sidebar-link :href="route('settings.invoices')" icon="phosphor-invoice-duotone" :active="Request::is('settings/invoices')">Invoices</x-settings-sidebar-link>
                </nav>
            </x-card>
        </aside>

        <x-card>
            <div class="flex flex-wrap items-center justify-between border-b border-gray-200 dark:border-zinc-800 sm:flex-no-wrap">
                <div class="relative p-6">
                    <div class="space-y-0.5">
                        <h2 class="text-xl font-semibold tracking-tight dark:text-zinc-100">{{ $title ?? '' }}</h2>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ $description ?? '' }}</p>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 lg:w-full">
                {{ $slot }}
            </div>
        </x-card>
</x-app.container-full>