<?php

namespace App\Models;

use App\Models\Pemerintah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatKerja extends Model
{
    use HasFactory;
    protected $table = 'riwayat_kerja';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $guarded = [
        'id'
    ];

    public function pemerintah(): BelongsTo
    {
        return $this->belongsTo(Pemerintah::class, 'id_pemerintah', 'id');
    }
}
