<div>
    @if ($successMessage)
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ $successMessage }}</span>
            <button wire:click="$set('successMessage', null)" class="absolute top-0 right-0 px-4 py-3">
                <svg class="fill-current h-4 w-4 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </button>
        </div>
    @endif

    <div class="rounded-lg shadow-md">
        <button wire:click="openModal"
            class="flex items-center justify-center gap-2 text-white px-4 py-2 rounded-md font-medium text-sm w-full"
            style="background-color: #4299e1; transition: all 0.3s ease; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); border: none;"
            onmouseover="this.style.backgroundColor='#3182ce'" onmouseout="this.style.backgroundColor='#4299e1'">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Buat Catatan
        </button>
    </div>

    @if (count($notes) > 0)
        <div class="mt-6 py-4 bg-white rounded-lg shadow-md border-t border-gray-200">
            <div class="flex flex-wrap gap-2 items-center pb-1 min-h-[32px]">
                @foreach ($notes as $note)
                    <div x-data="{
                        open: false,
                        timer: null,
                        show() {
                            clearTimeout(this.timer);
                            this.open = true;
                        },
                        hide() {
                            this.timer = setTimeout(() => { this.open = false }, 120);
                        }
                    }" class="relative">
                        <button @mouseenter="show()" @mouseleave="hide()"
                            class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium cursor-pointer transition-all duration-200 ease-in-out"
                            style="background-color: #EBF5FF; color: #3182CE; border: 1px solid #BEE3F8; box-shadow: 0 1px 2px rgba(0,0,0,0.05);"
                            onmouseover="this.style.backgroundColor='#BEE3F8'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)';"
                            onmouseout="this.style.backgroundColor='#EBF5FF'; this.style.boxShadow='0 1px 2px rgba(0,0,0,0.05)';">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            {{ $note->tag }}
                        </button>

                        <div x-show="open" @mouseenter="show()" @mouseleave="hide()"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            style="position: absolute; z-index: 50; top: 100%; left: 0; margin-top: 0.25rem; background: #fff; border-radius: 0.375rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); min-width: 260px; max-width: 340px; border: 1px solid #e5e7eb;"
                            x-bind:style="window.innerWidth - $el.getBoundingClientRect().right < 340 ?
                                'left: auto; right: 0; transform-origin: top right; position: absolute; z-index: 50; top: 100%; margin-top: 0.25rem; background: #fff; border-radius: 0.375rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); min-width: 260px; max-width: 340px; border: 1px solid #e5e7eb;' :
                                'position: absolute; z-index: 50; top: 100%; left: 0; margin-top: 0.25rem; background: #fff; border-radius: 0.375rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); min-width: 260px; max-width: 340px; border: 1px solid #e5e7eb;'">
                            <div class="p-4 border-b">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $note->tag }}
                                    </span>
                                    <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex items-center mt-2">
                                    @php
                                        $avatar = $note->user->dataKaryawan?->foto_profil ? asset('storage/' . $note->user->dataKaryawan->foto_profil) : 'https://avatar.iran.liara.run/public/boy?username=' . urlencode($note->user->name) . '&size=128';
                                    @endphp
                                    <img src="{{ $avatar }}" alt="Avatar"
                                        style="width:28px;height:28px;border-radius:9999px;object-fit:cover;margin-right:8px;">
                                    <span class="text-xs text-gray-700 font-semibold">{{ $note->user->name }}</span>
                                </div>
                                <span class="text-xs text-gray-400 block mt-0.5">
                                    {{ $note->created_at->format('d M Y H:i') }}
                                </span>
                            </div>
                            <div class="p-4">
                                <div class="text-sm text-gray-700 whitespace-pre-wrap">
                                    {{ $note->content }}
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 flex justify-end space-x-2">
                                <button wire:click="editNote({{ $note->id }})" @click="open = false"
                                    class="inline-flex items-center px-2 py-1 border border-transparent text-xs leading-4 font-medium rounded text-blue-700 bg-blue-100"
                                    onmouseover="this.style.background='#DBEAFE';this.style.color='#1D4ED8';"
                                    onmouseout="this.style.background='#BFDBFE';this.style.color='#2563EB';"
                                    style="background-color:#BFDBFE;margin:2px;"
                                    >
                                    <x-tabler-edit style="height: 16px;width:16px;"/>
                                </button>
                                <button
                                    @click.prevent="window.dispatchEvent(new CustomEvent('show-delete-modal', {detail: {noteId: {{ $note->id }}}})); open = false"
                                    class="inline-flex items-center px-2 py-1 border border-transparent text-xs leading-4 font-medium rounded text-red-700 bg-red-100"
                                    onmouseover="this.style.background='#FCA5A5';this.style.color='#B91C1C';"
                                    onmouseout="this.style.background='#FECACA';this.style.color='#DC2626';"
                                    style="background-color:#FECACA;margin:2px;">
                                    <x-tabler-trash style="height: 16px;width:16px;"/>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

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
    <div
        x-data="{ showDeleteModal: false, noteId: null }"
        x-init="
            window.addEventListener('show-delete-modal', e => {
                showDeleteModal = true;
                noteId = e.detail.noteId;
            });
        "
        x-show="showDeleteModal"
        style="display: none;background-color: rgba(0, 0, 0, 0.4);z-index: 100;"
        class="fixed inset-0 z-100 flex items-center justify-center bg-black bg-opacity-40"
    >
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-xs">
            <h2 class="text-lg font-semibold mb-2 text-gray-800">Konfirmasi Hapus</h2>
            <p class="text-sm text-gray-600 mb-4">Apakah Anda yakin ingin menghapus catatan ini?</p>
            <div class="flex justify-end space-x-2">
                <button @click="showDeleteModal = false"
                    class="px-3 py-1 rounded border border-gray-300 bg-white text-gray-700 hover:bg-gray-100"
                    style="transition: background 0.2s;margin: 2px;">Batal</button>
                <button
                    @click="
                        showDeleteModal = false;
                        $wire.deleteNote(noteId);
                    "
                    class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-700"
                    style="transition: background 0.2s;background-color:#EF4444;margin:2px;">Hapus</button>
            </div>
        </div>
    </div>
</div>
