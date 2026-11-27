<?php

namespace App\Http\Controllers;

use App\Models\DeteksiSpam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class AdminSpamController extends Controller
{
    private function pastikanAdmin(): void
    {
        abort_unless(
            Auth::check() && Auth::user()->role === 'admin',
            403
        );
    }

    public function index()
    {
        $this->pastikanAdmin();

        $deteksi = DeteksiSpam::with([
            'tps',
            'pengguna',
            'laporan',
        ])
            ->orderByDesc('created_at')
            ->paginate(15);

        $totalDeteksi = DeteksiSpam::count();

        $totalPerluDitinjau = DeteksiSpam::where(
            'status_peninjauan',
            'perlu_ditinjau'
        )->count();

        $totalTerkonfirmasi = DeteksiSpam::where(
            'status_peninjauan',
            'terkonfirmasi'
        )->count();

        $totalBukanSpam = DeteksiSpam::where(
            'status_peninjauan',
            'bukan_spam'
        )->count();

        return view('admin.spam.index', compact(
            'deteksi',
            'totalDeteksi',
            'totalPerluDitinjau',
            'totalTerkonfirmasi',
            'totalBukanSpam'
        ));
    }

    public function review(Request $request, DeteksiSpam $deteksiSpam)
    {
        $this->pastikanAdmin();

        $validated = $request->validate([
            'status_peninjauan' => [
                'required',
                'in:perlu_ditinjau,terkonfirmasi,bukan_spam',
            ],
            'catatan_admin' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);

        $deteksiSpam->update($validated);

        return Redirect::route('admin.spam.index')->with(
            'success',
            'Hasil peninjauan deteksi berhasil disimpan.'
        );
    }

    public function reset(User $user)
    {
        $this->pastikanAdmin();

        $user->forceFill([
            'is_spammer' => false,
            'spam_score' => 0,
        ])->save();

        Cache::forget('spam_strikes_' . $user->id);

        return Redirect::back()->with(
            'success',
            'Status spam pengguna telah direset.'
        );
    }
}