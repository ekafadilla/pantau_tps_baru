<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wilayah extends Model
{
    protected $table = 'wilayahs';

    protected $fillable = [
        'nama_wilayah',
        'keterangan',
    ];

    public function tps(): HasMany
    {
        return $this->hasMany(Tps::class, 'id_wilayah');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'id_wilayah');
    }
}