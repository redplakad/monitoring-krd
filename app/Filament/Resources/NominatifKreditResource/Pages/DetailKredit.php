<?php

namespace App\Filament\Resources\NominatifKreditResource\Pages;
use Illuminate\Contracts\Encryption\DecryptException;

use Filament\Resources\Pages\Page;
use App\Models\NominatifKredit;
use App\Filament\Resources\NominatifKreditResource;
use App\Models\MonitoringKredit;

class DetailKredit extends Page
{
    protected static string $resource = NominatifKreditResource::class;

    protected static string $view = 'filament.resources.nominatif-kredit-resource.pages.detail-kredit';

    public $record;

public function mount($record): void
{
    try {
        $id = $record;
    } catch (DecryptException $e) {
        abort(403, 'Payload tidak valid.');
    }

    // Get NO_CIF from record with sha1(id) = $id
    $noCif = NominatifKredit::whereRaw('sha1(id) = ?', [$id])->value('NO_CIF');
    $noLoan = NominatifKredit::whereRaw('sha1(id) = ?', [$id])->value('NOMOR_REKENING');

    if (!$noCif && !$noLoan) {
        abort(404, 'Data CIF tidak ditemukan.');
    }

    // Get latest DATADATE for that CIF
    $latestdate = NominatifKredit::where('NO_CIF', $noCif)->max('DATADATE');

    // Get the full record
    $this->record = NominatifKredit::where('NO_CIF', $noCif)
        ->where('DATADATE', $latestdate)
        ->firstOrFail();

    // Tambahkan data monitoring
    $this->record->monitoring = MonitoringKredit::whereRaw('NOMOR_REKENING = ?', [$noLoan])->get();
}


}
