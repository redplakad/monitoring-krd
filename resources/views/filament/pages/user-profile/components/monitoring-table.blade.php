{{-- Monitoring Table Section --}}
<div x-data="{
    showDetailModal: false,
    selectedRecord: null,
    showImageModal: false,
    selectedImage: null
}" class="kolom-2 flex-1 bg-white rounded-lg shadow p-6 overflow-x-auto">
    <h3 class="text-lg font-bold mb-4 text-gray-700">Monitoring Kredit</h3>
    <div class="mb-2 text-xs text-gray-500">
        Total data: {{ $user->monitoringKredit->count() }}
    </div>
    <table class="w-full text-sm text-left">
        <thead>
            <tr class="bg-gray-100">
                <th class="py-2 px-3 font-semibold text-gray-600 text-xs">Tanggal</th>
                <th class="py-2 px-3 font-semibold text-gray-600 text-xs">CIF</th>
                <th class="py-2 px-3 font-semibold text-gray-600 text-xs">NoRekening</th>
                <th class="py-2 px-3 font-semibold text-gray-600 text-xs">Nama Nasabah</th>
                <th class="py-2 px-3 font-semibold text-gray-600 text-xs">Tindakan</th>
                <th class="py-2 px-3 font-semibold text-gray-600 text-xs">Hasil Tindakan</th>
                <th class="py-2 px-3 font-semibold text-gray-600 text-xs">Detail</th>
            </tr>
        </thead>
        <tbody>
            @forelse($user->monitoringKredit as $kredit)
                <tr class="border-b">
                    <td class="py-2 px-3 text-xs">{{ $kredit->created_at ? $kredit->created_at->format('d/m/Y') : '-' }}</td>
                    <td class="py-2 px-3 text-xs">{{ $kredit->CIF ?? '-' }}</td>
                    <td class="py-2 px-3 text-xs">{{ $kredit->NOMOR_REKENING ?? '-' }}</td>
                    <td class="py-2 px-3 text-xs">{{ $kredit->NAMA_NASABAH ?? '-' }}</td>
                    <td class="py-2 px-3 text-xs">{{ $kredit->TINDAKAN ?? '-' }}</td>
                    <td class="py-2 px-3 text-xs">{{ $kredit->HASIL_TINDAKAN ?? '-' }}</td>
                    <td class="py-2 px-3 text-xs">
                        <x-filament::link @click="showDetailModal = true; selectedRecord = {{ $kredit->load('buktiTindakan')->toJson() }}"
                            icon="heroicon-s-eye"
                            class="text-success-600 hover:text-success-700 cursor-pointer inline-flex items-center transition duration-150 text-xs"
                            title="Lihat Detail" size="xs" color="success">
                            Detail
                        </x-filament::link>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="py-4 text-center text-gray-400 text-xs">Tidak ada data monitoring kredit.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Detail Modal -->
    <div x-show="showDetailModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

        <!-- Modal Overlay -->
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75" style="background-color:rgba(0, 0, 0, 0.75) !important;">
        </div>

        <div class="relative min-h-screen flex items-center justify-center p-4">
            <!-- Modal Content -->
            <div class="relative bg-white rounded-xl shadow-2xl max-w-2xl w-full mx-auto z-[9998]">

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
                                style="text-decoration: none;background-color:oklch(52.7% 0.154 150.069);"
                            >
                                <x-tabler-user-hexagon />
                                Detail Debitur
                            </a>
                        </template>

                        <!-- Bukti Tindakan Gallery -->
                        <template x-if="selectedRecord?.bukti_tindakan && selectedRecord.bukti_tindakan.length > 0">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-500">Bukti Tindakan</label>

                                <!-- Container scroll hanya untuk gambar -->
                                <div
                                    class="max-h-[200px] overflow-y-auto pr-2 border border-gray-200 rounded-lg p-2 bg-white">
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
                        <x-filament::button 
                            color="gray" 
                            @click="showDetailModal = false"
                            icon="tabler-circle-x"
                        >
                            Tutup
                        </x-filament::button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Preview Modal -->
    <div x-show="showImageModal" class="fixed inset-0 z-50" style="display: none;"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

        <!-- Image Modal Overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-90" @click="showImageModal = false"></div>

        <div class="fixed inset-0 z-[9998] flex items-center justify-center p-4">
            <!-- Close Button -->
            <button @click="showImageModal = false"
                class="absolute top-4 right-4 text-white hover:text-gray-300 focus:outline-none z-[9999]">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Image Container -->
            <div class="w-screen h-screen flex items-center justify-center p-4" @click.self="showImageModal = false"
                style="background-color: rgba(0, 0, 0, 0.7);">
                <img :src="selectedImage ? '/storage/' + selectedImage : ''"
                    class="max-h-screen max-w-screen w-auto h-auto object-contain" alt="Preview Bukti Tindakan">
            </div>
        </div>
    </div>
</div>
