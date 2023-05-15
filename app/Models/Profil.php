<?php

namespace App\Models;

use App\Models\Berita;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profil extends Model
{
    use HasFactory;

    protected $table = 'profil_desa';
    protected $primaryKey = 'id_profil_desa';
    public $incrementing = true;
    public $timestamps = true;
    protected $guarded = [
        'id_profil_desa'
    ];

    /**
     * Get all of the comments for the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Berita(): HasMany
    {
        return $this->hasMany(Berita::class, 'id_profil_desa', 'id_profil_desa');
    }

}
