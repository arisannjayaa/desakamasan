<?php

namespace App\Models;

use App\Models\FotoDaerah;
use App\Models\KategoriDaerah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Daerah extends Model
{
    use HasFactory;
    protected $table = 'daerah';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $guarded = [
        'id'
    ];

    /**
     * Get the user that owns the Berita
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriDaerah::class, 'id_kategori_daerah', 'id');
    }

    /**
     * Get all of the foto for the Daerah
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function foto(): HasMany
    {
        return $this->hasMany(FotoDaerah::class, 'id_daerah', 'id');
    }
}
