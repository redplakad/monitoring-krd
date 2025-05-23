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
        Schema::create('monitoring_bukti_tindakan', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key ke monitoring_kredits
            $table->unsignedBigInteger('monitoring_id');
            $table->foreign('monitoring_id')
                  ->references('id')
                  ->on('monitoring_kredits')
                  ->onDelete('cascade');

            // Foreign Key ke users
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            // Kolom photo (bisa simpan path atau nama file)
            $table->mediumText('photo'); // bisa gunakan path, url, atau nama file

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_bukti_tindakan');
    }
};