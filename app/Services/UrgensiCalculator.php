<?php

namespace App\Services;

use InvalidArgumentException;

class UrgensiCalculator
{
    private const BOBOT = [
        'kepenuhan_tps' => 25,
        'sampah_meluber' => 25,
        'dampak_lingkungan' => 20,
        'bau_hama' => 15,
        'gangguan_masyarakat' => 15,
    ];

    public function hitung(array $nilai): array
    {
        $total = 0;

        foreach (self::BOBOT as $indikator => $bobot) {
            if (!isset($nilai[$indikator])) {
                throw new InvalidArgumentException(
                    "Nilai indikator {$indikator} belum diisi."
                );
            }

            $skor = (int) $nilai[$indikator];

            if ($skor < 1 || $skor > 4) {
                throw new InvalidArgumentException(
                    "Nilai {$indikator} harus antara 1 sampai 4."
                );
            }

            $total += $bobot * (($skor - 1) / 3);
        }

        $total = round($total, 2);

        if ($total < 25) {
            $kategori = 'rendah';
        } elseif ($total < 50) {
            $kategori = 'sedang';
        } elseif ($total < 75) {
            $kategori = 'tinggi';
        } else {
            $kategori = 'sangat_tinggi';
        }

        return [
            'skor_urgensi' => $total,
            'rekomendasi_urgensi' => $kategori,
        ];
    }
}