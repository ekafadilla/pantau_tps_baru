<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

class AdminSpamController extends Controller
{
    /**
     * Menampilkan daftar pengguna beserta informasi spam.
     */
    public function index()
    {
        abort_unless(auth()->user()?->role === 'admin', 403);

        $users = User::select('id', 'name', 'email', 'is_spammer', 'spam_score')
            ->orderByDesc('is_spammer')
            ->orderByDesc('spam_score')
            ->paginate(20);

        return view('admin.spam.index', compact('users'));
    }

    /**
     * Mereset status spam pengguna.
     */
    public function reset(User $user)
    {
        abort_unless(auth()->user()?->role === 'admin', 403);

        $user->forceFill([
            'is_spammer' => false,
            'spam_score' => 0,
        ])->save();

        Cache::forget('spam_strikes_' . $user->id);

        return Redirect::back()->with(
            'status',
            'Status spam pengguna telah direset.'
        );
    }
}