<?php

return [
    // Wilayah layanan SI Pantau TPS. Lapor hanya diterima jika titik berada di dalam kotak ini.
    // Ini batas kasar. Ganti dengan batas resmi (polygon) jika DLH sudah punya datanya.
    'nama' => 'Kabupaten Indramayu',
    'wilayah' => [
        'lat_min' => -6.90,
        'lat_max' => -5.90,
        'lng_min' => 107.80,
        'lng_max' => 108.70,
    ],
];