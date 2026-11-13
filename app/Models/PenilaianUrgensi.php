<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenilaianUrgensi extends Model
{
    protected $table = 'penilaian_urgensi';

    protected $fillable = [
        'id_laporan',
        'jenis_penilaian',
        'id_penilai',
        'kepenuhan_tps',
        'sampah_meluber',
        'dampak_lingkungan',
        'bau_hama',
        'gangguan_masyarakat',
        'skor_urgensi',
        'rekomendasi_urgensi',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'kepenuhan_tps' => 'integer',
            'sampah_meluber' => 'integer',
            'dampak_lingkungan' => 'integer',
            'bau_hama' => 'integer',
            'gangguan_masyarakat' => 'integer',
            'skor_urgensi' => 'decimal:2',
        ];
    }

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class, 'id_laporan');
    }

    public function penilai(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_penilai');
    }
}