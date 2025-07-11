<div>
    <div class="flex flex-row gap-2 mb-3">
        @livewire('whatsapp-button', ['nomorRekening' => $nomorRekening])
        @include('livewire.kredit-notes-create-button')
    </div>
    <div>
        @if ($successMessage)
            <div class="border border-green-400 text-green-700 text-sm px-4 py-3 rounded relative mb-4 mt-2"
                role="alert" style="background-color: #e1f9e8;color:#1ea672;">
                <span class="block sm:inline">{{ $successMessage }}</span>
                <button wire:click="$set('successMessage', null)" class="absolute top-0 right-0 px-4 py-3"
                    style="display: absolute;top: 0;right:0;">
                    <svg class="fill-current h-4 w-4 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" style="color:#1ea672;">
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </button>
            </div>
        @endif
    </div>
    @include('livewire.kredit-notes-badge-list')

    @if ($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div
                class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0;border-color:#dfdfdf;">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                    wire:click="closeModal">
                </div>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 mt-4"
                        style="margin-top: 50px;border:1px solid $fefefe;">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                            {{ $noteId ? 'Edit Catatan' : 'Buat Catatan Baru' }}
                        </h3>
                        <form wire:submit.prevent="save">
                            <div class="mb-4" style="margin-bottom: 1rem;">
                                <label for="tag"
                                    style="display: block; font-size: 0.95rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Tag</label>
                                <div style="position: relative;">
                                    <input type="text" id="tag" wire:model="tag"
                                        style="margin-top: 0.25rem; display: block; width: 100%; padding-left: 0.75rem; padding-right: 2.5rem; padding-top: 0.5rem; padding-bottom: 0.5rem; font-size: 1rem; border: 1px solid #D1D5DB; border-radius: 0.375rem; outline: none; transition: border-color 0.2s; box-sizing: border-box;"
                                        placeholder="PK Ulang, Susah dihubungi, tindakan, hasil...">
                                    <div
                                        style="position: absolute; top: 0.25rem; right: 0.5rem; height: 100%; display: flex; align-items: center; pointer-events: none;">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            style="height: 1.25rem; width: 1.25rem; color: #9CA3AF;" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                    </div>
                                </div>
                                @error('tag')
                                    <span style="color: #EF4444; font-size: 0.8rem;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4" style="margin-bottom: 1rem;">
                                <label for="content"
                                    style="display: block; font-size: 0.95rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Isi
                                    Catatan</label>
                                <textarea id="content" wire:model="content" rows="5"
                                    style="margin-top: 1rem; display: block; width: 100%; border: 1px solid #D1D5DB; border-radius: 0.375rem; box-shadow: 0 1px 2px rgba(0,0,0,0.03); padding: 0.5rem 0.75rem; font-size: 1rem; outline: none; transition: border-color 0.2s; box-sizing: border-box;"
                                    placeholder="Tulis catatan di sini..."></textarea>
                                @error('content')
                                    <span style="color: #EF4444; font-size: 0.8rem;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div
                                style="margin-top: 1.25rem; display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                                <button type="button" wire:click="closeModal"
                                    style="width: 100%; display: inline-flex; justify-content: center; border-radius: 0.375rem; border: 1px solid #D1D5DB; box-shadow: 0 1px 2px rgba(0,0,0,0.03); padding: 0.5rem 1rem; background: #fff; font-size: 1rem; font-weight: 500; color: #374151; cursor: pointer; transition: background 0.2s;"
                                    onmouseover="this.style.background='#F3F4F6';"
                                    onmouseout="this.style.background='#fff';">
                                    Batal
                                </button>
                                <button type="submit"
                                    style="width: 100%; display: inline-flex; justify-content: center; border-radius: 0.375rem; border: none; box-shadow: 0 1px 2px rgba(0,0,0,0.03); padding: 0.5rem 1rem; background: #2563EB; font-size: 1rem; font-weight: 500; color: #fff; cursor: pointer; transition: background 0.2s;"
                                    onmouseover="this.style.background='#1D4ED8';"
                                    onmouseout="this.style.background='#2563EB';">
                                    {{ $noteId ? 'Perbarui' : 'Simpan' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Modal konfirmasi hapus --}}
    <div x-data="{ showDeleteModal: false, noteId: null }" x-init="window.addEventListener('show-delete-modal', e => {
        showDeleteModal = true;
        noteId = e.detail.noteId;
    });" x-show="showDeleteModal"
        style="display: none;background-color: rgba(0, 0, 0, 0.4);z-index: 100;"
        class="fixed inset-0 z-100 flex items-center justify-center bg-black bg-opacity-40">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-xs">
            <h2 class="text-sm font-semibold mb-2 text-gray-800">Konfirmasi Hapus</h2>
            <p class="text-xs text-gray-600 mb-4">Apakah Anda yakin ingin menghapus catatan ini?</p>
            <div class="flex justify-end space-x-2">
                <button @click="showDeleteModal = false"
                    class="px-3 py-1 rounded border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 text-xs"
                    style="transition: background 0.2s;margin: 2px;">Batal</button>
                <button
                    @click="
                        showDeleteModal = false;
                        $wire.deleteNote(noteId);
                    "
                    class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-700 text-xs"
                    style="transition: background 0.2s;background-color:#EF4444;margin:2px;">Hapus</button>
            </div>
        </div>
    </div>
</div>
