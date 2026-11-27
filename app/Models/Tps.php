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

    protected function casts(): array
    {
        return [
            'last_reported_at' => 'datetime',
            'last_cleaned_at' => 'datetime',
        ];
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class, 'id_wilayah');
    }

    public function supirs(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'supir_tps',
            'id_tps',
            'id_supir'
        )->withPivot(['rute', 'status'])->withTimestamps();
    }
    public function laporans(): HasMany
    {
        return $this->hasMany(Laporan::class, 'id_tps');
    }
}
