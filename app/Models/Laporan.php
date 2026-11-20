<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laporan extends Model
{
    protected $table = 'laporans';

    protected $fillable = [
        'id_pengguna',
        'id_tps',
        'id_supir',
        'id_armada',
        'kategori_kondisi',
        'lokasi',
        'latitude',
        'longitude',
        'keterangan',
        'waktu_pelaporan',
        'status_laporan',
        'tingkat_urgensi',
        'target_waktu',
        'instruksi_penanganan',
        'waktu_mulai',
        'waktu_kirim_pemeriksaan',
    ];

    protected function casts(): array
    {
        return [
            'waktu_pelaporan' => 'datetime',
            'target_waktu' => 'datetime',
            'waktu_mulai' => 'datetime',
            'waktu_kirim_pemeriksaan' => 'datetime',
        ];
    }

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }

    public function tps(): BelongsTo
    {
        return $this->belongsTo(Tps::class, 'id_tps');
    }

    public function supir(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_supir');
    }

    public function armada(): BelongsTo
    {
        return $this->belongsTo(Armada::class, 'id_armada');
    }

    public function buktiPenanganans(): HasMany
    {
        return $this->hasMany(BuktiPenanganan::class, 'id_laporan');
    }
    public function fotoLaporans(): HasMany
    {
        return $this->hasMany(FotoLaporan::class, 'id_laporan');
    }

    public function riwayatStatuses(): HasMany
    {
        return $this->hasMany(RiwayatStatus::class, 'id_laporan');
    }
    public function penilaianUrgensis(): HasMany
    {
        return $this->hasMany(PenilaianUrgensi::class, 'id_laporan');
    }
}

