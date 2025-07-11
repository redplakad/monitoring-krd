<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KreditNotes extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kredit_notes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nomor_rekening',
        'user_id',
        'tag',
        'content',
    ];

    /**
     * Get the user that created the note.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the kredit record associated with the note.
     */
    public function nominatifKredit()
    {
        return $this->belongsTo(NominatifKredit::class, 'nomor_rekening', 'NOMOR_REKENING');
    }
    
    /**
     * Scope a query to only include notes of a specific tag.
     */
    public function scopeOfTag($query, $tag)
    {
        return $query->where('tag', $tag);
    }
    
    /**
     * Scope a query to only include notes for a specific nomor_rekening.
     */
    public function scopeForAccount($query, $nomorRekening)
    {
        return $query->where('nomor_rekening', $nomorRekening);
    }
}
