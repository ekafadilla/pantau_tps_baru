<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatStatus extends Model
{
    protected $table = 'riwayat_statuses';

    protected $fillable = [
        'id_laporan',
        'id_pengguna',
        'status_sebelumnya',
        'status_baru',
        'catatan',
        'waktu_perubahan',
    ];

    protected function casts(): array
    {
        return ['waktu_perubahan' => 'datetime'];
    }

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class, 'id_laporan');
    }

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }
}