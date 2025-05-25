<x-filament::page>
    <div class="rounded-xl overflow-hidden bg-white shadow mb-8">
        {{-- Avatar & Info --}}
        <div class="flex flex-col items-center -mt-20 mb-6" style="background-image: url({{ $user->dataKaryawan?->foto_cover ? asset('storage/' . $user->dataKaryawan->foto_cover) : asset('images/background/bg-profile.jpg') }});">
            <div class="w-32 h-32 rounded-full border-4 border-white shadow-lg overflow-hidden bg-gray-100" style="margin-top:40px;">
                @if($user->dataKaryawan?->foto_profil)
                    <img src="{{ asset('storage/' . $user->dataKaryawan->foto_profil) }}"
                         class="object-cover w-full h-full" alt="Avatar">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=128"
                         class="object-cover w-full h-full" alt="Avatar">
                @endif
            </div>
            <div class="mt-4 text-center flex items-center justify-center gap-2">
                <div class="text-2xl md:text-3xl font-bold text-white" style="padding:10px;">
                    {{ $user->name }}
                </div>
                <button class="flex items-center hover:bg-white text-gray-800 px-3 py-1 rounded-lg shadow text-sm font-semibold transition ml-2" style="background-color:rgba(255,255,255,0.4) !important;">
                    <x-heroicon-o-pencil class="h-5 w-5 text-white" />
                </button>
            </div>
        </div>

        {{-- Stats Bar --}}
        <div class="px-8 pb-6">
            <div class="flex flex-col md:flex-row justify-center items-center gap-6 mt-3">
                
                <div class="flex flex-col items-center px-6 py-2">
                    <div class="text-gray-600 font-medium mt-1">
                        {{ $user->dataKaryawan?->position?->nama ?? 'No Position Available' }}
                    </div>
                    <div class="text-gray-400 text-sm">
                        {{ $user->dataKaryawan?->branch?->nama ?? '-' }}
                    </div>
                </div>
                <div class="flex flex-col items-center px-6 py-2" style="border-right:1px solid #efefef">
                    <svg class="w-6 h-6 text-blue-500 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3"></path><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"></circle></svg>
                    <div class="text-xs text-gray-500 font-semibold uppercase">Aktivitas</div>
                    <div class="text-lg font-bold mt-1">243</div>
                </div>
                <div class="flex flex-col items-center px-6 py-2" style="border-right:1px solid #efefef">
                    <svg class="w-6 h-6 text-green-500 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2h5"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <div class="text-xs text-gray-500 font-semibold uppercase">Kunjungan</div>
                    <div class="text-lg font-bold mt-1">64</div>
                </div>
                <div class="flex flex-col items-center px-6 py-2">
                    <svg class="w-6 h-6 text-purple-500 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path><polyline points="17 8 12 13 7 8"></polyline></svg>
                    <div class="text-xs text-gray-500 font-semibold uppercase">Komunikasi</div>
                    <div class="text-lg font-bold mt-1">54</div>
                </div>
            </div>
        </div>
    </div>

    
    {{-- Bagian main --}}
    <div class="main flex flex-col md:flex-row gap-6">
        {{-- Kolom 1: Info User --}}
        <div class="kolom-1 w-full md:w-1/3 max-w-md bg-white rounded-xl shadow p-6 mb-6 md:mb-0 flex-shrink-0">
            <ul class="space-y-4">
                <li class="flex items-center gap-3">
                    <span class="bg-blue-100 text-blue-600 rounded-full p-2">
                        <x-tabler-user-square-rounded />
                    </span>
                    <div>
                        <div class="text-xs text-gray-500">Nama</div>
                        <div class="text-gray-800">{{ $user->name }}</div>
                    </div>
                </li>
                <li class="flex items-center gap-3">
                    <span class="bg-green-100 text-green-600 rounded-full p-2">
                        <x-tabler-mail />
                    </span>
                    <div>
                        <div class="text-xs text-gray-500">Email</div>
                        <div class="text-gray-800">{{ $user->email }}</div>
                    </div>
                </li>
                <li class="flex items-center gap-3">
                    <span class="bg-yellow-100 text-yellow-600 rounded-full p-2">
                        <x-tabler-phone />
                    </span>
                    <div>
                        <div class="text-xs text-gray-500">Telepon</div>
                        <div class="text-gray-800">{{ $user->dataKaryawan?->telepon ?? '-' }}</div>
                    </div>
                </li>
                <li class="flex items-center gap-3">
                    <span class="bg-purple-100 text-purple-600 rounded-full p-2">
                        <x-tabler-home />
                    </span>
                    <div>
                        <div class="text-xs text-gray-500">Alamat</div>
                        <div class="ftext-gray-800">{{ $user->dataKaryawan?->alamat ?? '-' }}</div>
                    </div>
                </li>
                <li class="flex items-center gap-3">
                    <span class="bg-pink-100 text-pink-600 rounded-full p-2">
                        <x-tabler-building-skyscraper />
                    </span>
                    <div>
                        <div class="text-xs text-gray-500">Cabang</div>
                        <div class="text-gray-800">{{ $user->dataKaryawan?->branch?->nama ?? '-' }}</div>
                    </div>
                </li>
                <li class="flex items-center gap-3">
                    <span class="bg-indigo-100 text-indigo-600 rounded-full p-2">
                        <x-tabler-user-star />
                    </span>
                    <div>
                        <div class="text-xs text-gray-500">Jabatan</div>
                        <div class="text-gray-800">{{ $user->dataKaryawan?->position?->nama ?? '-' }}</div>
                    </div>
                </li>
            </ul>
        </div>
        {{-- Kolom 2: Table MonitoringKredit --}}
        <div class="kolom-2 flex-1 bg-white rounded-lg shadow p-6 overflow-x-auto">
            <h3 class="text-lg font-bold mb-4 text-gray-700">Monitoring Kredit</h3>
            <div class="mb-2 text-xs text-gray-500">
                Total data: {{ $user->monitoringKredit->count() }}
            </div>
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-3 font-semibold text-gray-600">Tanggal</th>
                        <th class="py-2 px-3 font-semibold text-gray-600">NoRekening</th>
                        <th class="py-2 px-3 font-semibold text-gray-600">Tindakan</th>
                        <th class="py-2 px-3 font-semibold text-gray-600">Hasil Tindakan</th>
                        <th class="py-2 px-3 font-semibold text-gray-600">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($user->monitoringKredit as $kredit)
                        <tr class="border-b">
                            <td class="py-2 px-3">{{ $kredit->created_at ? $kredit->created_at->format('d/m/Y') : '-' }}</td>
                            <td class="py-2 px-3">{{ $kredit->NOMOR_REKENING ?? '-' }}</td>
                            <td class="py-2 px-3">{{ $kredit->TINDAKAN ?? '-' }}</td>
                            <td class="py-2 px-3">{{ $kredit->HASIL_TINDAKAN ?? '-' }}</td>
                            <td class="py-2 px-3">
                                <a href="{{ route('filament.admin.resources.nominatif-kredits.detail', ['record' => $kredit->NOMOR_REKENING]) }}" 
                                class="text-blue-500 hover:underline">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-gray-400">Tidak ada data monitoring kredit.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</x-filament::page>
