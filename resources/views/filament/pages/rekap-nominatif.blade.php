<x-filament-panels::page>
    <div x-data="{ tab: 'rekap-kolektibilitas' }" class="flex gap-6">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r rounded-lg p-4">
            @include('filament.pages.rekap-nominatif-sidebar')
        </aside>
        <!-- Content -->
        <main class="flex-1">
            <div x-show="tab === 'rekap-kolektibilitas'">
                <h2 class="text-xl font-bold mb-4">Rekap Kolektibilitas</h2>
                @livewire('rekap-kolektibilitas')
            </div>
            <div x-show="tab === 'rekap-outstanding'">
                <h2 class="text-xl font-bold mb-4">Rekap Outstanding</h2>
                <p>Konten rekap outstanding akan ditampilkan di sini.</p>
            </div>
        </main>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('tabSwitcher', () => ({
                tab: 'rekap-kolektibilitas',
                init() {
                    this.$watch('tab', value => {
                        // Optional: handle tab change
                    });
                    this.$root.addEventListener('change-tab', (e) => {
                        this.tab = e.detail;
                    });
                }
            }));
        });
    </script>
</x-filament-panels::page>
