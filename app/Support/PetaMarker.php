<?php

namespace App\Support;

use App\Models\Laporan;
use App\Models\LokasiSupir;
use App\Models\Tps;

/**
 * Mengubah model menjadi array marker yang dibaca komponen React peta.
 * Format: id, type (tps|laporan|supir), lat, lng, title, subtitle, url.
 */
class PetaMarker
{
    public static function valid($lat, $lng): bool
    {
        return is_numeric($lat) && is_numeric($lng)
            && abs((float) $lat) <= 90 && abs((float) $lng) <= 180
            && !((float) $lat === 0.0 && (float) $lng === 0.0);
    }

    public static function tps(Tps $tps, ?string $url = null): ?array
    {
        if (!self::valid($tps->latitude, $tps->longitude)) {
            return null;
        }

        return [
            'id' => 'tps-' . $tps->id,
            'type' => 'tps',
            'lat' => (float) $tps->latitude,
            'lng' => (float) $tps->longitude,
            'title' => $tps->nama_tps,
            'subtitle' => $tps->alamat,
            'url' => $url,
        ];
    }

    /**
     * Titik laporan memakai koordinat yang dikirim pelapor.
     * Jika kosong dan $fallbackTps true, jatuh ke koordinat TPS-nya.
     */
    public static function laporan(Laporan $laporan, ?string $url = null, bool $fallbackTps = true): ?array
    {
        $lat = $laporan->latitude;
        $lng = $laporan->longitude;
        $dariTps = false;

        if (!self::valid($lat, $lng) && $fallbackTps) {
            $lat = $laporan->tps->latitude ?? null;
            $lng = $laporan->tps->longitude ?? null;
            $dariTps = true;
        }

        if (!self::valid($lat, $lng)) {
            return null;
        }

        $status = ucfirst(str_replace('_', ' ', (string) $laporan->status_laporan));

        return [
            'id' => 'laporan-' . $laporan->id,
            'type' => 'laporan',
            'lat' => (float) $lat,
            'lng' => (float) $lng,
            'title' => 'Laporan #' . $laporan->id . ' - ' . ($laporan->tps->nama_tps ?? 'TPS'),
            'subtitle' => trim($laporan->kategori_kondisi . ' | ' . $status
                . ($dariTps ? ' | titik TPS' : '')),
            'url' => $url,
        ];
    }

    public static function supir(LokasiSupir $lokasi): ?array
    {
        if (!self::valid($lokasi->latitude, $lokasi->longitude)) {
            return null;
        }

        $menit = (int) $lokasi->updated_at->diffInMinutes(now(), true);

        return [
            'id' => 'supir-' . $lokasi->id_supir,
            'type' => 'supir',
            'lat' => (float) $lokasi->latitude,
            'lng' => (float) $lokasi->longitude,
            'title' => $lokasi->supir->name ?? 'Supir',
            'subtitle' => $menit < 1 ? 'Baru saja diperbarui' : "Terakhir terlihat {$menit} menit lalu",
            'menit' => $menit,
        ];
    }

    /** Buang elemen null dan reset indeks agar menjadi JSON array. */
    public static function bersih(iterable $items): array
    {
        return collect($items)->filter()->values()->all();
    }
}