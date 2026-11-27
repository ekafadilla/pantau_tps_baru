@props([
    'markers' => [],
    'mode' => 'view',        // view | picker | live
    'height' => 360,
    'tombolSaya' => false,   // mode view: tombol "Tunjukkan Lokasi Saya"
    'latInput' => 'latitude',
    'lngInput' => 'longitude',
    'pollUrl' => null,       // JSON posisi supir (admin / uptd)
    'shareUrl' => null,      // endpoint kirim posisi (supir)
    'tujuan' => null,        // ['lat' =>, 'lng' =>, 'label' =>]
])

@php
    $konfigPeta = [
        'mode' => $mode,
        'markers' => array_values((array) $markers),
        'height' => (int) $height,
        'tombolSaya' => (bool) $tombolSaya,
        'latInput' => $latInput,
        'lngInput' => $lngInput,
        'pollUrl' => $pollUrl,
        'shareUrl' => $shareUrl,
        'csrf' => csrf_token(),
        'tujuan' => $tujuan,
    ];
@endphp

@once
    @viteReactRefresh
    {{-- @vite(['resources/js/peta.jsx']) --}}
@endonce

{{-- {{ }} meng-escape tanda kutip, jadi isi database tidak bisa merusak atribut --}}
<div data-peta data-config="{{ json_encode($konfigPeta, JSON_UNESCAPED_UNICODE) }}" {{ $attributes }}></div>