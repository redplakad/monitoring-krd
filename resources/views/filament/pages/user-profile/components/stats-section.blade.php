{{-- Stats Bar Section --}}
<div class="px-8 pb-2">
    <div class="flex flex-col md:flex-row items-center justify-between mb-2">
        <div class="flex flex-col md:flex-row items-center gap-6 mt-3 px-6">
            <div class="flex flex-col items-center px-6 py-2" style="border-right:1px solid #efefef">
                <svg class="w-6 h-6 text-blue-500 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3"></path><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"></circle></svg>
                <div class="text-xs text-gray-500 font-semibold uppercase">Aktivitas</div>
                <div class="text-lg font-bold mt-1">{{ \App\Models\MonitoringKredit::where('user_id', $user->id)->count() }}</div>
            </div>
            <div class="flex flex-col items-center px-6 py-2" style="border-right:1px solid #efefef">
                <svg class="w-6 h-6 text-green-500 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2h5"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <div class="text-xs text-gray-500 font-semibold uppercase">Kunjungan</div>
                <div class="text-lg font-bold mt-1">{{ \App\Models\MonitoringKredit::where('user_id', $user->id)->where('TINDAKAN', 'Kunjungan')->count() }}</div>
            </div>
            <div class="flex flex-col items-center px-6 py-2" style="border-right:1px solid #efefef">
                <svg class="w-6 h-6 text-purple-500 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path><polyline points="17 8 12 13 7 8"></polyline></svg>
                <div class="text-xs text-gray-500 font-semibold uppercase">Komunikasi</div>
                <div class="text-lg font-bold mt-1">{{ \App\Models\MonitoringKredit::where('user_id', $user->id)->whereIn('TINDAKAN', ['Telepon', 'Whatsapp'])->count() }}</div>
            </div>
            <div class="flex flex-col items-center px-6 py-2" style="border-right:1px solid #efefef">
                <svg class="w-6 h-6 text-yellow-500 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                <div class="text-xs text-gray-500 font-semibold uppercase">Debitur</div>
                <div class="text-lg font-bold mt-1">{{ $user->countDebitur() }}</div>
            </div>
            <div class="flex flex-col items-center px-6 py-2" style="border-right:1px solid #efefef">
                <svg class="w-6 h-6 text-red-500 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect><path d="M12 11v6"></path><path d="M9 18h6"></path></svg>
                <div class="text-xs text-gray-500 font-semibold uppercase">NPL %</div>
                <div class="text-lg font-bold mt-1">{{ $user->nplPercentage() }}%</div>
            </div>
            <div class="flex flex-col items-center px-6 py-2">
                <svg class="w-6 h-6 text-red-500 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect><path d="M12 11v6"></path><path d="M9 18h6"></path></svg>
                <div class="text-xs text-gray-500 font-semibold uppercase">NPL Rp.</div>
                <div class="text-lg font-bold mt-1">{{ number_format($user->sumNPL(),0) }}</div>
            </div>
        </div>
        @if(auth()->id() === $user->id)
        <div class="mt-3 px-6">	
            <x-filament::button color="success" icon="heroicon-o-pencil">
                Edit Profile
            </x-filament::button>
        </div>
        @else
        <div class="mt-3 px-6">	
            <x-filament::button color="success" icon="heroicon-o-pencil" disabled>
                Edit Profile
            </x-filament::button>
        </div>
        @endif
    </div>
</div>
