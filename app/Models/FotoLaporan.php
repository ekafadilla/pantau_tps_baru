<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FotoLaporan extends Model
{
    protected $table = 'foto_laporans';

    protected $fillable = [
        'id_laporan',
        'nama_file',
        'path_foto',
    ];

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class, 'id_laporan');
    }
}