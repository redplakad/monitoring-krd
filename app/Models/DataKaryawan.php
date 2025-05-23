<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKaryawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nik',
        'branch_id',
        'position_id',
        'kode_ao',
        'no_telepon',
        'no_wa',
        'email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
