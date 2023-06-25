<?php

namespace App\Models;

use App\Models\RiwayatKerja;
use App\Models\RiwayatPendidikan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemerintah extends Model
{
    use HasFactory;
    protected $table = 'pemerintah';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $guarded = [
        'id'
    ];

    /**
     * Get all of the foto for the Daerah
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function riwayat_kerja(): HasMany
    {
        return $this->hasMany(RiwayatKerja::class, 'id_pemerintah', 'id');
    }

    /**
     * Get all of the foto for the Daerah
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function riwayat_pendidikan(): HasMany
    {
        return $this->hasMany(RiwayatPendidikan::class, 'id_pemerintah', 'id');
    }
}
