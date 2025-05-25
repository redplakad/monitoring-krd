{{-- Avatar & Info Section --}}
<div class="flex flex-col items-center -mt-20 mb-6" style="background-image: url({{ $user->dataKaryawan?->foto_cover ? asset('storage/' . $user->dataKaryawan->foto_cover) : asset('images/background/bg-profile.jpg') }});">
    <div class="w-32 h-32 rounded-full border-4 border-white shadow-lg overflow-hidden bg-gray-100" style="margin-top:40px;">
        @if($user->dataKaryawan?->foto_profil)
            <img src="{{ asset('storage/' . $user->dataKaryawan->foto_profil) }}"
                 class="object-cover w-full h-full" alt="Avatar">
        @else
            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=128"
                 class="object-cover w-full h-full" alt="Avatar">
        @endif
    </div>

    <div class="mt-4 text-center flex items-center justify-center gap-2">
        <div class="text-2xl md:text-3xl font-bold text-white" style="padding:10px;">
            {{ $user->name }}
        </div>
        <button class="flex items-center hover:bg-white text-gray-800 px-3 py-1 rounded-lg shadow text-sm font-semibold transition ml-2" style="background-color:rgba(255,255,255,0.4) !important;">
            <x-heroicon-o-pencil class="h-5 w-5 text-white" />
        </button>
    </div>
</div>
