<?php

namespace App\Http\Controllers;

use App\Models\DeteksiSpam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UptdSpamController extends Controller
{
    private function deteksiWilayah()
    {
        $user = Auth::user();

        abort_unless($user && $user->role === 'uptd', 403);
        abort_if(!$user->id_wilayah, 403, 'Akun UPTD belum memiliki wilayah.');

        return DeteksiSpam::whereHas('tps', function ($query) use ($user) {
            $query->where('id_wilayah', $user->id_wilayah);
        });
    }

    public function index()
    {
        $deteksi = $this->deteksiWilayah()
            ->with(['tps', 'pengguna', 'laporan'])
            ->orderByDesc('created_at')
            ->paginate(15);

        $totalDeteksi = $this->deteksiWilayah()->count();

        $totalPerluDitinjau = $this->deteksiWilayah()
            ->where('status_peninjauan', 'perlu_ditinjau')
            ->count();

        $totalTerkonfirmasi = $this->deteksiWilayah()
            ->where('status_peninjauan', 'terkonfirmasi')
            ->count();

        $totalBukanSpam = $this->deteksiWilayah()
            ->where('status_peninjauan', 'bukan_spam')
            ->count();

        return view('uptd.spam.index', compact(
            'deteksi',
            'totalDeteksi',
            'totalPerluDitinjau',
            'totalTerkonfirmasi',
            'totalBukanSpam'
        ));
    }

    public function review(Request $request, $id)
    {
        $deteksiSpam = $this->deteksiWilayah()->findOrFail($id);

        $validated = $request->validate([
            'status_peninjauan' => [
                'required',
                'in:perlu_ditinjau,terkonfirmasi,bukan_spam',
            ],
            'catatan_uptd' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);

        $deteksiSpam->update($validated);

        return Redirect::route('uptd.spam.index')->with(
            'success',
            'Hasil peninjauan deteksi spam berhasil disimpan.'
        );
    }
}
