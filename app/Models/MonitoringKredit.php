<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringKredit extends Model
{
    use HasFactory;

    protected $table = 'monitoring_kredits';

    protected $fillable = [
        'CIF',
        'NOMOR_REKENING',
        'NAMA_NASABAH',
        'TINDAKAN',
        'PEMBAYARAN',
        'HASIL_TINDAKAN',
        'TAG',
        'user_id',
    ];

    protected $casts = [
        'PEMBAYARAN' => 'decimal:2',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function buktiTindakan()
    {
        return $this->hasMany(MonitoringBuktiTindakan::class, 'monitoring_id');
    }
}