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
                            <div class="flex items-center justify-between mb-2">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
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
                                    style="width:48px;height:48px;border-radius:9999px;object-fit:cover;margin-right:8px;">
                                <span class="text-xs text-gray-700 font-semibold">{{ $note->user->name }}</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="text-xs text-gray-700 whitespace-pre-wrap">
                                {{ $note->content }}
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 flex justify-between items-end">
                            <span class="text-xs text-gray-400 self-end">
                                {{ $note->created_at->format('d M Y H:i') }}
                            </span>
                            <div class="flex space-x-2">
                                <button wire:click="editNote({{ $note->id }})" @click="open = false"
                                    class="inline-flex items-center px-2 py-1 border border-transparent text-xs leading-4 font-medium rounded text-blue-700 bg-blue-100"
                                    onmouseover="this.style.background='#DBEAFE';this.style.color='#1D4ED8';"
                                    onmouseout="this.style.background='#BFDBFE';this.style.color='#2563EB';"
                                    style="background-color:#BFDBFE;margin:2px;">
                                    <x-tabler-edit style="height: 16px;width:16px;" />
                                </button>
                                <button
                                    @click.prevent="window.dispatchEvent(new CustomEvent('show-delete-modal', {detail: {noteId: {{ $note->id }}}})); open = false"
                                    class="inline-flex items-center px-2 py-1 border border-transparent text-xs leading-4 font-medium rounded text-red-700 bg-red-100"
                                    onmouseover="this.style.background='#FCA5A5';this.style.color='#B91C1C';"
                                    onmouseout="this.style.background='#FECACA';this.style.color='#DC2626';"
                                    style="background-color:#FECACA;margin:2px;">
                                    <x-tabler-trash style="height: 16px;width:16px;" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
