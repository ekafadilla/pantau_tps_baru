<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

class AdminSpamController extends Controller
{
    /**
     * Show list of users flagged as spammer (or all users with spam info).
     */
    public function index()
    {
        // Fetch users with spam information; you can filter to only spammers or show all.
        $users = User::select('id', 'name', 'email', 'is_spammer', 'spam_score')
            ->orderBy('is_spammer', 'desc')
            ->orderBy('spam_score', 'desc')
            ->paginate(20);

        return view('admin.spam.index', compact('users'));
    }

    /**
     * Reset spam status for a given user.
     */
    public function reset(User $user)
    {
        $user->update([
            'is_spammer' => false,
            'spam_score' => 0,
        ]);

        // Also clear any cached strike counter if you used one.
        Cache::forget('spam_strikes_' . $user->id);

        return Redirect::back()->with('status', 'Status spam pengguna telah direset.');
    }
}
?>