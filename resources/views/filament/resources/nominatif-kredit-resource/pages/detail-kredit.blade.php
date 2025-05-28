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
                            @php
                                $kolekMap = [
                                    1 => '1 - Lancar',
                                    2 => '2 - Dalam perhatian khusus',
                                    3 => '3 - Kurang Lancar',
                                    4 => '4 - Diragukan',
                                    5 => '5 - Macet',
                                ];

                                $kolekText = $kolekMap[$record['KODE_KOLEK'] ?? 0] ?? '-';
                                $totalTunggakan = ($record['TUNGGAKAN_POKOK'] ?? 0) + ($record['TUNGGAKAN_BUNGA'] ?? 0);

                                $formattedPhone = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $record['NO_HP']));

                                $waMessage =
                                    "Assalamu'alaikum Wr.Wb.\n" .
                                    "kami dari bagian penagihan PT BPR SERANG (Perseroda) Cabang Kragilan\n" .
                                    "memberitahukan kepada bapak/ibu/sdr(i) tentang kewajiban angsuran anda:\n\n" .
                                    "Nama : {$record['NAMA_NASABAH']}\n" .
                                    "Alamat : {$record['ALAMAT']}\n" .
                                    "Tempat Bekerja : {$record['TEMPAT_BEKERJA']}\n" .
                                    "No Rekening : {$record['NOMOR_REKENING']}\n" .
                                    'Plafon pinjaman : Rp. ' .
                                    number_format($record['PLAFOND_AWAL'], 0, ',', '.') .
                                    "\n" .
                                    "AO : {$record['AO']}\n" .
                                    'Baki debet : Rp. ' .
                                    number_format($record['POKOK_PINJAMAN'], 0, ',', '.') .
                                    "\n" .
                                    'Angsuran : Rp. ' .
                                    number_format($record['ANGSURAN_TOTAL'], 0, ',', '.') .
                                    "\n" .
                                    'Tunggakan Pokok : Rp. ' .
                                    number_format($record['TUNGGAKAN_POKOK'], 0, ',', '.') .
                                    "\n" .
                                    'Tunggakan Bunga : Rp. ' .
                                    number_format($record['TUNGGAKAN_BUNGA'], 0, ',', '.') .
                                    "\n" .
                                    'TOTAL TAGIHAN : Rp. ' .
                                    number_format($totalTunggakan, 0, ',', '.') .
                                    "\n" .
                                    "Kolektibilitas : {$kolekText}\n\n" .
                                    "Agar segera melakukan pembayaran sesuai dengan tagihan tsb\n" .
                                    "terimakasih\n\n" .
                                    'Jika sudah membayar tagihan mohon lampirkan bukti bayar anda, terimakasih.';

                                $waText = urlencode($waMessage);
                                $waLink = "https://wa.me/{$formattedPhone}?text={$waText}";
                            @endphp

                            <a href="{{ $waLink }}" target="_blank"
                                style="background-color:#25D366; color:white; display:inline-flex; align-items:center; gap:8px; padding:8px 16px; border-radius:6px; font-weight:600; margin-top:10px; text-decoration:none; font-size:14px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24"
                                    width="20" height="20">
                                    <path
                                        d="M20.52 3.48A12.07 12.07 0 0 0 12 0C5.37 0 0 5.37 0 12a11.93 11.93 0 0 0 1.64 6L0 24l6.26-1.64A12.07 12.07 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.2-1.25-6.21-3.48-8.52zM12 22a9.93 9.93 0 0 1-5.13-1.42l-.37-.22-3.72.98.99-3.63-.24-.37A9.93 9.93 0 0 1 2 12c0-5.52 4.48-10 10-10s10 4.48 10 10-4.48 10-10 10zm5.2-7.6c-.28-.14-1.65-.81-1.9-.9-.25-.09-.43-.14-.61.14-.18.28-.7.9-.86 1.08-.16.18-.32.2-.6.07-.28-.14-1.18-.44-2.25-1.41-.83-.74-1.39-1.65-1.55-1.93-.16-.28-.02-.43.12-.57.13-.13.28-.34.42-.51.14-.17.18-.29.28-.48.09-.19.05-.36-.02-.5-.07-.14-.61-1.47-.84-2.01-.22-.53-.45-.46-.62-.47-.16-.01-.36-.01-.56-.01-.19 0-.5.07-.76.34-.26.27-1 1-.97 2.43.03 1.43 1.03 2.81 1.18 3 .15.19 2.03 3.1 4.93 4.23.69.3 1.23.48 1.65.61.69.22 1.32.19 1.82.12.56-.08 1.65-.67 1.89-1.32.23-.65.23-1.2.16-1.32-.07-.12-.25-.19-.53-.33z" />
                                </svg>
                                Kirim Tagihan
                            </a>
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

                    </div>
                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl">
                        <div>
                            <p class="text-xs text-gray-500">Angsuran</p>
                            <p class="font-medium text-sm text-gray-700">Rp.
                                {{ number_format($record['ANGSURAN_TOTAL']) }}</p>
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

            <div class="md:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Card Skor Resiko -->
                    <div class="bg-white shadow rounded-xl p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Skor Resiko</p>
                                <p class="text-2xl font-bold text-gray-800">0</p>
                            </div>
                            <div>
                                <img src="{{ asset('images/icons/icon-risk-red.png') }}" alt="Icon Call"
                                    class="w-10 h-10">
                            </div>
                        </div>
                    </div>

                    <!-- Card Jumlah Kunjungan -->
                    <div class="bg-white shadow rounded-xl p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Kunjungan</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $count_kunjungan }}</p>
                            </div>
                            <div>
                                <img src="{{ asset('images/icons/icon-visit.png') }}" alt="Icon Call"
                                    class="w-10 h-10">
                            </div>
                        </div>
                    </div>

                    <!-- Card Monitoring -->
                    <div class="bg-white shadow rounded-xl p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Panggilan</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $count_panggilan }}</p>
                            </div>
                            <div>
                                <img src="{{ asset('images/icons/icon-call.png') }}" alt="Icon Call" class="w-10 h-10">
                            </div>
                        </div>
                    </div>
                </div>


                @livewire('monitoring-kredit-crud', ['recordId' => $record->NOMOR_REKENING])
            </div>
        </div>
    </div>
</x-filament::page>
