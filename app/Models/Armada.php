<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Armada extends Model
{
    protected $table = 'armadas';

    protected $fillable = [
        'id_wilayah',
        'kode_armada',
        'jenis_armada',
        'nomor_polisi',
        'status_armada',
    ];

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class, 'id_wilayah');
    }

    public function laporans(): HasMany
    {
        return $this->hasMany(Laporan::class, 'id_armada');
    }
}