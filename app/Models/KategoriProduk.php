<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriProduk extends Model
{
    use HasFactory;
    protected $table = 'kategori_produk';
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
    public function produk(): HasOne
    {
        return $this->hasOne(Produk::class);
    }
}
