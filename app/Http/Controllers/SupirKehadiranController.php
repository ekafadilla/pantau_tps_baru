<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupirKehadiranController extends Controller
{
    private function pastikanSupir(): void
    {
        abort_unless(auth()->check() && auth()->user()->role === 'supir', 403);
    }

    public function edit()
    {
        $this->pastikanSupir();

        $supir = auth()->user();

        $adaTugasAktif = $supir->tugasSupir()
            ->whereIn('status_laporan', [
                'diproses',
                'ditangani',
                'menunggu_pemeriksaan',
                'perlu_perbaikan',
            ])
            ->exists();

        return view('supir.kehadiran', compact(
            'supir',
            'adaTugasAktif'
        ));
    }

    public function update(Request $request)
    {
        $this->pastikanSupir();

        $data = $request->validate([
            'status_kehadiran' => [
                'required',
                'in:tersedia,izin,sakit,cuti,tidak_masuk',
            ],
            'keterangan_kehadiran' => [
                'nullable',
                'string',
                'max:500',
                'required_unless:status_kehadiran,tersedia',
            ],
        ], [
            'status_kehadiran.required' => 'Silakan pilih status kehadiran.',
            'status_kehadiran.in' => 'Pilihan status kehadiran tidak valid.',
            'keterangan_kehadiran.required_unless' => 'Keterangan wajib diisi jika tidak tersedia.',
            'keterangan_kehadiran.max' => 'Keterangan maksimal 500 karakter.',
        ]);

        $berhasil = DB::transaction(function () use ($data) {
            $supir = User::whereKey(auth()->id())
                ->lockForUpdate()
                ->firstOrFail();

            $adaTugasAktif = $supir->tugasSupir()
                ->whereIn('status_laporan', [
                    'diproses',
                    'ditangani',
                    'menunggu_pemeriksaan',
                    'perlu_perbaikan',
                ])
                ->exists();

            if ($data['status_kehadiran'] === 'tersedia' && $adaTugasAktif) {
                return false;
            }

            $supir->status_kehadiran = $data['status_kehadiran'];
            $supir->keterangan_kehadiran = $data['status_kehadiran'] === 'tersedia'
                ? null
                : trim($data['keterangan_kehadiran']);

            $supir->save();

            return true;
        });

        if (!$berhasil) {
            return back()
                ->withInput()
                ->withErrors([
                    'status_kehadiran' => 'Anda masih memiliki tugas aktif. Selesaikan tugas terlebih dahulu sebelum mengubah status menjadi tersedia.',
                ]);
        }

        return redirect()
            ->route('supir.kehadiran.edit')
            ->with('success', 'Status kehadiran berhasil diperbarui.');
    }
}