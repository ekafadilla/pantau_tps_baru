<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DalamWilayahLayanan implements ValidationRule
{
    /**
     * @param string $sumbu 'lat' atau 'lng'
     */
    public function __construct(private string $sumbu)
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value === null || $value === '') {
            return;
        }

        $batas = config('layanan.wilayah');

        [$min, $max] = $this->sumbu === 'lat'
            ? [$batas['lat_min'], $batas['lat_max']]
            : [$batas['lng_min'], $batas['lng_max']];

        if ((float) $value < $min || (float) $value > $max) {
            $fail('Lokasi berada di luar wilayah layanan SI Pantau TPS ('
                . config('layanan.nama') . ').');
        }
    }
}