<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\NominatifKredit;

class RekapKolektibilitas extends Component
{
    public $rekap;
    public $kolekMap = [
        '1' => '1 - Lancar',
        '2' => '2 - Dalam Perhatian Khusus',
        '3' => '3 - Kurang Lancar',
        '4' => '4 - Diragukan',
        '5' => '5 - Macet',
    ];

    public $totalDebitur = 0;
    public $totalPlafond = 0;
    public $totalBakidebet = 0;
    public $totalPpap = 0;

    public function mount()
    {
        $this->rekap = NominatifKredit::selectRaw('
            KODE_KOLEK,
            COUNT(*) as debitur,
            SUM(PLAFOND_AWAL) as plafond,
            SUM(POKOK_PINJAMAN) as bakidebet,
            SUM(CADANGAN_PPAP) as ppap
        ')
        ->groupBy('KODE_KOLEK')
        ->orderBy('KODE_KOLEK')
        ->get();

        foreach ($this->kolekMap as $kode => $label) {
            $row = $this->rekap->firstWhere('KODE_KOLEK', $kode);
            $debitur = $row ? $row->debitur : 0;
            $plafond = $row ? $row->plafond : 0;
            $bakidebet = $row ? $row->bakidebet : 0;
            $ppap = $row ? $row->ppap : 0;
            $this->totalDebitur += $debitur;
            $this->totalPlafond += $plafond;
            $this->totalBakidebet += $bakidebet;
            $this->totalPpap += $ppap;
        }
    }

    public function render()
    {
        return view('livewire.rekap-kolektibilitas');
    }
}
