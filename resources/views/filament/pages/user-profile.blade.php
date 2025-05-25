<x-filament::page>
    <div class="rounded-xl overflow-hidden bg-white shadow mb-8">
        @include('filament.pages.user-profile.components.avatar-section')
        @include('filament.pages.user-profile.components.stats-section')
    </div>

    {{-- Bagian main --}}
    <div class="main flex flex-col md:flex-row gap-6">
        @include('filament.pages.user-profile.components.info-section')
        @include('filament.pages.user-profile.components.monitoring-table')
    </div>
</x-filament::page>
