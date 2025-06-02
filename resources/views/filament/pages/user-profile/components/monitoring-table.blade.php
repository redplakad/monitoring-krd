{{-- Monitoring Table Section --}}
<div x-data="monitoringTable()" class="kolom-2 flex-1 bg-white rounded-lg shadow p-6 overflow-x-auto">
    <!-- Periode Filter -->
    <div class="mb-4 flex flex-wrap items-center gap-2">
        <label for="periode" class="text-xs font-semibold text-gray-600">Periode:</label>
        <select id="periode" x-model="periode" @change="filterData()"
            class="text-xs border-gray-300 rounded px-2 py-1 focus:ring focus:ring-success-200">
            <option value="all">Semua</option>
            <option value="week1">Minggu ke-1</option>
            <option value="week2">Minggu ke-2</option>
            <option value="week3">Minggu ke-3</option>
            <option value="week4">Minggu ke-4</option>
            <option value="month">Bulan ini</option>
        </select>
        <template x-if="loading">
            <svg class="animate-spin h-5 w-5 text-success-600 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
            </svg>
        </template>
    </div>
    <h3 class="text-lg font-bold mb-4 text-gray-700">Monitoring Kredit</h3>
    <div class="mb-2 text-xs text-gray-500">
        Total data: <span x-text="filteredData.length"></span>
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
            <template x-if="loading">
                <tr>
                    <td colspan="7" class="py-8 text-center">
                        <svg class="animate-spin h-8 w-8 text-success-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                        </svg>
                        <div class="text-xs text-gray-500 mt-2">Memuat data...</div>
                    </td>
                </tr>
            </template>
            <template x-for="kredit in paginatedData" :key="kredit.id">
                <tr class="border-b">
                    <td class="py-2 px-3 text-xs" x-text="kredit.created_at ? new Date(kredit.created_at).toLocaleDateString('id-ID') : '-' "></td>
                    <td class="py-2 px-3 text-xs" x-text="kredit.CIF || '-' "></td>
                    <td class="py-2 px-3 text-xs" x-text="kredit.NOMOR_REKENING || '-' "></td>
                    <td class="py-2 px-3 text-xs" x-text="kredit.NAMA_NASABAH || '-' "></td>
                    <td class="py-2 px-3 text-xs" x-text="kredit.TINDAKAN || '-' "></td>
                    <td class="py-2 px-3 text-xs" x-text="kredit.HASIL_TINDAKAN || '-' "></td>
                    <td class="py-2 px-3 text-xs">
                        <button @click="showDetailModal = true; selectedRecord = kredit"
                            class="text-success-600 hover:text-success-700 cursor-pointer inline-flex items-center transition duration-150 text-xs">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Detail
                        </button>
                    </td>
                </tr>
            </template>
            <template x-if="!loading && filteredData.length === 0">
                <tr>
                    <td colspan="7" class="py-4 text-center text-gray-400 text-xs">Tidak ada data monitoring kredit.</td>
                </tr>
            </template>
        </tbody>
    </table>

    <!-- Pagination Controls -->
    <div x-show="!loading && totalPages > 1" class="mt-4 flex items-center justify-between text-xs">
        <button @click="prevPage()" :disabled="currentPage === 1"
            class="px-3 py-1 border rounded-md text-gray-600 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
            Sebelumnya
        </button>
        <span class="text-gray-600">
            Halaman <span x-text="currentPage"></span> dari <span x-text="totalPages"></span>
        </span>
        <button @click="nextPage()" :disabled="currentPage === totalPages"
            class="px-3 py-1 border rounded-md text-gray-600 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
            Berikutnya
        </button>
    </div>

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
                                style="text-decoration: none;background-color: #276749 !important;"
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
                                    class="max-h-[200px] overflow-y-auto pr-2 border border-gray-200 rounded-lg p-2 bg-white" style="max-height: 320px;">
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
<script>
function monitoringTable() {
    return {
        showDetailModal: false,
        selectedRecord: null,
        showImageModal: false,
        selectedImage: null,
        periode: 'all',
        loading: false,
        currentPage: 1,
        itemsPerPage: 25,
        allData: @json($user->monitoringKredit->map(function($item) {
            return [
                'id' => $item->id,
                'created_at' => $item->created_at,
                'CIF' => $item->CIF,
                'NOMOR_REKENING' => $item->NOMOR_REKENING,
                'NAMA_NASABAH' => $item->NAMA_NASABAH,
                'TINDAKAN' => $item->TINDAKAN,
                'HASIL_TINDAKAN' => $item->HASIL_TINDAKAN,
                'PEMBAYARAN' => $item->PEMBAYARAN,
                'bukti_tindakan' => $item->buktiTindakan,
                ]
            };
        })->values()->all()),
        filteredData: [],
        filterData() {
            this.loading = true;
            this.currentPage = 1; // Reset to first page on filter change
            setTimeout(() => {
                const now = new Date();
                const startOfMonth = new Date(now.getFullYear(), now.getMonth(), 1);
                const week = (date) => Math.ceil((date.getDate() - date.getDay() + 1) / 7);
                if (this.periode === 'all') {
                    this.filteredData = this.allData;
                } else if (this.periode === 'month') {
                    this.filteredData = this.allData.filter(item => {
                        if (!item.created_at) return false;
                        const dt = new Date(item.created_at);
                        return dt >= startOfMonth && dt <= now;
                    });
                } else if (this.periode.startsWith('week')) {
                    const weekNum = parseInt(this.periode.replace('week', ''));
                    this.filteredData = this.allData.filter(item => {
                        if (!item.created_at) return false;
                        const dt = new Date(item.created_at);
                        return dt >= startOfMonth && dt <= now && week(dt) === weekNum;
                    });
                }
                this.loading = false;
                // this.updatePaginatedData(); // Ensure paginatedData is updated after filtering
            }, 400); // Simulasi loading
        },
        get paginatedData() {
            if (!this.filteredData) return [];
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.filteredData.slice(start, end);
        },
        get totalPages() {
            if (!this.filteredData) return 0;
            return Math.ceil(this.filteredData.length / this.itemsPerPage);
        },
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
                // this.updatePaginatedData();
            }
        },
        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
                // this.updatePaginatedData();
            }
        },
        // updatePaginatedData() {
        //     const start = (this.currentPage - 1) * this.itemsPerPage;
        //     const end = start + this.itemsPerPage;
        //     this.paginatedData = this.filteredData.slice(start, end);
        // },
        init() {
            this.filteredData = this.allData;
            // this.updatePaginatedData(); // Initial pagination
        }
    }
}
document.addEventListener('alpine:init', () => {
    Alpine.data('monitoringTable', monitoringTable);
});
</script>
