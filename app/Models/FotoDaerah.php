<?php

namespace App\Models;

use App\Models\Daerah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FotoDaerah extends Model
{
    use HasFactory;
    protected $table = 'foto_daerah';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $guarded = [
        'id'
    ];

    /**
     * Get the daerah that owns the FotoDaerah
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function daerah(): BelongsTo
    {
        return $this->belongsTo(Daerah::class, 'id_daerah', 'id');
    }
}
