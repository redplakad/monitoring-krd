{{-- User Info Section --}}
<div class="kolom-1 w-full md:w-1/3 max-w-md bg-white rounded-xl shadow p-6 mb-6 md:mb-0 flex-shrink-0">
    <ul class="space-y-4">
        <li class="flex items-center gap-3">
            <span class="bg-blue-100 text-blue-600 rounded-full p-2">
                <x-tabler-user-square-rounded />
            </span>
            <div>
                <div class="text-xs text-gray-500">Nama</div>
                <div class="text-gray-800">{{ $user->name }}</div>
            </div>
        </li>
        <li class="flex items-center gap-3">
            <span class="bg-green-100 text-green-600 rounded-full p-2">
                <x-tabler-mail />
            </span>
            <div>
                <div class="text-xs text-gray-500">Email</div>
                <div class="text-gray-800">{{ $user->email }}</div>
            </div>
        </li>
        <li class="flex items-center gap-3">
            <span class="bg-yellow-100 text-yellow-600 rounded-full p-2">
                <x-tabler-phone />
            </span>
            <div>
                <div class="text-xs text-gray-500">Telepon</div>
                <div class="text-gray-800">{{ $user->dataKaryawan?->telepon ?? '-' }}</div>
            </div>
        </li>
        <li class="flex items-center gap-3">
            <span class="bg-purple-100 text-purple-600 rounded-full p-2">
                <x-tabler-home />
            </span>
            <div>
                <div class="text-xs text-gray-500">Alamat</div>
                <div class="text-gray-800">{{ $user->dataKaryawan?->alamat ?? '-' }}</div>
            </div>
        </li>
        <li class="flex items-center gap-3">
            <span class="bg-pink-100 text-pink-600 rounded-full p-2">
                <x-tabler-building-skyscraper />
            </span>
            <div>
                <div class="text-xs text-gray-500">Cabang</div>
                <div class="text-gray-800">{{ $user->dataKaryawan?->branch?->nama ?? '-' }}</div>
            </div>
        </li>
        <li class="flex items-center gap-3">
            <span class="bg-indigo-100 text-indigo-600 rounded-full p-2">
                <x-tabler-user-star />
            </span>
            <div>
                <div class="text-xs text-gray-500">Jabatan</div>
                <div class="text-gray-800">{{ $user->dataKaryawan?->position?->nama ?? '-' }}</div>
            </div>
        </li>
    </ul>
</div>
