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
            @if (!empty($successMessage))
                <div x-data="{ show: true }" x-init="$watch('$wire.successMessage', value => { if (value) { show = true } })" x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-2"
                    class="filament-notification filament-notification-success flex items-center justify-between gap-2 rounded-lg border border-success-300 bg-success-50 p-3 mb-6 text-sm text-success-700 dark:border-success-700 dark:bg-success-950 dark:text-success-300"
                    style="color:#2e7d32 !important; background-color:#F0FDF4 !important; margin-bottom:10px; border:0;">
                    <span class="font-medium flex items-center gap-2">
                        <div class="w-5 h-5 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true" class="w-full h-full">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        {{ $successMessage }}
                    </span>
                    <button @click="show = false" class="text-xl leading-none">&times;</button>
                </div>
            @endif

            @if (!empty($editSuccessMessage))
                <div x-data="{ show: true }" x-init="$watch('$wire.editSuccessMessage', value => { if (value) { show = true } })" x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-2"
                    class="filament-notification filament-notification-success flex items-center justify-between gap-2 rounded-lg border border-success-300 bg-success-50 p-3 mb-6 text-sm text-success-700 dark:border-success-700 dark:bg-success-950 dark:text-success-300"
                    style="color:#2e7d32 !important; background-color:#F0FDF4 !important; margin-bottom:10px; border:0;">
                    <span class="font-medium flex items-center gap-2">
                        <div class="w-5 h-5 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true" class="w-full h-full">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        {{ $editSuccessMessage }}
                    </span>
                    <button @click="show = false" class="text-xl leading-none">&times;</button>
                </div>
            @endif

            @if ($deleteSuccessMessage)
                <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-2"
                    class="filament-notification filament-notification-danger flex items-center justify-between gap-2 rounded-lg border border-danger-300 bg-danger-50 p-3 mb-6 text-sm text-danger-700 dark:border-danger-700 dark:bg-danger-950 dark:text-danger-300"
                    style="color:#b91c1c !important; background-color:#fef2f2 !important; margin-bottom:10px; border:0;">
                    <span class="font-medium flex items-center gap-2">
                        <div class="w-5 h-5 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true" data-slot="icon" class="on bfl">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        {{ $deleteSuccessMessage }}
                    </span>
                    <button @click="show = false" class="text-xl leading-none">&times;</button>
                </div>
            @endif

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
                            <td class="px-4 py-2 text-xs text-gray-700">{{ $item->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-2 text-xs text-gray-700">{{ $item->user->name ?? '-' }}</td>
                            <td class="px-4 py-2 text-xs text-gray-700">{{ $item->TINDAKAN }}</td>
                            <td class="px-4 py-2 text-xs text-gray-700">{{ $item->HASIL_TINDAKAN }}</td>
                            <td class="px-4 py-2 text-xs text-right space-x-2">
                                <div class="flex space-x-4 text-sm mt-2">
                                    <x-filament::link wire:click="showEditModal({{ $item->id }})"
                                        icon="heroicon-o-pencil-square"
                                        class="text-success-600 hover:text-success-700 cursor-pointer inline-flex items-center transition duration-150"
                                        title="Edit" size="xs" color="success" :disabled="auth()->id() !== $item->user_id" />

                                    <x-filament::link wire:click="$set('confirmingDeleteId', {{ $item->id }})"
                                        icon="heroicon-s-trash"
                                        class="text-success-600 hover:text-success-700 cursor-pointer inline-flex items-center transition duration-150"
                                        title="Hapus" size="xs" color="success" :disabled="auth()->id() !== $item->user_id" />

                                    <x-filament::link wire:click="showViewModal({{ $item->id }})"
                                        icon="heroicon-s-eye"
                                        class="text-success-600 hover:text-success-700 cursor-pointer inline-flex items-center transition duration-150"
                                        title="Lihat Detail" size="xs" color="success" />
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
        <div x-data="{ show: false }" x-init="$watch('$wire.confirmingDeleteId', value => show = !!value)" x-show="show"
            style="display: none;background-color: rgba(0,0,0,0.5) !important;"
            class="fixed inset-0 flex items-center justify-center z-50">
            <div @click.away="show = false" class="bg-white p-6 rounded shadow-md max-w-md w-full">
                <h2 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h2>
                <p class="mb-4">Apakah Anda yakin ingin menghapus data monitoring ini?</p>
                <div class="flex justify-end gap-2">
                    <x-filament::button size="xs" color="gray" @click="show = false"
                        wire:click="$set('confirmingDeleteId', null)"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded">Batal</x-filament::button>
                    <x-filament::button size="xs" color="danger" wire:click="confirmDelete"
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
                        <form wire:submit.prevent="save" class="space-y-4" id="monitoring-penagihan-form">
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
                            <div>
                                <label for="photos" class="block text-xs font-medium text-gray-700">Upload Foto
                                    Bukti (bisa lebih dari satu)</label>
                                <input type="file" id="photos" wire:model="photos" multiple
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 text-xs"
                                    accept="image/*" style="display:none;">
                                <div id="photos-paste-hint" class="text-xs text-gray-400 mt-1">Paste gambar dari clipboard (Ctrl+V) untuk upload otomatis</div>
                                @error('photos.*')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror

                                <!-- Spinner saat proses upload/preview -->
                                <div wire:loading wire:target="photos" class="flex items-center gap-2 mt-2">
                                    <svg class="animate-spin h-5 w-5 text-green-600"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                    </svg>
                                    <span class="text-xs text-gray-600">Memproses foto, mohon tunggu...</span>
                                </div>

                                {{-- Gabungkan preview foto lama dan baru dalam satu grid --}}
                                @if (($oldPhotos && count($oldPhotos)) || $photos)
                                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 mt-2 overflow-y-auto" style="max-height: 300px;">
                                        @if ($oldPhotos && count($oldPhotos))
                                            @foreach ($oldPhotos as $oldPhoto)
                                                <div class="relative group">
                                                    <img src="{{ asset('storage/' . $oldPhoto->photo) }}"
                                                        class="rounded border object-cover w-full aspect-square" />
                                                    <button type="button"
                                                        class="absolute top-1 right-1 bg-white bg-opacity-80 rounded-full p-1 text-red-600 hover:bg-red-600 hover:text-white transition group-hover:scale-110"
                                                        style="background-color: rgba(0, 0, 0, 0.8);color:#fff;"
                                                        wire:click.prevent="confirmDeletePhoto({{ $oldPhoto->id }})">
                                                        &times;
                                                    </button>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if ($photos)
                                            @foreach ($photos as $key => $photo)
                                                <div class="relative group">
                                                    <img src="{{ $photo->temporaryUrl() }}"
                                                        class="rounded border object-cover w-full aspect-square" />
                                                    <button type="button"
                                                        class="absolute top-1 right-1 bg-white bg-opacity-80 rounded-full p-1 text-red-600 hover:bg-red-600 hover:text-white transition group-hover:scale-110"
                                                        style="background-color: rgba(0, 0, 0, 0.8);color:#fff;"
                                                        wire:click.prevent="removePhoto({{ $key }})">
                                                        &times;
                                                    </button>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                @endif
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

        <div x-data="{ open: @entangle('viewing') }" x-show="open" x-transition
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm px-4 py-6 sm:px-0"
            style="display: none;">
            <div @click.away="open = false" class="w-full max-w-2xl bg-white rounded-xl shadow-xl overflow-hidden">

                <div class="px-6 py-4 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">Detail Monitoring</h2>
                </div>

                <div class="space-y-4 py-6 px-6">
                    <!-- Informasi Utama -->
                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl">
                        <div>
                            <p class="text-xs text-gray-500">CIF</p>
                            <p class="font-medium text-sm text-gray-700">{{ $viewData['CIF'] ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Nama Nasabah</p>
                            <p class="font-medium text-sm text-gray-700">{{ $viewData['NAMA_NASABAH'] ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl">
                        <div>
                            <p class="text-xs text-gray-500">Tindakan</p>
                            <p class="font-medium text-sm text-gray-700">{{ $viewData['TINDAKAN'] ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Pembayaran</p>
                            <p class="font-medium text-sm text-gray-700">
                                Rp {{ number_format($viewData['PEMBAYARAN'] ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Hasil Tindakan -->
                    <div class="bg-gray-50 p-4 rounded-xl">
                        <p class="text-xs text-gray-500 mb-1">Hasil</p>
                        <p class="font-medium text-sm text-gray-700">{{ $viewData['HASIL_TINDAKAN'] ?? '-' }}</p>
                    </div>
                    <!-- Bukti Tindakan -->
                    @if (isset($viewData['bukti_tindakan']) && count($viewData['bukti_tindakan']) > 0)
                        <div x-data="{ showImg: false, imgSrc: '' }">
                            <p class="text-xs text-gray-500 mb-2">Bukti Tindakan</p>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 overflow-y-auto"
                                style="max-height: 320px;">
                                @foreach ($viewData['bukti_tindakan'] as $bukti)
                                    <img src="{{ asset('storage/' . $bukti['photo']) }}" alt="Bukti"
                                        class="rounded-md border shadow-sm object-cover aspect-square cursor-pointer transition hover:scale-105"
                                        @click="showImg = true; imgSrc = '{{ asset('storage/' . $bukti['photo']) }}'">
                                @endforeach
                            </div>
                            <!-- Modal Fullscreen Preview -->
                            <div x-show="showImg" x-transition
                                class="fixed inset-0 z-50 flex items-center justify-center bg-black/80"
                                style="display: none;background-color: rgba(0, 0, 0, 0.8);" @click="showImg = false">
                                <!-- Overlay -->
                                <div class="absolute inset-0 bg-black bg-opacity-80" @click="showImg = false"></div>
                                <!-- Scrollable Image Container -->
                                <div class="relative z-10 w-full h-full flex items-center justify-center overflow-auto">
                                    <img :src="imgSrc"
                                        class="rounded shadow-lg border-4 border-white max-h-[95vh] max-w-[95vw] object-contain mx-auto my-auto block"
                                        style="display: block; margin: auto;" />
                                    <button @click="showImg = false"
                                        class="absolute top-4 right-4 text-white text-3xl font-bold z-20 bg-black bg-opacity-40 rounded-full px-3 py-1 hover:bg-opacity-70"
                                        aria-label="Tutup"
                                        style="background-color: rgba(0, 0, 0, 0.7);">&times;</button>
                                </div>
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
<script>
    window.addEventListener('show-delete-photo-confirmation', event => {
        if (confirm('Yakin ingin menghapus foto ini?')) {
            @this.call('deletePhoto');
        }
    });

    // Event handler paste gambar dari clipboard ke input file hidden, lalu upload ke Livewire
    document.addEventListener('paste', function (event) {
        // Cek apakah modal tambah/edit penagihan sedang terbuka
        const form = document.getElementById('monitoring-penagihan-form');
        if (!form || form.offsetParent === null) return; // form tidak ada atau tidak terlihat
        console.log('Paste event triggered'); // Debug log
        if (!event.clipboardData) return;
        const items = event.clipboardData.items;
        let foundImage = false;
        for (let i = 0; i < items.length; i++) {
            if (items[i].type.indexOf('image') !== -1) {
                const file = items[i].getAsFile();
                if (file) {
                    const dt = new DataTransfer();
                    const fileInput = document.getElementById('photos');
                    if (fileInput && fileInput.files.length > 0) {
                        for (let j = 0; j < fileInput.files.length; j++) {
                            dt.items.add(fileInput.files[j]);
                        }
                    }
                    dt.items.add(file);
                    if (fileInput) {
                        fileInput.files = dt.files;
                        fileInput.dispatchEvent(new Event('change', { bubbles: true }));
                        console.log('File assigned to input:', fileInput.files); // Debug log
                    }
                    foundImage = true;
                }
            }
        }
        if (foundImage) {
            event.preventDefault();
        }
    });
</script>
