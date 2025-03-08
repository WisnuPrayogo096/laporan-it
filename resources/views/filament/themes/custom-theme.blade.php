<x-filament-panels::page>
    {{ $slot }}

    <div class="text-center text-gray-500 text-sm py-4">
        &copy; {{ now()->year }} IT Helpdesk | All Rights Reserved
    </div>
</x-filament-panels::page>
