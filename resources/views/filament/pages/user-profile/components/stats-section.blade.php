{{-- Stats Bar Section --}}
<div class="px-8 pb-6">
    <div class="flex flex-col md:flex-row justify-center items-center gap-6 mt-3">
        <div class="flex flex-col items-center px-6 py-2">
            <div class="text-gray-600 font-medium mt-1">
                {{ $user->dataKaryawan?->position?->nama ?? 'No Position Available' }}
            </div>
            <div class="text-gray-400 text-sm">
                {{ $user->dataKaryawan?->branch?->nama ?? '-' }}
            </div>
        </div>
        <div class="flex flex-col items-center px-6 py-2" style="border-right:1px solid #efefef">
            <svg class="w-6 h-6 text-blue-500 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3"></path><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"></circle></svg>
            <div class="text-xs text-gray-500 font-semibold uppercase">Aktivitas</div>
            <div class="text-lg font-bold mt-1">{{ $user->monitoringKredits()->count() }}</div>
        </div>
        <div class="flex flex-col items-center px-6 py-2" style="border-right:1px solid #efefef">
            <svg class="w-6 h-6 text-green-500 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2h5"></path><circle cx="12" cy="7" r="4"></circle></svg>
            <div class="text-xs text-gray-500 font-semibold uppercase">Kunjungan</div>
            <div class="text-lg font-bold mt-1">{{ $user->monitoringKredits()->where('tindakan', 'Kunjungan')->count() }}</div>
        </div>
        <div class="flex flex-col items-center px-6 py-2">
            <svg class="w-6 h-6 text-purple-500 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path><polyline points="17 8 12 13 7 8"></polyline></svg>
            <div class="text-xs text-gray-500 font-semibold uppercase">Komunikasi</div>
            <div class="text-lg font-bold mt-1">{{ $user->monitoringKredits()->whereIn('tindakan', ['Telepon', 'Whatsapp'])->count() }}</div>
        </div>
    </div>
</div>
