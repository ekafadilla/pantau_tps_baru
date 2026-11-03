<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UptdPengaturanController extends Controller
{
    private function pastikanUptd(): void
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'uptd',
            403,
            'Halaman ini khusus UPTD.'
        );
    }

    public function edit()
    {
        $this->pastikanUptd();

        return view('uptd.pengaturan.index', [
            'user' => auth()->user(),
        ]);
    }

    public function update(Request $request)
    {
        $this->pastikanUptd();

        $user = $request->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $this->pastikanUptd();

        $data = $request->validate([
            'password_lama' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'password_lama.current_password' => 'Kata sandi lama tidak sesuai.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
            'password.min' => 'Kata sandi baru minimal 8 karakter.',
        ]);

        $request->user()->update([
            'password' => Hash::make($data['password']),
        ]);

        return back()->with('success_password', 'Kata sandi berhasil diubah.');
    }
}