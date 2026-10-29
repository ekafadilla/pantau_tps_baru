<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminPenggunaController extends Controller
{
    private function pastikanAdmin(): void
    {
        abort_unless(auth()->user()?->role === 'admin', 403);
    }

    public function index(Request $request)
    {
        $this->pastikanAdmin();

        $query = User::with('wilayah');

        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('name', 'like', "%{$cari}%")
                    ->orWhere('email', 'like', "%{$cari}%");
            });
        }

        if (in_array($request->query('role'), ['admin', 'masyarakat', 'uptd', 'supir'], true)) {
            $query->where('role', $request->query('role'));
        }

        $urutkan = $request->query('urutkan', 'terbaru');

        switch ($urutkan) {
            case 'nama_az':
                $query->orderBy('name', 'asc');
                break;

            case 'nama_za':
                $query->orderBy('name', 'desc');
                break;

            case 'terlama':
                $query->orderBy('created_at', 'asc');
                break;

            default:
                $urutkan = 'terbaru';
                $query->orderBy('created_at', 'desc');
                break;
        }

        $pengguna = $query->paginate(10)->withQueryString();

        return view('admin.pengguna.index', [
            'pengguna' => $pengguna,
            'wilayah' => Wilayah::orderBy('nama_wilayah')->get(),
            'urutkan' => $urutkan,
        ]);
    }
public function create()
    {
        $this->pastikanAdmin();

        return view('admin.pengguna.form', [
            'user' => new User(),
            'wilayah' => Wilayah::orderBy('nama_wilayah')->get(),
            'mode' => 'tambah',
        ]);
    }

    public function store(Request $request)
    {
        $this->pastikanAdmin();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['masyarakat', 'uptd', 'supir'])],
            'id_wilayah' => ['nullable', 'exists:wilayahs,id'],
        ]);

        if ($data['role'] === 'uptd' && empty($data['id_wilayah'])) {
            return back()->withErrors([
                'id_wilayah' => 'Akun UPTD wajib memiliki wilayah kerja.',
            ])->withInput();
        }

        if ($data['role'] !== 'uptd') {
            $data['id_wilayah'] = null;
        }

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $this->pastikanAdmin();

        return view('admin.pengguna.form', [
            'user' => $user,
            'wilayah' => Wilayah::orderBy('nama_wilayah')->get(),
            'mode' => 'edit',
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->pastikanAdmin();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'role' => ['required', Rule::in(['masyarakat', 'uptd', 'supir', 'admin'])],
            'id_wilayah' => ['nullable', 'exists:wilayahs,id'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if ($user->id === auth()->id() && $data['role'] !== 'admin') {
            return back()->withErrors([
                'role' => 'Role akun Admin yang sedang digunakan tidak boleh diubah.',
            ])->withInput();
        }

        if ($data['role'] === 'uptd' && empty($data['id_wilayah'])) {
            return back()->withErrors([
                'id_wilayah' => 'Akun UPTD wajib memiliki wilayah kerja.',
            ])->withInput();
        }

        if ($data['role'] !== 'uptd') {
            $data['id_wilayah'] = null;
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $this->pastikanAdmin();

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Akun yang sedang digunakan tidak dapat dihapus.');
        }

        if ($user->role === 'admin' &&
            User::where('role', 'admin')->count() <= 1) {
            return back()->with('error', 'Admin terakhir tidak dapat dihapus.');
        }

        if ($user->laporans()->exists() ||
            $user->riwayatStatuses()->exists()) {
            return back()->with('error', 'Pengguna memiliki riwayat data sehingga tidak dapat dihapus.');
        }

        $user->delete();

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}