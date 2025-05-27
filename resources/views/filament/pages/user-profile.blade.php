<x-filament::page>
    <div class="rounded-xl overflow-hidden bg-white shadow mb-8">
        @include('filament.pages.user-profile.components.avatar-section')
        @include('filament.pages.user-profile.components.stats-section')
    </div>

    {{-- Bagian main --}}
    <div class="main flex flex-col md:flex-row gap-6" 
        x-data="{
            showDetailModal: false,
            selectedRecord: null,
            showImageModal: false,
            selectedImage: null
        }"
        x-on:show-kredit-detail.window="
            showDetailModal = true;
            fetch(`/api/monitoring-kredit/${$event.detail.id}`)
                .then(response => response.json())
                .then(data => {
                    selectedRecord = data;
                })
                .catch(error => console.error('Error:', error));
        ">
        @include('filament.pages.user-profile.components.info-section')
        @livewire('monitoring-table-filter', ['userId' => $user->id])
        
        <!-- Detail Modal -->
        <div x-show="showDetailModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"  @click="showDetailModal = false">

            <!-- Modal Overlay -->
            <div class="fixed inset-0 bg-gray-900 bg-opacity-75" style="background-color:rgba(0, 0, 0, 0.75) !important;">
            </div>

            <div class="relative min-h-screen flex items-center justify-center p-4">
                <!-- Modal Content -->
                <div class="relative bg-white rounded-xl shadow-2xl max-w-2xl w-full mx-auto z-[9998]" @click.stop>

                    <!-- Modal Header -->
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Detail Monitoring</h3>
                            <button @click="showDetailModal = false"
                                class="text-gray-400 hover:text-gray-500 focus:outline-none">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Modal Body -->
                    <div class="px-6 py-4 max-h-[calc(100vh-200px)] overflow-y-auto">
                        <div class="space-y-6">
                            <!-- Info Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Kolom 1 -->
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <label class="text-sm font-medium text-gray-500">Tanggal</label>
                                    <p class="mt-1 text-sm text-gray-900"
                                        x-text="selectedRecord ? new Date(selectedRecord.created_at).toLocaleDateString('id-ID', {weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'}) : '-'">
                                    </p>
                                </div>

                                <!-- Kolom 2 -->
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <label class="text-sm font-medium text-gray-500">CIF</label>
                                    <p class="mt-1 text-sm text-gray-900" x-text="selectedRecord?.CIF || '-'">
                                    </p>
                                </div>

                                <!-- Kolom 3 -->
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <label class="text-sm font-medium text-gray-500">Nomor Rekening</label>
                                    <p class="mt-1 text-sm text-gray-900" x-text="selectedRecord?.NOMOR_REKENING || '-'">
                                    </p>
                                </div>

                                <!-- Kolom 4 -->
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <label class="text-sm font-medium text-gray-500">Nama Nasabah</label>
                                    <p class="mt-1 text-sm text-gray-900" x-text="selectedRecord?.NAMA_NASABAH || '-'">
                                    </p>
                                </div>

                                <!-- Kolom 5 -->
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <label class="text-sm font-medium text-gray-500">Tindakan</label>
                                    <p class="mt-1 text-sm text-gray-900" x-text="selectedRecord?.TINDAKAN || '-'"></p>
                                </div>

                                <!-- Kolom 6 -->
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <label class="text-sm font-medium text-gray-500">Pembayaran</label>
                                    <p class="mt-1 text-sm text-gray-900"
                                        x-text="selectedRecord ? new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(selectedRecord.PEMBAYARAN || 0) : '-'">
                                    </p>
                                </div>
                            </div>

                            <!-- Hasil Tindakan -->
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <label class="text-sm font-medium text-gray-500">Hasil Tindakan</label>
                                <p class="mt-1 text-sm text-gray-900 whitespace-pre-wrap"
                                    x-text="selectedRecord?.HASIL_TINDAKAN || '-'"></p>
                            </div>
                            <template x-if="selectedRecord">
                                <a
                                    :href="`/admin/nominatif-kredits/${selectedRecord.NOMOR_REKENING}/detail`"
                                    class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium tracking-tight rounded-lg transition bg-success hover:bg-success-500 focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-success-600 text-white"
                                    style="text-decoration: none;background-color: #276749 !important;"
                                >
                                    Detail Debitur
                                </a>
                            </template>

                            <!-- Bukti Tindakan Gallery -->
                            <template x-if="selectedRecord?.bukti_tindakan && selectedRecord.bukti_tindakan.length > 0">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-500">Bukti Tindakan</label>

                                    <!-- Container scroll hanya untuk gambar -->
                                    <div
                                        class="max-h-[320px] overflow-y-auto pr-2 border border-gray-200 rounded-lg p-2 bg-white">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                            <template x-for="bukti in selectedRecord.bukti_tindakan" :key="bukti.id">
                                                <div class="relative group cursor-pointer w-full h-24 overflow-hidden rounded-md border border-gray-300 transition-transform duration-300 hover:scale-105"
                                                    @click="showImageModal = true; selectedImage = bukti.photo">

                                                    <!-- Gambar -->
                                                    <img :src="'/storage/' + bukti.photo" class="w-full h-full object-cover"
                                                        alt="Bukti Tindakan">

                                                    <!-- Overlay icon saat hover -->
                                                    <div
                                                        class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 flex items-center justify-center transition-all duration-300">
                                                        <svg class="w-6 h-6 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M15 3h6v6M14 10l6.5-6.5M9 21H3v-6M10 14l-6.5 6.5" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="px-6 py-4 border-t border-gray-200">
                        <div class="flex justify-end">
                            <button 
                                class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium tracking-tight rounded-lg transition bg-gray-500 hover:bg-gray-600 focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-gray-600 text-white"
                                @click="showDetailModal = false"
                            >
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Preview Modal -->
        <div x-show="showImageModal" class="fixed inset-0 z-50" style="display: none;background-color:rgba(0, 0, 0, 0.75) !important;"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="showImageModal = false">

            <!-- Image Modal Overlay -->
            <div class="fixed inset-0 bg-black bg-opacity-90"></div>

            <div class="fixed inset-0 z-[9998] flex flex-col items-center justify-center p-0">
                <!-- Close Button -->
                <button @click="showImageModal = false"
                    class="absolute top-4 right-4 text-white hover:text-gray-300 focus:outline-none z-50 transition duration-150 rounded-full p-2" style="background-color: rgba(0, 0, 0, 0.7);">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Scrollable Image Container -->
                <div class="w-full h-full overflow-y-auto flex items-center justify-center p-10">
                    <img :src="selectedImage ? '/storage/' + selectedImage : ''"
                        class="object-contain w-auto h-auto mx-auto my-8" alt="Preview Bukti Tindakan" style="max-height: 98vh !important; max-width: 90vw !important;">	
                </div>
            </div>
        </div>
    </div>
</x-filament::page>
