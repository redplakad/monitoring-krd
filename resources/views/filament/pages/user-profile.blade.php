<x-filament::page>
    <div class="rounded-xl overflow-hidden bg-white shadow mb-8">
        {{-- Cover --}}
        <div class="relative h-48 md:h-56">
            <img
                src="{{ $user->dataKaryawan?->foto_cover ? asset('storage/' . $user->dataKaryawan->foto_cover) : asset('images/background/bg-profile.jpg') }}"
                alt="Cover"
                class="object-cover w-full h-full"
            >
            <button class="absolute top-4 right-4 bg-white/80 hover:bg-white text-gray-800 px-4 py-2 rounded-lg shadow text-sm font-semibold transition">
                Edit Profile
            </button>
            {{-- Avatar & Info --}}
            <div class="absolute left-8 -bottom-16 flex items-end">
                <div class="w-32 h-32 rounded-full border-4 border-white shadow-lg overflow-hidden bg-gray-100">
                    @if($user->dataKaryawan?->foto_profil)
                        <img src="{{ asset('storage/' . $user->dataKaryawan->foto_profil) }}"
                             class="object-cover w-full h-full" alt="Avatar">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=128"
                             class="object-cover w-full h-full" alt="Avatar">
                    @endif
                </div>
                <div class="pl-10 mb-4 -mt-40">
                    <div class="text-2xl md:text-3xl font-bold text-white drop-shadow bg-black/50 px-2 py-1 rounded">
                        {{ $user->name }}
                    </div>
                    <div class="text-white/80 font-medium drop-shadow">
                        {{ $user->dataKaryawan?->position?->nama ?? 'No Position Available' }}
                        <span class="mx-2">|</span>
                        {{ $user->dataKaryawan?->branch?->nama ?? '-' }}
                    </div>
                </div>
            </div>
        </div>
        {{-- Spacer for avatar --}}
        <div class="h-20"></div>
        {{-- Stats Bar --}}
        <div class="flex flex-col md:flex-row justify-between items-center px-8 pb-4 pt-2 gap-4">
            <div class="flex-1 grid grid-cols-2 md:grid-cols-7 gap-4 text-center">
                <div>
                    <div class="text-xs text-gray-500 font-semibold uppercase">Post</div>
                    <div class="text-lg font-bold">10,3K</div>
                </div>
                <div>
                    <div class="text-xs text-gray-500 font-semibold uppercase">Followers</div>
                    <div class="text-lg font-bold">2,564</div>
                </div>
                <div>
                    <div class="text-xs text-gray-500 font-semibold uppercase">Following</div>
                    <div class="text-lg font-bold">3,154</div>
                </div>
                <div>
                    <div class="text-xs text-gray-500 font-semibold uppercase">Likes</div>
                    <div class="text-lg font-bold">12,2K</div>
                </div>
                <div>
                    <div class="text-xs text-gray-500 font-semibold uppercase">Photos</div>
                    <div class="text-lg font-bold">35</div>
                </div>
                <div>
                    <div class="text-xs text-gray-500 font-semibold uppercase">Videos</div>
                    <div class="text-lg font-bold">24</div>
                </div>
                <div>
                    <div class="text-xs text-gray-500 font-semibold uppercase">Saved</div>
                    <div class="text-lg font-bold">18</div>
                </div>
            </div>
        </div>
    </div>
</x-filament::page>
