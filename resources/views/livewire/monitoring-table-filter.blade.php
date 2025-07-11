<div>
    <div class="kolom-2 flex-1 bg-white rounded-lg shadow p-6 overflow-x-auto">
    
    <div class="mb-4 flex flex-wrap items-center justify-between gap-4">
        <h3 class="text-lg font-bold text-gray-700 mb-0">Monitoring Kredit</h3>
        <div class="flex items-center gap-2">
            <input type="text" wire:model.debounce.500ms="search" placeholder="Cari Nama Nasabah..."
                class="text-xs border-gray-300 rounded px-2 py-1 focus:ring focus:ring-success-200" />
            <label for="tindakan" class="text-xs font-semibold text-gray-600">Tindakan:</label>
            <select id="tindakan" wire:model="tindakan" wire:change="loadData"
                class="text-xs border-gray-300 rounded px-2 py-1 focus:ring focus:ring-success-200">
                <option value="">Semua</option>
                @foreach($tindakanList as $t)
                    <option value="{{ $t }}">{{ $t }}</option>
                @endforeach
            </select>
            <label for="periode" class="text-xs font-semibold text-gray-600">Periode:</label>
            <select id="periode" wire:model="periode" wire:change="loadData"
                class="text-xs border-gray-300 rounded px-2 py-1 focus:ring focus:ring-success-200">
                <option value="all" selected>Pilih Periode</option>
                <option value="all">Semua</option>
                <option value="week1">Minggu ke-1</option>
                <option value="week2">Minggu ke-2</option>
                <option value="week3">Minggu ke-3</option>
                <option value="week4">Minggu ke-4</option>
                <option value="month">Bulan ini</option>
            </select>
            @if($loading)
                <svg class="animate-spin h-5 w-5 text-success-600 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                </svg>
            @endif
        </div>
    </div>
    <div class="mb-2 text-xs text-gray-500">
        Total data: {{ $monitoringData->total() }}
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
                <th class="py-2 px-3 font-semibold text-gray-600 text-xs">Foto</th>
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
                    <td class="py-2 px-3 text-xs">
                        <div class="flex -space-x-2">
                            @php $max = min(4, count($kredit['bukti_tindakan'] ?? [])); @endphp
                            @for($i = 0; $i < $max; $i++)
                                <img src="{{ asset('storage/' . $kredit['bukti_tindakan'][$i]['photo']) }}" class="w-6 h-6 rounded-full border-2 border-white shadow object-cover" style="z-index:{{ 10-$i }};" />
                            @endfor
                            @if(count($kredit['bukti_tindakan'] ?? []) > 4)
                                <span class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold border-2 border-white" style="z-index:6;">+{{ count($kredit['bukti_tindakan'] ?? [])-4 }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="py-2 px-3 text-xs">{{ $kredit['NOMOR_REKENING'] ?? '-' }}</td>
                    <td class="py-2 px-3 text-xs">{{ $kredit['NAMA_NASABAH'] ?? '-' }}</td>
                    <td class="py-2 px-3 text-xs">{{ $kredit['TINDAKAN'] ?? '-' }}</td>
                    <td class="py-2 px-3 text-xs">{{ $kredit['HASIL_TINDAKAN'] ?? '-' }}</td>
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
    <div class="mt-4">
        {{ $monitoringData->links() }}
    </div>
</div>
</div>
