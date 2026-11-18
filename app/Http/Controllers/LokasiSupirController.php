<?php

namespace App\Http\Controllers;

use App\Models\LokasiSupir;
use App\Support\PetaMarker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LokasiSupirController extends Controller
{
    /** Posisi lebih lama dari ini dianggap tidak relevan (jam). */
    private const BATAS_JAM = 12;

    /** Supir mengirim posisinya (hanya saat ia menyalakan "Bagikan Lokasi"). */
    public function simpan(Request $request): JsonResponse
    {
        abort_unless($request->user()->role === 'supir', 403);

        $data = $request->validate([
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'akurasi' => ['nullable', 'numeric', 'min:0', 'max:100000'],
        ]);

        $lokasi = LokasiSupir::updateOrCreate(
            ['id_supir' => $request->user()->id],
            [
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'akurasi' => isset($data['akurasi']) ? (int) round($data['akurasi']) : null,
            ]
        );

        // Pastikan "terakhir terlihat" selalu maju walau posisi sama.
        $lokasi->touch();

        return response()->json(['ok' => true]);
    }

    /** Supir berhenti berbagi: posisi dihapus dari server. */
    public function hapus(Request $request): JsonResponse
    {
        abort_unless($request->user()->role === 'supir', 403);

        LokasiSupir::where('id_supir', $request->user()->id)->delete();

        return response()->json(['ok' => true]);
    }

    /**
     * Daftar posisi supir (JSON) untuk peta Admin / UPTD.
     * Admin: semua supir. UPTD: hanya supir di wilayahnya.
     * Opsional ?supir=ID untuk satu supir saja.
     */
    public function daftar(Request $request): JsonResponse
    {
        $user = $request->user();

        abort_unless(in_array($user->role, ['admin', 'uptd'], true), 403);

        $query = LokasiSupir::with('supir:id,name,id_wilayah')
            ->where('updated_at', '>=', now()->subHours(self::BATAS_JAM));

        if ($user->role === 'uptd') {
            abort_if(empty($user->id_wilayah), 403);

            $query->whereHas('supir', function ($q) use ($user) {
                $q->where('id_wilayah', $user->id_wilayah);
            });
        }

        if ($request->filled('supir')) {
            $query->where('id_supir', (int) $request->query('supir'));
        }

        return response()->json([
            'markers' => PetaMarker::bersih(
                $query->get()->map(fn ($l) => PetaMarker::supir($l))
            ),
        ]);
    }
}