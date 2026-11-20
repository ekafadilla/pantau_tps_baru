<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LokasiSupir extends Model
{
    protected $table = 'lokasi_supirs';

    protected $fillable = [
        'id_supir',
        'latitude',
        'longitude',
        'akurasi',
    ];

    public function supir(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_supir');
    }
}