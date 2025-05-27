<x-filament::page>
    <div class="w-full px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div id="kolom-1">
                <div class="bg-white shadow-lg rounded-xl p-6 space-y-3">

                    @php
                        $tglLahir = \Carbon\Carbon::createFromFormat('Ymd', $record['TGL_LAHIR']);
                        $umur = $tglLahir->diff(now());
                    @endphp
                    <div class="max-w-sm p-4 flex items-center gap-4 bg-white rounded-xl shadow-sm">
                        <div class="relative w-16 h-16 shrink-0">
                            <img src="{{ asset('images/avatar01.png') }}" alt="Avatar"
                                class="w-16 h-16 rounded-full object-cover border border-gray-300" />
                            <a href="#"
                                class="absolute bottom-0 right-0 bg-white p-1 rounded-full shadow hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M17.414 2.586a2 2 0 010 2.828l-1.121 1.121-2.828-2.828 1.121-1.121a2 2 0 012.828 0zM2 13.586V17h3.414l9.899-9.899-2.828-2.828L2 13.586z" />
                                </svg>
                            </a>
                        </div>

                        <div class="flex flex-col">
                            <span class="text-sm font-semibold text-gray-800">{{ $record['NAMA_NASABAH'] }}</span>

                            <span class="text-xs text-gray-500 mt-1 flex items-center">
                                <x-heroicon-s-heart class="w-4 h-4 mr-3 shrink-0 text-danger" />
                                {{ $umur->y }} Thn {{ $umur->m }} Bln &nbsp;
                                <x-heroicon-s-calendar class="w-4 h-4 ml-3 shrink-0" />
                                {{ \Carbon\Carbon::createFromFormat('Ymd', $record['TGL_LAHIR'])->format('d-m-Y') }}
                            </span>
                        </div>

                    </div>

                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl">
                        <div>
                            <p class="text-xs text-gray-500">Nomor Rekening</p>
                            <p class="font-medium text-sm text-gray-700">{{ $record['NOMOR_REKENING'] }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Kolektibilitas</p>
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

                    <x-detail-item-pair
                        label1="Nomor Rekening"
                        value1="{{ $record['NOMOR_REKENING'] }}"
                        label2="Kolektibilitas"
                        value2="{{ $label }}"
                    />

                    <x-detail-item-pair
                        label1="Plafond"
                        value1="Rp {{ number_format($record['PLAFOND_AWAL'], 0, ',', '.') }}"
                        label2="Bakidebet"
                        value2="Rp {{ number_format($record['POKOK_PINJAMAN'], 0, ',', '.') }}"
                    />

                    <x-detail-item-pair
                        label1="Tanggal Cair"
                        value1="{{ \Carbon\Carbon::createFromFormat('Ymd', $record['TGL_PK'])->format('d M Y') }}"
                        label2="Tanggal Jth Tempo"
                        value2="{{ \Carbon\Carbon::createFromFormat('Ymd', $record['TGL_AKHIR_FAS'])->format('d M Y') }}"
                    />

                    <x-detail-item-pair
                        label1="Angsuran"
                        value1="Rp. {{ number_format($record['ANGSURAN_TOTAL']) }}"
                        label2="Jangka Waktu"
                        value2="{{ $record['JANGKA_WAKTU'] }} Bln"
                    />

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
                    <x-detail-item-pair
                        label1="Alamat"
                        value1="{{ $record['ALAMAT'] }}"
                    />

                    <x-detail-item-pair
                        label1="Kelurahan"
                        value1="{{ $record['KELURAHAN'] }}"
                        label2="Kecamatan"
                        value2="{{ $record['KECAMATAN'] }}"
                    />

                    <x-detail-item-pair
                        label1="Tempat Bekerja"
                        value1="{{ $record['TEMPAT_BEKERJA'] }}"
                        label2="No Telepon"
                        value2="{{ $record['NO_HP'] }}"
                    />
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <x-info-card
                        label="Skor Resiko"
                        value="0"
                        iconPath="images/icons/icon-risk-red.png"
                        iconAlt="Icon Skor Resiko"
                    />
                    <x-info-card
                        label="Kunjungan"
                        value="{{ $count_kunjungan }}"
                        iconPath="images/icons/icon-visit.png"
                        iconAlt="Icon Kunjungan"
                    />
                    <x-info-card
                        label="Panggilan"
                        value="{{ $count_panggilan }}"
                        iconPath="images/icons/icon-call.png"
                        iconAlt="Icon Panggilan"
                    />
                </div>
                @livewire('monitoring-kredit-crud', ['recordId' => $record->NOMOR_REKENING])
            </div>
        </div>
    </div>
</x-filament::page>
