<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringBuktiTindakan extends Model
{
    use HasFactory;

    protected $table = 'monitoring_bukti_tindakan';

    protected $fillable = [
        'monitoring_id',
        'user_id',
        'photo'
    ];

    public function monitoring()
    {
        return $this->belongsTo(MonitoringKredit::class, 'monitoring_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}