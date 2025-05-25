<?php

namespace App\Filament\Resources\NominatifKreditResource\Pages;

use Filament\Resources\Pages\Page;
use App\Models\NominatifKredit;
use App\Filament\Resources\NominatifKreditResource;
use App\Models\MonitoringKredit;

class DetailKredit extends Page
{
    protected static string $resource = NominatifKreditResource::class;

    protected static string $view = 'filament.resources.nominatif-kredit-resource.pages.detail-kredit';

    public $record;
    public $count_kunjungan;
    public $count_panggilan;

    public function mount($record): void
    {
        $nomorRekening = $record;
        // Ambil record utama berdasarkan NOMOR_REKENING
        $recordModel = NominatifKredit::where('NOMOR_REKENING', $nomorRekening)->first();

        if (!$recordModel) {
            abort(404, 'Data Kredit tidak ditemukan.');
        }

        $noCif = $recordModel->NO_CIF;
        $noLoan = $recordModel->NOMOR_REKENING;

        // Hitung kunjungan & panggilan
        $this->count_kunjungan = MonitoringKredit::where('TINDAKAN', 'Kunjungan')
            ->where('NOMOR_REKENING', $noLoan)
            ->count();

        $this->count_panggilan = MonitoringKredit::where('NOMOR_REKENING', $noLoan)
            ->whereIn('TINDAKAN', ['Whatsapp', 'Telepon'])
            ->count();

        // Ambil data record terakhir berdasarkan DATADATE
        $latestdate = NominatifKredit::where('NO_CIF', $noCif)->max('DATADATE');

        $this->record = NominatifKredit::where('NO_CIF', $noCif)
            ->where('DATADATE', $latestdate)
            ->firstOrFail();

        // Tambahkan data monitoring
        $this->record->monitoring = MonitoringKredit::where('NOMOR_REKENING', $noLoan)->get();
    }
}
