<?php

namespace App\Models;

use App\Models\Daerah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriDaerah extends Model
{
    use HasFactory;
    protected $table = 'kategori_daerah';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $guarded = [
        'id'
    ];


    /**
     * Get the user associated with the KategoriBerita
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(Daerah::class);
    }
}
