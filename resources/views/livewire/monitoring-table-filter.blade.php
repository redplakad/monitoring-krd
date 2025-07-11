<div>
    <div class="kolom-2 flex-1 bg-white rounded-lg shadow p-6 overflow-x-auto">
    
    <div class="mb-6">
        <!-- Header Section -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
            <div class="flex items-center gap-4">
                <h3 class="text-lg font-bold text-gray-700">Monitoring Kredit</h3>
                <div class="text-xs text-gray-500">
                    Total data: {{ $monitoringData->total() }}
                </div>
            </div>
        </div>
        
        <!-- Filter Section -->
        <div class="flex flex-wrap items-center gap-4 pb-4 pt-4">
            <!-- Search Input with Button -->
            <div class="flex items-center gap-2">
                <input type="text" wire:model="search" wire:keydown.enter="performSearch" placeholder="Cari Nama Nasabah..."
                    class="text-xs border-gray-300 rounded px-3 py-2 focus:ring focus:ring-success-200 focus:border-success-300" />
                <x-filament::button color="success" icon="heroicon-o-magnifying-glass" wire:click="performSearch" size="sm">
                    Cari
                </x-filament::button>
            </div>
            
            <!-- Tindakan Filter -->
            <div class="flex items-center gap-2">
                <label for="tindakan" class="text-xs font-semibold text-gray-600">Tindakan:</label>
                <select id="tindakan" wire:model="tindakan" wire:change="loadData"
                    class="text-xs border-gray-300 rounded px-3 py-2 focus:ring focus:ring-success-200 focus:border-success-300">
                    <option value="">Semua</option>
                    @foreach($tindakanList as $t)
                        <option value="{{ $t }}">{{ $t }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Periode Filter -->
            <div class="flex items-center gap-2">
                <label for="periode" class="text-xs font-semibold text-gray-600">Periode:</label>
                <select id="periode" wire:model="periode" wire:change="loadData"
                    class="text-xs border-gray-300 rounded px-3 py-2 focus:ring focus:ring-success-200 focus:border-success-300">
                    <option value="all" selected>Pilih Periode</option>
                    <option value="all">Semua</option>
                    <option value="week1">Minggu ke-1</option>
                    <option value="week2">Minggu ke-2</option>
                    <option value="week3">Minggu ke-3</option>
                    <option value="week4">Minggu ke-4</option>
                    <option value="month">Bulan ini</option>
                </select>
            </div>
            
            <!-- Loading Indicator -->
            @if($loading)
                <div class="flex items-center">
                    <svg class="animate-spin h-5 w-5 text-success-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                    </svg>
                    <span class="ml-2 text-xs text-gray-600">Memuat...</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Loading Spinner -->
    <div wire:loading wire:target="loadData" class="w-full py-4 text-center">
        <svg class="animate-spin h-8 w-8 text-success-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
        </svg>
        <div class="text-xs text-gray-500 mt-2">Memuat data...</div>
    </div>

    <table class="w-full text-sm text-left" wire:loading.class="opacity-50" style="min-width: 696px;">
        <thead>
            <tr class="bg-gray-100">
                <th class="py-2 px-3 font-semibold text-gray-600 text-xs">Tanggal</th>
                <th class="py-2 px-3 font-semibold text-gray-600 text-xs">NoRekening</th>
                <th class="py-2 px-3 font-semibold text-gray-600 text-xs">Nama Nasabah</th>
                <th class="py-2 px-3 font-semibold text-gray-600 text-xs">Tindakan</th>
                <th class="py-2 px-3 font-semibold text-gray-600 text-xs">Hasil Tindakan</th>
                <th class="py-2 px-3 font-semibold text-gray-600 text-xs">Detail</th>
            </tr>
        </thead>
        <tbody>
            @forelse($monitoringData as $kredit)
                <tr class="border-b">
                    <td class="py-2 px-3 text-xs">{{ \Carbon\Carbon::parse($kredit['created_at'])->format('d/m/Y') }}</td>
                    <td class="py-2 px-3 text-xs">{{ $kredit['NOMOR_REKENING'] ?? '-' }}</td>
                    <td class="py-2 px-3 text-xs">{{ $kredit['NAMA_NASABAH'] ?? '-' }}</td>
                    <td class="py-2 px-3 text-xs">{{ $kredit['TINDAKAN'] ?? '-' }}</td>
                    <td class="py-2 px-3 text-xs">
                        @php
                            $hasilTindakan = $kredit['HASIL_TINDAKAN'] ?? '-';
                            if ($hasilTindakan !== '-') {
                                $isLong = strlen($hasilTindakan) > 20;
                                $shortText = $isLong ? substr($hasilTindakan, 0, 20) : $hasilTindakan;
                            } else {
                                $isLong = false;
                                $shortText = $hasilTindakan;
                            }
                        @endphp
                        
                        <div class="relative">
                            <span class="block">{{ $shortText }}</span>
                            @if($isLong)
                                ...
                            @endif
                        </div>
                    </td>
                    <td class="py-2 px-3 text-xs">
                        <button type="button" 
                            wire:click="showDetail({{ $kredit['id'] }})"
                            class="text-success-600 hover:text-success-700 cursor-pointer inline-flex items-center transition duration-150 text-xs">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Detail
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="py-4 text-center text-gray-400 text-xs">Tidak ada data monitoring kredit.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <!-- Pagination Section -->
    <div class="mt-6 px-4 py-3 bg-gray-50 border-t border-gray-200 rounded-b-lg">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="text-xs text-gray-600 order-2 sm:order-1">
                @if($monitoringData->total() > 0)
                    Menampilkan {{ $monitoringData->firstItem() }} hingga {{ $monitoringData->lastItem() }} 
                    dari {{ number_format($monitoringData->total()) }} data
                @else
                    Tidak ada data untuk ditampilkan
                @endif
            </div>
            <div class="order-1 sm:order-2">
                <style>
                    .pagination-wrapper nav {
                        display: flex;
                        align-items: center;
                        gap: 2px;
                    }
                    .pagination-wrapper .relative {
                        font-size: 0.75rem;
                        padding: 0.375rem 0.75rem;
                        border-radius: 0.375rem;
                        transition: all 0.15s ease-in-out;
                    }
                    .pagination-wrapper .bg-success-600 {
                        background-color: #059669;
                        border-color: #059669;
                        color: white;
                        font-weight: 600;
                    }
                    .pagination-wrapper button:hover {
                        background-color: #f3f4f6;
                        border-color: #059669;
                        color: #059669;
                    }
                    .pagination-wrapper .rounded-l-md {
                        border-top-right-radius: 0;
                        border-bottom-right-radius: 0;
                    }
                    .pagination-wrapper .rounded-r-md {
                        border-top-left-radius: 0;
                        border-bottom-left-radius: 0;
                    }
                    .pagination-wrapper .-ml-px {
                        margin-left: -1px;
                    }
                </style>
                <div class="pagination-wrapper">
                    {{ $monitoringData->links('custom.pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
