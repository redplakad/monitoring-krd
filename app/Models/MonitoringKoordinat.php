<?php
// app/Models/MonitoringKoordinat.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringKoordinat extends Model
{
    use HasFactory;
    protected $table = 'monitoring_koordinat';
    protected $fillable = [
        'user_id',
        'nomor_rekening',
        'latitude',
        'longitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nominatifKredit()
    {
        return $this->belongsTo(NominatifKredit::class, 'nomor_rekening', 'NOMOR_REKENING');
    }
}
