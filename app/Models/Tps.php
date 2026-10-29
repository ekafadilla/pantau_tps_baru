<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tps extends Model
{
    protected $table = 'tps';

    protected $fillable = [
        'id_wilayah',
        'nama_tps',
        'alamat',
        'latitude',
        'longitude',
        'keterangan',
    ];

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class, 'id_wilayah');
    }

    public function laporans(): HasMany
    {
        return $this->hasMany(Laporan::class, 'id_tps');
    }
}