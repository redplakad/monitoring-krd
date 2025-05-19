<?php

namespace App\Filament\Imports;

use App\Models\NominatifKredit;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class NominatifKreditImporter extends Importer
{
    protected static ?string $model = NominatifKredit::class;

    public static function getColumns(): array
    {
return [
    ImportColumn::make('DATADATE')->label('DATADATE'),
    ImportColumn::make('CAB')->label('CAB'),
    ImportColumn::make('NOMOR_REKENING')->label('NOMOR_REKENING'),
    ImportColumn::make('NO_CIF')->label('NO_CIF'),
    ImportColumn::make('NAMA_NASABAH')->label('NAMA_NASABAH'),
    ImportColumn::make('ALAMAT')->label('ALAMAT'),
    ImportColumn::make('KODE_KOLEK')->label('KODE_KOLEK'),
    ImportColumn::make('JML_HRI_PKK')->label('JML_HRI_PKK'),
    ImportColumn::make('JML_HARI_BGA')->label('JML_HARI_BGA'),
    ImportColumn::make('JML_HARI_TUNGGAKAN')->label('JML_HARI_TUNGGAKAN'),
    ImportColumn::make('KD_PRD')->label('KD_PRD'),
    ImportColumn::make('KET_KD_PRD')->label('KET_KD_PRD'),
    ImportColumn::make('NOMOR_PERJANJIAN')->label('NOMOR_PERJANJIAN'),
    ImportColumn::make('NO_AKSEP')->label('NO_AKSEP'),
    ImportColumn::make('TGL_PK')->label('TGL_PK'),
    ImportColumn::make('TGL_AWAL_FAS')->label('TGL_AWAL_FAS'),
    ImportColumn::make('TGL_AKHIR_FAS')->label('TGL_AKHIR_FAS'),
    ImportColumn::make('TGL_AWAL_AKSEP')->label('TGL_AWAL_AKSEP'),
    ImportColumn::make('TGL_AKH_AKSEP')->label('TGL_AKH_AKSEP'),
    ImportColumn::make('PLAFOND_AWAL')->label('PLAFOND_AWAL'),
    ImportColumn::make('BAKI_DEBET')->label('BAKI_DEBET'),
    ImportColumn::make('LONGGAR_TARIK')->label('LONGGAR_TARIK'),
    ImportColumn::make('BGA')->label('%BGA')->requiredMapping(),
    ImportColumn::make('TUNGGAKAN_POKOK')->label('TUNGGAKAN_POKOK'),
    ImportColumn::make('TUNGGAKAN_BUNGA')->label('TUNGGAKAN_BUNGA'),
    ImportColumn::make('BGA_JTH_TEMPO')->label('BGA_JTH_TEMPO'),
    ImportColumn::make('SMP_TGL_CADANG')->label('SMP_TGL_CADANG'),
    ImportColumn::make('NILAI_CADANG')->label('NILAI_CADANG'),
    ImportColumn::make('ANGSURAN_TOTAL')->label('ANGSURAN_TOTAL'),
    ImportColumn::make('TGL_PROSES_DENDA')->label('TGL_PROSES_DENDA'),
    ImportColumn::make('AKUM_DENDA_PKK')->label('AKUM_DENDA_PKK'),
    ImportColumn::make('AKUM_DENDA_BGA')->label('AKUM_DENDA_BGA'),
    ImportColumn::make('PRD_AMORT')->label('PRD_AMORT'),
    ImportColumn::make('PRDK_AMORT')->label('PRDK_AMORT'),
    ImportColumn::make('FLAG')->label('FLAG'),
    ImportColumn::make('TGL_AMORT')->label('TGL_AMORT'),
    ImportColumn::make('NILAI_BIAYA_PROVISI')->label('NILAI_BIAYA_PROVISI'),
    ImportColumn::make('AMORTISASI_PER_PRD')->label('AMORTISASI/PRD')->requiredMapping(),
    ImportColumn::make('SISA_AMORT_PROV')->label('SISA_AMORT_PROV'),
    ImportColumn::make('TAGIH_BIAYA_PROV')->label('TAGIH_BIAYA_PROV'),
    ImportColumn::make('NILAI_BIAYA_ADM')->label('NILAI_BIAYA_ADM'),
    ImportColumn::make('AMORT_ADM_PER_PRD')->label('AMORT_ADM/PRD')->requiredMapping(),
    ImportColumn::make('SISA_AMORT_ADM')->label('SISA_AMORT_ADM'),
    ImportColumn::make('BYA_ASURANSI')->label('BYA_ASURANSI'),
    ImportColumn::make('BYA_NOTARIS')->label('BYA_NOTARIS'),
    ImportColumn::make('PKK_JATEM')->label('PKK_JATEM'),
    ImportColumn::make('BGA_JATEM')->label('BGA_JATEM'),
    ImportColumn::make('REK_BYR_PKK_BGA')->label('REK_BYR_PKK_BGA'),
    ImportColumn::make('SLD_REK_DB')->label('SLD_REK_DB'),
    ImportColumn::make('KD_INSTANSI')->label('KD_INSTANSI'),
    ImportColumn::make('NM_INSTANSI')->label('NM_INSTANSI'),
    ImportColumn::make('REK_BENDAHARA')->label('REK_BENDAHARA'),
    ImportColumn::make('SFT_KRD')->label('SFT_KRD'),
    ImportColumn::make('GOL_KRD')->label('GOL_KRD'),
    ImportColumn::make('JNS_KRD')->label('JNS_KRD'),
    ImportColumn::make('SKTR_EKNM')->label('SKTR_EKNM'),
    ImportColumn::make('ORNTS')->label('ORNTS'),
    ImportColumn::make('NO_HP')->label('NO_HP'),
    ImportColumn::make('POKOK_PINJAMAN')->label('POKOK_PINJAMAN'),
    ImportColumn::make('TITIPAN_EFEKTIF')->label('TITIPAN_EFEKTIF'),
    ImportColumn::make('JANGKA_WAKTU')->label('JANGKA_WAKTU'),
    ImportColumn::make('REK_PENCAIRAN')->label('REK_PENCAIRAN'),
    ImportColumn::make('NO_REKENING_LAMA')->label('NO_REKENING_LAMA'),
    ImportColumn::make('CIF_LAMA')->label('CIF_LAMA'),
    ImportColumn::make('KODE_GROUP')->label('KODE_GROUP'),
    ImportColumn::make('KET_GROUP')->label('KET_GROUP'),
    ImportColumn::make('TGL_LAHIR')->label('TGL_LAHIR'),
    ImportColumn::make('NIK')->label('NIK'),
    ImportColumn::make('NIP')->label('NIP'),
    ImportColumn::make('NILAI_BYA_TRANS')->label('NILAI_BYA_TRANS'),
    ImportColumn::make('AMORT_TRANS_PER_PRD')->label('AMORT_TRANS/PRD')->requiredMapping(),
    ImportColumn::make('SISA_AMORT_TRANS')->label('SISA AMORT_TRANS')->requiredMapping(),
    ImportColumn::make('AO')->label('AO'),
    ImportColumn::make('CAB_REK')->label('CAB_REK'),
    ImportColumn::make('KELURAHAN')->label('KELURAHAN'),
    ImportColumn::make('KECAMATAN')->label('KECAMATAN'),
    ImportColumn::make('CADANGAN_PPAP')->label('CADANGAN_PPAP'),
    ImportColumn::make('TEMPAT_BEKERJA')->label('TEMPAT_BEKERJA'),
    ImportColumn::make('TGL_AKHIR_BAYAR')->label('TGL_AKHIR_BAYAR'),
    ImportColumn::make('PIHAK_TERKAIT')->label('PIHAK_TERKAIT'),
    ImportColumn::make('JENIS_JAMINAN')->label('JENIS_JAMINAN'),
    ImportColumn::make('NILAI_LEGALITAS')->label('NILAI_LEGALITAS'),
    ImportColumn::make('RESTRUKTUR_KE')->label('RESTRUKTUR_KE'),
    ImportColumn::make('TGL_VALID_KOLEK')->label('TGL_VALID_KOLEK'),
    ImportColumn::make('TGL_MACET')->label('TGL_MACET'),
];
    }

    public function resolveRecord(): ?NominatifKredit
    {
        // return NominatifKredit::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new NominatifKredit();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your nominatif kredit import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
