<div>
    <ul class="space-y-2">
        <li>
            <button type="button" class="w-full text-left px-4 py-2 rounded hover:bg-gray-100" x-on:click="$dispatch('change-tab', 'rekap-kolektibilitas')">
                Rekap Kolektibilitas
            </button>
        </li>
        <li>
            <button type="button" class="w-full text-left px-4 py-2 rounded hover:bg-gray-100" x-on:click="$dispatch('change-tab', 'rekap-outstanding')">
                Rekap Outstanding
            </button>
        </li>
    </ul>
</div>
