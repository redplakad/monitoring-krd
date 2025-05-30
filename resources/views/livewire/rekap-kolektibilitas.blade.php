<div class="overflow-x-auto">
    <table class="table table-zebra w-full bg-white border rounded-lg">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b">Kolektibilitas</th>
                <th class="px-4 py-2 border-b">Debitur</th>
                <th class="px-4 py-2 border-b">Plafond</th>
                <th class="px-4 py-2 border-b">Bakidebet</th>
                <th class="px-4 py-2 border-b">PPAP</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kolekMap as $kode => $label)
                @php
                    $row = $rekap->firstWhere('KODE_KOLEK', $kode);
                    $debitur = $row ? $row->debitur : 0;
                    $plafond = $row ? $row->plafond : 0;
                    $bakidebet = $row ? $row->bakidebet : 0;
                    $ppap = $row ? $row->ppap : 0;
                @endphp
                <tr>
                    <td class="px-4 py-2 border-b">{{ $label }}</td>
                    <td class="px-4 py-2 border-b text-right">{{ $debitur }}</td>
                    <td class="px-4 py-2 border-b text-right">{{ number_format($plafond, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border-b text-right">{{ number_format($bakidebet, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border-b text-right">{{ number_format($ppap, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="font-bold bg-gray-100">
                <td class="px-4 py-2 border-t">Total</td>
                <td class="px-4 py-2 border-t text-right">{{ $totalDebitur }}</td>
                <td class="px-4 py-2 border-t text-right">{{ number_format($totalPlafond, 0, ',', '.') }}</td>
                <td class="px-4 py-2 border-t text-right">{{ number_format($totalBakidebet, 0, ',', '.') }}</td>
                <td class="px-4 py-2 border-t text-right">{{ number_format($totalPpap, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</div>
