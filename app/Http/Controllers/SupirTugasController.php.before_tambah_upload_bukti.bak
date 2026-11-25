<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class SupirTugasController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->role === 'supir', 403);

        $tugas = Laporan::with(['tps', 'armada', 'pengguna'])
            ->where('id_supir', auth()->id())
            ->whereNotIn('status_laporan', ['selesai', 'ditolak'])
            ->latest()
            ->get();

        return view('supir.tugas.index', compact('tugas'));
    }

    public function show($id)
    {
        abort_unless(auth()->user()->role === 'supir', 403);

        $tugas = Laporan::with([
            'tps',
            'armada',
            'pengguna',
            'buktiPenanganans',
        ])
            ->where('id_supir', auth()->id())
            ->findOrFail($id);

        return view('supir.tugas.show', compact('tugas'));
    }
}