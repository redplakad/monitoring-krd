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
        Schema::create('kredit_notes', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_rekening');         // identifikasi berdasarkan nomor rekening
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // user yang menambahkan
            $table->string('tag')->default('note');  // tipe: 'note', 'tag', dll
            $table->text('content');                  // isi catatan atau tag
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kredit_notes');
    }
};