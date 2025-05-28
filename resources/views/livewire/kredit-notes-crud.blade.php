<div>
    @if($successMessage)
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ $successMessage }}</span>
            <button wire:click="$set('successMessage', null)" class="absolute top-0 right-0 px-4 py-3">
                <svg class="fill-current h-4 w-4 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                </svg>
            </button>
        </div>
    @endif

    <div class="rounded-lg shadow-md">
        <button wire:click="openModal" class="flex items-center justify-center gap-2 text-white px-4 py-2 rounded-md font-medium text-sm w-full" style="background-color: #4299e1; transition: all 0.3s ease; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); border: none;" onmouseover="this.style.backgroundColor='#3182ce'" onmouseout="this.style.backgroundColor='#4299e1'">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Buat Catatan
        </button>
    </div>

    @if(count($notes) > 0)
        <div class="mt-6 py-4 bg-white rounded-lg shadow-md border-t border-gray-200">
            <div class="flex flex-wrap gap-2 items-center pb-1 min-h-[32px]">
                @foreach($notes as $note)
                    <div x-data="{ open: false }" class="relative">
                        <button 
                            @click="open = !open" 
                            @click.away="open = false"
                            class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium cursor-pointer transition-all duration-200 ease-in-out"
                            style="background-color: #EBF5FF; color: #3182CE; border: 1px solid #BEE3F8; box-shadow: 0 1px 2px rgba(0,0,0,0.05);"
                            onmouseover="this.style.backgroundColor='#BEE3F8'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)';"
                            onmouseout="this.style.backgroundColor='#EBF5FF'; this.style.boxShadow='0 1px 2px rgba(0,0,0,0.05)';"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            {{ $note->tag }}
                        </button>

                        <div 
                            x-show="open" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute z-50 mt-2 bg-white rounded-md shadow-lg"
                            style=""
                            x-bind:style="window.innerWidth - $el.getBoundingClientRect().right < 340 ? 'left: auto; right: 0; transform-origin: top right;' : ''"
                        >
                            <div class="p-4 border-b">
                                <div class="flex items-center justify-between">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $note->tag }}
                                    </span>
                                    <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">oleh {{ $note->user->name }}</p>
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
                                <button wire:click="editNote({{ $note->id }})" @click="open = false" class="inline-flex items-center px-2 py-1 border border-transparent text-xs leading-4 font-medium rounded text-blue-700 bg-blue-100 hover:bg-blue-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button wire:click="deleteNote({{ $note->id }})" onclick="return confirm('Apakah Anda yakin ingin menghapus catatan ini?')" class="inline-flex items-center px-2 py-1 border border-transparent text-xs leading-4 font-medium rounded text-red-700 bg-red-100 hover:bg-red-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
