<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nominatif_kredit', function (Blueprint $table) {
            $table->id();
            $table->string('DATADATE', 8)->nullable(); // YYYYMMDD
            $table->string('CAB', 10)->nullable();
            $table->string('NOMOR_REKENING', 30)->nullable();
            $table->string('NO_CIF', 20)->nullable();
            $table->string('NAMA_NASABAH', 100)->nullable();
            $table->text('ALAMAT')->nullable();
            $table->string('KODE_KOLEK', 10)->nullable();
            $table->integer('JML_HRI_PKK')->nullable();
            $table->integer('JML_HARI_BGA')->nullable();
            $table->integer('JML_HARI_TUNGGAKAN')->nullable();
            $table->string('KD_PRD', 20)->nullable();
            $table->string('KET_KD_PRD', 100)->nullable();
            $table->string('NOMOR_PERJANJIAN', 50)->nullable();
            $table->string('NO_AKSEP', 50)->nullable();
            $table->string('TGL_PK', 8)->nullable(); // YYYYMMDD
            $table->string('TGL_AWAL_FAS', 8)->nullable(); // YYYYMMDD
            $table->string('TGL_AKHIR_FAS', 8)->nullable(); // YYYYMMDD
            $table->string('TGL_AWAL_AKSEP', 8)->nullable(); // YYYYMMDD
            $table->string('TGL_AKH_AKSEP', 8)->nullable(); // YYYYMMDD
            $table->decimal('PLAFOND_AWAL', 18, 2)->nullable();
            $table->decimal('BAKI_DEBET', 18, 2)->nullable();
            $table->decimal('LONGGAR_TARIK', 18, 2)->nullable();
            $table->decimal('BGA', 18, 2)->nullable();
            $table->decimal('TUNGGAKAN_POKOK', 18, 2)->nullable();
            $table->decimal('TUNGGAKAN_BUNGA', 18, 2)->nullable();
            $table->decimal('BGA_JTH_TEMPO', 18, 2)->nullable();
            $table->string('SMP_TGL_CADANG', 8)->nullable(); // YYYYMMDD
            $table->decimal('NILAI_CADANG', 18, 2)->nullable();
            $table->decimal('ANGSURAN_TOTAL', 18, 2)->nullable();
            $table->string('TGL_PROSES_DENDA', 8)->nullable(); // YYYYMMDD
            $table->decimal('AKUM_DENDA_PKK', 18, 2)->nullable();
            $table->decimal('AKUM_DENDA_BGA', 18, 2)->nullable();
            $table->decimal('PRD_AMORT', 18, 2)->nullable();
            $table->decimal('PRDK_AMORT', 18, 2)->nullable();
            $table->string('FLAG', 10)->nullable();
            $table->string('TGL_AMORT', 8)->nullable(); // YYYYMMDD
            $table->decimal('NILAI_BIAYA_PROVISI', 18, 2)->nullable();
            $table->decimal('AMORTISASI_PER_PRD', 18, 2)->nullable();
            $table->decimal('SISA_AMORT_PROV', 18, 2)->nullable();
            $table->decimal('TAGIH_BIAYA_PROV', 18, 2)->nullable();
            $table->decimal('NILAI_BIAYA_ADM', 18, 2)->nullable();
            $table->decimal('AMORT_ADM_PER_PRD', 18, 2)->nullable();
            $table->decimal('SISA_AMORT_ADM', 18, 2)->nullable();
            $table->decimal('BYA_ASURANSI', 18, 2)->nullable();
            $table->decimal('BYA_NOTARIS', 18, 2)->nullable();
            $table->decimal('PKK_JATEM', 18, 2)->nullable();
            $table->decimal('BGA_JATEM', 18, 2)->nullable();
            $table->string('REK_BYR_PKK_BGA', 30)->nullable();
            $table->string('SLD_REK_DB', 30)->nullable();
            $table->string('KD_INSTANSI', 20)->nullable();
            $table->string('NM_INSTANSI', 100)->nullable();
            $table->string('REK_BENDAHARA', 30)->nullable();
            $table->string('SFT_KRD', 10)->nullable();
            $table->string('GOL_KRD', 10)->nullable();
            $table->string('JNS_KRD', 20)->nullable();
            $table->string('SKTR_EKNM', 10)->nullable();
            $table->string('ORNTS', 20)->nullable();
            $table->string('NO_HP', 20)->nullable();
            $table->decimal('POKOK_PINJAMAN', 18, 2)->nullable();
            $table->decimal('TITIPAN_EFEKTIF', 18, 2)->nullable();
            $table->integer('JANGKA_WAKTU')->nullable();
            $table->string('REK_PENCAIRAN', 30)->nullable();
            $table->string('NO_REKENING_LAMA', 30)->nullable();
            $table->string('CIF_LAMA', 20)->nullable();
            $table->string('KODE_GROUP', 20)->nullable();
            $table->string('KET_GROUP', 100)->nullable();
            $table->string('TGL_LAHIR', 8)->nullable(); // YYYYMMDD
            $table->string('NIK', 20)->nullable();
            $table->string('NIP', 20)->nullable();
            $table->decimal('NILAI_BYA_TRANS', 18, 2)->nullable();
            $table->decimal('AMORT_TRANS_PER_PRD', 18, 2)->nullable();
            $table->decimal('SISA_AMORT_TRANS', 18, 2)->nullable();
            $table->string('AO', 50)->nullable();
            $table->string('CAB_REK', 10)->nullable();
            $table->string('KELURAHAN', 50)->nullable();
            $table->string('KECAMATAN', 50)->nullable();
            $table->decimal('CADANGAN_PPAP', 18, 2)->nullable();
            $table->string('TEMPAT_BEKERJA', 100)->nullable();
            $table->string('TGL_AKHIR_BAYAR', 8)->nullable(); // YYYYMMDD
            $table->string('PIHAK_TERKAIT', 100)->nullable();
            $table->string('JENIS_JAMINAN', 100)->nullable();
            $table->decimal('NILAI_LEGALITAS', 18, 2)->nullable();
            $table->integer('RESTRUKTUR_KE')->nullable();
            $table->string('TGL_VALID_KOLEK', 8)->nullable(); // YYYYMMDD
            $table->string('TGL_MACET', 8)->nullable(); // YYYYMMDD

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nominatif_kredit');
    }
};