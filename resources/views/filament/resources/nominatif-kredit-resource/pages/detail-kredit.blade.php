<x-filament::page>
    <div class="w-full px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div>
                <div class="bg-white shadow-lg rounded-xl p-6 space-y-3">
                    @php
                        $tglLahir = \Carbon\Carbon::createFromFormat('Ymd', $record['TGL_LAHIR']);
                        $umur = $tglLahir->diff(now());
                    @endphp

                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl">
                        <div>
                            <p class="text-xs text-gray-500">Nama Nasabah</p>
                            <p class="font-medium text-sm text-gray-700">{{ $record['NAMA_NASABAH'] }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Usia</p>
                            <p class="font-medium text-sm text-gray-700">{{ $umur->y }} thn {{ $umur->m }} bln
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl">
                        <div>
                            <p class="text-xs text-gray-500">Plafond</p>
                            <p class="font-medium text-sm text-gray-700">Rp
                                {{ number_format($record['PLAFOND_AWAL'], 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Bakidebet</p>
                            <p class="font-medium text-sm text-gray-700">Rp
                                {{ number_format($record['POKOK_PINJAMAN'], 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Kol</p>
                            @php
                                $statusMap = [
                                    1 => '1 - Lancar',
                                    2 => '2 - DPK',
                                    3 => '3 - Kurang Lancar',
                                    4 => '4 - Diragukan',
                                    5 => '5 - Macet',
                                ];
                                $kodeKolek = $record['KODE_KOLEK'] ?? null;
                                $label = $statusMap[$kodeKolek] ?? 'Tidak Diketahui';
                            @endphp
                            <p class="font-medium text-sm text-gray-700 text-center">
                                {{ $label }}
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl">
                        <div>
                            <p class="text-xs text-gray-500">Tanggal Cair</p>
                            <p class="font-medium text-sm text-gray-700">
                                {{ \Carbon\Carbon::createFromFormat('Ymd', $record['TGL_PK'])->format('d M Y') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Tanggal Jth Tempo</p>
                            <p class="font-medium text-sm text-gray-700">
                                {{ \Carbon\Carbon::createFromFormat('Ymd', $record['TGL_AKHIR_FAS'])->format('d M Y') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Jangka Waktu</p>
                            <p class="font-medium text-sm text-gray-700">{{ $record['JANGKA_WAKTU'] }} Bln</p>
                        </div>
                    </div>

                    <div class="text-sm text-gray-600 pt-2 border-t">
                        <div class="flex justify-between p-1"><span>Tunggakan Pokok</span><span>Rp
                                {{ number_format($record['TUNGGAKAN_POKOK'], 2, ',', '.') }}</span></div>
                        <div class="flex justify-between p-1"><span>Tunggakan Bunga</span><span>Rp
                                {{ number_format($record['TUNGGAKAN_BUNGA'], 2, ',', '.') }}</span></div>
                        <div class="flex justify-between font-bold p-1"><span>Total Tunggakan</span><span>Rp
                                {{ number_format($record['TUNGGAKAN_POKOK'] + $record['TUNGGAKAN_BUNGA'], 2, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between p-1"><span>Tgl Terakhir
                                Bayar</span><span>{{ \Carbon\Carbon::createFromFormat('Ymd', $record['TGL_AKHIR_BAYAR'])->format('d M Y') }}</span>
                        </div>
                    </div>

                    <div class="text-sm text-gray-600 pt-2 border-t">
                        <div class="flex justify-between p-1"><span>Produk
                                Kredit</span><span>{{ $record['KET_KD_PRD'] }}</span></div>
                        <div class="flex justify-between p-1"><span>Account
                                Officer</span><span>{{ $record['AO'] }}</span></div>
                    </div>
                </div>

                <!-- Kolom Kanan: Alamat Nasabah -->
                <div class="bg-white shadow-lg rounded-xl p-6 space-y-4 mt-3">
                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl">
                        <div>
                            <p class="text-xs text-gray-500">Alamat</p>
                            <p class="font-medium text-sm text-gray-700">
                                {{ $record['ALAMAT'] }}
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl">
                        <div>
                            <p class="text-xs text-gray-500">Kelurahan</p>
                            <p class="font-medium text-sm text-gray-700">{{ $record['KELURAHAN'] }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Kecamatan</p>
                            <p class="font-medium text-sm text-gray-700">{{ $record['KECAMATAN'] }}</p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl">
                        <div>
                            <p class="text-xs text-gray-500">Tempat Bekerja</p>
                            <p class="font-medium text-sm text-gray-700">{{ $record['TEMPAT_BEKERJA'] }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">No Telepon</p>
                            <p class="font-medium text-sm text-gray-700">{{ $record['NO_HP'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Card Jumlah Penagihan -->
                    <div class="bg-white shadow rounded-xl p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Jumlah Penagihan</p>
                                <p class="text-2xl font-bold text-gray-800">0</p>
                            </div>
                            <div>
                                <img src="{{ asset('images/icon-visit.png') }}" alt="Icon Call" class="w-10 h-10">
                            </div>
                        </div>
                    </div>

                    <!-- Card Monitoring -->
                    <div class="bg-white shadow rounded-xl p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Monitoring</p>
                                <p class="text-2xl font-bold text-gray-800">0</p>
                            </div>
                            <div>
                                <img src="{{ asset('images/icon-call.png') }}" alt="Icon Call" class="w-10 h-10">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow rounded-xl p-3 space-y-4 mt-3">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Riwayat Penagihan</h2>
                        <x-filament::button
                            href="{{ route('filament.admin.resources.monitoring-kredits.create') }}"
                            tag="a"
                            size="xs"
                            color="success"
                            icon="heroicon-s-plus-circle"
                        >
                            Buat Penagihan Baru
                        </x-filament::button>
                    </div>


                    <!-- Tabel -->
                    <div class="overflow-x-auto">
                        <table class="w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal
                                    </th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">User
                                    </th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tindakan
                                    </th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Hasil
                                        Tindakan</th>
                                    <th class="px-3 py-2 text-right text-xs font-medium text-gray-500 uppercase">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($record->monitoring as $item)
                                    <tr>
                                        <td class="px-4 py-2 text-gray-700">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                        <td class="px-4 py-2 text-gray-700">{{ $item->user->name }}</td>
                                        <td class="px-4 py-2 text-gray-700">{{ $item->tindakan }}</td>
                                        <td class="px-4 py-2 text-gray-700">{{ $item->hasil_tindakan }}</td>
                                        <td class="px-4 py-2 text-right">
                                            <a href=""
                                                class="text-blue-600 hover:underline text-sm">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($record->monitoring->isEmpty())
                                    <tr>
                                        <td colspan="5" class="px-4 py-3 text-center text-gray-500">Belum ada data
                                            penagihan.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament::page>
