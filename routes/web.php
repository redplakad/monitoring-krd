<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\MonitoringKredit;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/user-profile/{id?}', \App\Filament\Pages\UserProfile::class)
    ->name('filament.admin.pages.user-profile');

// API route to fetch monitoring kredit data
Route::get('/api/monitoring-kredit/{id}', function (Request $request, $id) {
    $monitoringKredit = \App\Models\MonitoringKredit::with('buktiTindakan')->findOrFail($id);

    return response()->json([
        'id' => $monitoringKredit->id,
        'created_at' => $monitoringKredit->created_at,
        'CIF' => $monitoringKredit->CIF,
        'NOMOR_REKENING' => $monitoringKredit->NOMOR_REKENING,
        'NAMA_NASABAH' => $monitoringKredit->NAMA_NASABAH,
        'TINDAKAN' => $monitoringKredit->TINDAKAN,
        'PEMBAYARAN' => $monitoringKredit->PEMBAYARAN,
        'HASIL_TINDAKAN' => $monitoringKredit->HASIL_TINDAKAN,
        'bukti_tindakan' => $monitoringKredit->buktiTindakan->map(function($bukti) {
            return [
                'id' => $bukti->id,
                'photo' => $bukti->photo,
            ];
        }),
    ]);
});