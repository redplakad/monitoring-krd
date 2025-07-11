<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\DataKaryawan;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'cover_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function dataKaryawan()
    {
        return $this->hasOne(DataKaryawan::class, 'user_id');
    }
    
    public function monitoringKredit()
    {
        return $this->hasMany(MonitoringKredit::class);
    }

    public function monitoringKredits()
    {
        return $this->hasMany(MonitoringKredit::class, 'user_id');
    }

    public function countDebitur()
    {
        // Get the latest DATADATE
        $latestDate = NominatifKredit::max('DATADATE');
        
        // Get kode_ao from DataKaryawan
        $karyawan = DataKaryawan::where('user_id', $this->id)->first();
        if (!$karyawan || !$karyawan->kode_ao) {
            return 0;
        }

        // Count debitur with conditions
        return NominatifKredit::where('DATADATE', $latestDate)
            ->where('AO', $karyawan->kode_ao)
            ->count();
    }

    public function countNPL()
    {
        // Get the latest DATADATE
        $latestDate = NominatifKredit::max('DATADATE');
        
        // Get kode_ao from DataKaryawan
        $karyawan = DataKaryawan::where('user_id', $this->id)->first();
        if (!$karyawan || !$karyawan->kode_ao) {
            return 0;
        }

        // Count NPL debitur with conditions
        return NominatifKredit::where('DATADATE', $latestDate)
            ->where('AO', $karyawan->kode_ao)
            ->where('KODE_KOLEK', '>=', 3)
            ->count();
    }

    public function SumNPL()
    {
        // Get the latest DATADATE
        $latestDate = NominatifKredit::max('DATADATE');
        
        // Get kode_ao from DataKaryawan
        $karyawan = DataKaryawan::where('user_id', $this->id)->first();
        if (!$karyawan || !$karyawan->kode_ao) {
            return 0;
        }

        // Count NPL debitur with conditions
        return NominatifKredit::where('DATADATE', $latestDate)
            ->where('AO', $karyawan->kode_ao)
            ->where('KODE_KOLEK', '>=', 3)
            ->SUM('POKOK_PINJAMAN');
    }
    public function nplPercentage()
    {
        $totalDebitur = $this->countDebitur();
        if ($totalDebitur === 0) {
            return 0;
        }
        return round(($this->countNPL() / $totalDebitur) * 100, 2);
    }

}
