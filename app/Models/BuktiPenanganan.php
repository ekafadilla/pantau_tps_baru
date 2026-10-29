<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BuktiPenanganan extends Model
{
    protected $table = 'bukti_penanganans';

    protected $fillable = [
        'id_laporan',
        'id_supir',
        'foto_path',
        'keterangan',
        'waktu_pengiriman',
    ];

    protected function casts(): array
    {
        return [
            'waktu_pengiriman' => 'datetime',
        ];
    }

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class, 'id_laporan');
    }

    public function supir(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_supir');
    }
}