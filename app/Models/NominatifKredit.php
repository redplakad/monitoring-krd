<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NominatifKredit extends Model
{
    use HasFactory;

    protected $table = 'nominatif_kredit';

    protected $primaryKey = 'id';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'DATADATE',
        'CAB',
        'NOMOR_REKENING',
        'NO_CIF',
        'NAMA_NASABAH',
        'ALAMAT',
        'KODE_KOLEK',
        'JML_HRI_PKK',
        'JML_HARI_BGA',
        'JML_HARI_TUNGGAKAN',
        'KD_PRD',
        'KET_KD_PRD',
        'NOMOR_PERJANJIAN',
        'NO_AKSEP',
        'TGL_PK',
        'TGL_AWAL_FAS',
        'TGL_AKHIR_FAS',
        'TGL_AWAL_AKSEP',
        'TGL_AKH_AKSEP',
        'PLAFOND_AWAL',
        'BAKI_DEBET',
        'LONGGAR_TARIK',
        'BGA',
        'TUNGGAKAN_POKOK',
        'TUNGGAKAN_BUNGA',
        'BGA_JTH_TEMPO',
        'SMP_TGL_CADANG',
        'NILAI_CADANG',
        'ANGSURAN_TOTAL',
        'TGL_PROSES_DENDA',
        'AKUM_DENDA_PKK',
        'AKUM_DENDA_BGA',
        'PRD_AMORT',
        'PRDK_AMORT',
        'FLAG',
        'TGL_AMORT',
        'NILAI_BIAYA_PROVISI',
        'AMORTISASI_PER_PRD',
        'SISA_AMORT_PROV',
        'TAGIH_BIAYA_PROV',
        'NILAI_BIAYA_ADM',
        'AMORT_ADM_PER_PRD',
        'SISA_AMORT_ADM',
        'BYA_ASURANSI',
        'BYA_NOTARIS',
        'PKK_JATEM',
        'BGA_JATEM',
        'REK_BYR_PKK_BGA',
        'SLD_REK_DB',
        'KD_INSTANSI',
        'NM_INSTANSI',
        'REK_BENDAHARA',
        'SFT_KRD',
        'GOL_KRD',
        'JNS_KRD',
        'SKTR_EKNM',
        'ORNTS',
        'NO_HP',
        'POKOK_PINJAMAN',
        'TITIPAN_EFEKTIF',
        'JANGKA_WAKTU',
        'REK_PENCAIRAN',
        'NO_REKENING_LAMA',
        'CIF_LAMA',
        'KODE_GROUP',
        'KET_GROUP',
        'TGL_LAHIR',
        'NIK',
        'NIP',
        'NILAI_BYA_TRANS',
        'AMORT_TRANS_PER_PRD',
        'SISA_AMORT_TRANS',
        'AO',
        'CAB_REK',
        'KELURAHAN',
        'KECAMATAN',
        'CADANGAN_PPAP',
        'TEMPAT_BEKERJA',
        'TGL_AKHIR_BAYAR',
        'PIHAK_TERKAIT',
        'JENIS_JAMINAN',
        'NILAI_LEGALITAS',
        'RESTRUKTUR_KE',
        'TGL_VALID_KOLEK',
        'TGL_MACET',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // Cast decimal fields to float for easier handling
        'PLAFOND_AWAL' => 'decimal:2',
        'BAKI_DEBET' => 'decimal:2',
        'LONGGAR_TARIK' => 'decimal:2',
        'BGA' => 'decimal:2',
        'TUNGGAKAN_POKOK' => 'decimal:2',
        'TUNGGAKAN_BUNGA' => 'decimal:2',
        'BGA_JTH_TEMPO' => 'decimal:2',
        'NILAI_CADANG' => 'decimal:2',
        'ANGSURAN_TOTAL' => 'decimal:2',
        'AKUM_DENDA_PKK' => 'decimal:2',
        'AKUM_DENDA_BGA' => 'decimal:2',
        'PRD_AMORT' => 'decimal:2',
        'PRDK_AMORT' => 'decimal:2',
        'NILAI_BIAYA_PROVISI' => 'decimal:2',
        'AMORTISASI_PER_PRD' => 'decimal:2',
        'SISA_AMORT_PROV' => 'decimal:2',
        'TAGIH_BIAYA_PROV' => 'decimal:2',
        'NILAI_BIAYA_ADM' => 'decimal:2',
        'AMORT_ADM_PER_PRD' => 'decimal:2',
        'SISA_AMORT_ADM' => 'decimal:2',
        'BYA_ASURANSI' => 'decimal:2',
        'BYA_NOTARIS' => 'decimal:2',
        'PKK_JATEM' => 'decimal:2',
        'BGA_JATEM' => 'decimal:2',
        'NILAI_BYA_TRANS' => 'decimal:2',
        'AMORT_TRANS_PER_PRD' => 'decimal:2',
        'SISA_AMORT_TRANS' => 'decimal:2',
        'CADANGAN_PPAP' => 'decimal:2',
        'NILAI_LEGALITAS' => 'decimal:2',
    ];

    public function monitoring()
    {
        return $this->hasMany(MonitoringKredit::class, 'NOMOR_REKENING', 'NOMOR_REKENING');
    }
}