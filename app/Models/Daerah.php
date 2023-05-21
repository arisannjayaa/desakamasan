<?php

namespace App\Models;

use App\Models\Profil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Daerah extends Model
{
    use HasFactory;
    protected $table = 'daerah_wisata';
    protected $primaryKey = 'id_daerah_wisata';
    public $incrementing = true;
    public $timestamps = true;
    protected $guarded = [
        'id_daerah_wisata'
    ];

    /**
     * Get the user that owns the Berita
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profil(): BelongsTo
    {
        return $this->belongsTo(Profil::class, 'id_profil_desa', 'id_daerah_wisata');
    }
}