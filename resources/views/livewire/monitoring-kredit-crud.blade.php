<div class="text-xs">
    <div class="bg-white shadow rounded-xl p-3 space-y-4 mt-3">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-sm font-semibold text-gray-800">Riwayat Monitoring</h2>
            <x-filament::button wire:click="showCreateModal" icon="heroicon-s-plus-circle" color="success" size="xs"
                class="text-xs">
                Buat Penagihan
            </x-filament::button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200 text-xs">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tindakan</th>
                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Hasil Tindakan</th>
                        <th class="px-3 py-2 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($monitorings as $item)
                        <tr>
                            <td class="px-4 py-2 text-xs text-gray-700">{{ $item->created_at->format('d M y') }}</td>
                            <td class="px-4 py-2 text-xs text-gray-700">{{ $item->user->name ?? '-' }}</td>
                            <td class="px-4 py-2 text-xs text-gray-700">{{ $item->TINDAKAN }}</td>
                            <td class="px-4 py-2 text-xs text-gray-700">{{ $item->HASIL_TINDAKAN }}</td>
                            <td class="px-4 py-2 text-xs text-right space-x-2">
                            <div class="flex space-x-4 text-sm mt-2">
                                <a wire:click="showEditModal({{ $item->id }})"
                                class="text-blue-600 hover:underline cursor-pointer inline-flex items-center"
                                title="Edit">
                                    <x-heroicon-o-pencil-square class="w-4 h-4 mr-1" />
                                </a>

                                <a wire:click="$set('confirmingDeleteId', {{ $item->id }})"
                                class="text-red-600 hover:underline cursor-pointer inline-flex items-center"
                                title="Hapus">
                                    <x-heroicon-s-trash class="w-4 h-4 mr-1" />
                                </a>

                                <a wire:click="showViewModal({{ $item->id }})"
                                class="text-gray-700 hover:underline cursor-pointer inline-flex items-center"
                                title="Lihat Detail">
                                    <x-heroicon-s-eye class="w-4 h-4 mr-1" />
                                </a>
                            </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-center text-gray-500 text-xs">Belum ada data
                                penagihan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-10">
                {{ $monitorings->links() }}
            </div>
        </div>

        <!-- Modal Konfirmasi Hapus -->
        <div x-data="{ show: false }"
            x-init="$watch('$wire.confirmingDeleteId', value => show = !!value)"
            x-show="show"
            style="display: none;background-color: rgba(0,0,0,0.5) !important;"
            class="fixed inset-0 flex items-center justify-center z-50">
            <div @click.away="show = false" class="bg-white p-6 rounded shadow-md max-w-md w-full">
                <h2 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h2>
                <p class="mb-4">Apakah Anda yakin ingin menghapus data monitoring ini?</p>
                <div class="flex justify-end gap-2">
                    <x-filament::button size="xs" color="gray" @click="show = false" wire:click="$set('confirmingDeleteId', null)"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded">Batal</x-filament::button>
                    <x-filament::button size="xs"  color="danger" wire:click="confirmDelete"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</x-filament::button>
                </div>
            </div>
        </div>

        {{-- Modal --}}
        @if ($modalFormVisible)
            <div class="fixed inset-0 z-50" style="background-color: rgba(0,0,0,0.5);">
                <!-- Overlay background -->
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>

                <!-- Modal content -->
                <div class="fixed inset-0 flex items-center justify-center p-4">
                    <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-lg text-xs z-10">
                        <h3 class="text-xs font-semibold mb-4">
                            {{ $monitoring_id ? 'Edit Penagihan' : 'Tambah Penagihan Baru' }}
                        </h3>
                        <form wire:submit.prevent="save" class="space-y-4">
                            <div>
                                <label for="tindakan" class="block text-xs font-medium text-gray-700">Tindakan</label>
                                <select id="tindakan" wire:model.defer="tindakan" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 text-xs">
                                    <option value="Whatsapp">Pilih Tindakan</option>
                                    <option value="Whatsapp">Whatsapp</option>
                                    <option value="Telepon">Telepon</option>
                                    <option value="Kunjungan">Kunjungan</option>
                                </select>
                                @error('tindakan')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="pembayaran"
                                    class="block text-xs font-medium text-gray-700">Pembayaran</label>
                                <input type="number" id="pembayaran" wire:model.defer="pembayaran" step="0.01"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 text-xs"
                                    placeholder="0">
                                @error('pembayaran')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="hasil_tindakan" class="block text-xs font-medium text-gray-700">Hasil
                                    Tindakan</label>
                                <textarea id="hasil_tindakan" wire:model.defer="hasil_tindakan"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 text-xs"
                                    required></textarea>
                                @error('hasil_tindakan')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex justify-end space-x-2">
                                <x-filament::button type="button" color="gray" size="sm"
                                    wire:click="$set('modalFormVisible', false)">
                                    Batal
                                </x-filament::button>

                                <x-filament::button type="submit" color="success" size="sm" class="mx-1">
                                    Simpan
                                </x-filament::button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <div x-data="{ open: @entangle('viewing') }" x-show="open"
     x-transition
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm px-4 py-6 sm:px-0"
     style="display: none;">
    <div @click.away="open = false"
         class="w-full max-w-2xl bg-white rounded-2xl shadow-xl overflow-hidden">

        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-800">Detail Monitoring</h2>
        </div>

        <div class="px-6 py-4 space-y-3 text-sm text-gray-700">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div><span class="font-semibold">CIF:</span> {{ $viewData['CIF'] ?? '-' }}</div>
                <div><span class="font-semibold">Nama Nasabah:</span> {{ $viewData['NAMA_NASABAH'] ?? '-' }}</div>
                <div><span class="font-semibold">Tindakan:</span> {{ $viewData['TINDAKAN'] ?? '-' }}</div>
                <div><span class="font-semibold">Pembayaran:</span> Rp {{ number_format($viewData['PEMBAYARAN'] ?? 0) }}</div>
                <div class="sm:col-span-2">
                    <span class="font-semibold">Hasil:</span> {{ $viewData['HASIL_TINDAKAN'] ?? '-' }}
                </div>
            </div>

            @if(isset($viewData['bukti_tindakan']) && count($viewData['bukti_tindakan']) > 0)
                <div>
                    <div class="font-semibold mb-1">Bukti Tindakan:</div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                        @foreach ($viewData['bukti_tindakan'] as $bukti)
                            <img src="data:image/jpeg;base64,{{ $bukti['photo'] }}"
                                 alt="Bukti"
                                 class="rounded-md border shadow-sm object-cover aspect-square">
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="px-6 py-3 border-t flex justify-end">
            <x-filament::button icon="heroicon-m-sparkles" color="success" @click="open = false"
                    class="px-4 py-2 bg-gray-700 text-white rounded-md hover:bg-gray-800 text-sm">
                Tutup
            </x-filament::button>
        </div>
    </div>
</div>

    </div>
</div>
