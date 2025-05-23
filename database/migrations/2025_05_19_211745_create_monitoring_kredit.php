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
        Schema::create('monitoring_kredits', function (Blueprint $table) {
            $table->id();
            $table->string('CIF')->nullable();
            $table->string('NOMOR_REKENING')->nullable();
            $table->string('NAMA_NASABAH', 100)->nullable();
            $table->string('TINDAKAN')->nullable();
            $table->decimal('PEMBAYARAN', 18, 2)->default(0);
            $table->text('HASIL_TINDAKAN')->nullable();
            $table->string('TAG')->nullable();

            // Kolom user_id
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_kredits');
    }
};