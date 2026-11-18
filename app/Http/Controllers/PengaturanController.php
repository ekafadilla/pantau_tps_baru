<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class PengaturanController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();

        return view('pengaturan.index', [
            'user' => $user,
            'layout' => $this->layoutUntuk($user->role),
        ]);
    }

    public function updateProfil(Request $request)
    {
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

        // Ganti email wajib verifikasi ulang sebelum dianggap sah.
        $emailBerubah = $data['email'] !== $user->email;

        if ($emailBerubah) {
            $user->email = $data['email'];
            $user->email_verified_at = null;
        }

        $user->save();

        if ($emailBerubah) {
            $user->sendEmailVerificationNotification();

            return redirect()->route('verification.notice')
                ->with('status', 'Email diperbarui. Kami mengirim tautan verifikasi ke alamat baru.');
        }

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'password_lama' => ['required', 'current_password'],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ], [
            'password_lama.current_password' => 'Kata sandi lama tidak sesuai.',
        ]);

        $request->user()->forceFill([
            'password' => Hash::make($data['password']),
        ])->save();

        return back()->with('success_password', 'Kata sandi berhasil diubah.');
    }

    private function layoutUntuk(string $role): string
    {
        return match ($role) {
            'admin' => 'layouts.admin',
            'uptd' => 'layouts.uptd',
            'supir' => 'layouts.supir',
            default => 'layouts.masyarakat',
        };
    }
}