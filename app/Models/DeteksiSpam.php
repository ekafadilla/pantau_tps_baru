<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeteksiSpam extends Model
{
    protected $table = 'deteksi_spams';

    protected $fillable = [
        'id_laporan',
        'id_tps',
        'id_pengguna',
        'jenis_deteksi',
        'jumlah_laporan',
        'jumlah_pengguna',
        'periode_mulai',
        'periode_selesai',
        'status_peninjauan',
        'catatan_admin',
    ];

    protected function casts(): array
    {
        return [
            'jumlah_laporan' => 'integer',
            'jumlah_pengguna' => 'integer',
            'periode_mulai' => 'datetime',
            'periode_selesai' => 'datetime',
        ];
    }

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class, 'id_laporan');
    }

    public function tps(): BelongsTo
    {
        return $this->belongsTo(Tps::class, 'id_tps');
    }

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }
}