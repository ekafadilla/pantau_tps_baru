<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\Request;

class AdminWilayahController extends Controller
{
    private function pastikanAdmin(): void
    {
        abort_unless(auth()->user()?->role === 'admin', 403);
    }

    public function index(Request $request)
    {
        $this->pastikanAdmin();

        $query = Wilayah::query();

        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('nama_wilayah', 'like', "%{$cari}%")
                    ->orWhere('keterangan', 'like', "%{$cari}%");
            });
        }

        $urutkan = $request->query('urutkan', 'nama_az');

        if ($urutkan === 'nama_za') {
            $query->orderBy('nama_wilayah', 'desc');
        } else {
            $urutkan = 'nama_az';
            $query->orderBy('nama_wilayah', 'asc');
        }

        $wilayah = $query->paginate(10)->withQueryString();

        return view('admin.wilayah.index', compact('wilayah', 'urutkan'));
    }

    public function create()
    {
        $this->pastikanAdmin();

        return view('admin.wilayah.form', [
            'wilayah' => new Wilayah(),
            'mode' => 'tambah',
        ]);
    }

    public function store(Request $request)
    {
        $this->pastikanAdmin();

        $data = $request->validate([
            'nama_wilayah' => ['required', 'string', 'max:255', 'unique:wilayahs,nama_wilayah'],
            'keterangan' => ['nullable', 'string', 'max:1000'],
        ]);

        Wilayah::create($data);

        return redirect()
            ->route('admin.wilayah.index')
            ->with('success', 'Wilayah berhasil ditambahkan.');
    }

    public function edit(Wilayah $wilayah)
    {
        $this->pastikanAdmin();

        return view('admin.wilayah.form', [
            'wilayah' => $wilayah,
            'mode' => 'edit',
        ]);
    }

    public function update(Request $request, Wilayah $wilayah)
    {
        $this->pastikanAdmin();

        $data = $request->validate([
            'nama_wilayah' => [
                'required',
                'string',
                'max:255',
                'unique:wilayahs,nama_wilayah,' . $wilayah->id,
            ],
            'keterangan' => ['nullable', 'string', 'max:1000'],
        ]);

        $wilayah->update($data);

        return redirect()
            ->route('admin.wilayah.index')
            ->with('success', 'Data wilayah berhasil diperbarui.');
    }

    public function destroy(Wilayah $wilayah)
    {
        $this->pastikanAdmin();

        if ($wilayah->users()->exists() || $wilayah->tps()->exists()) {
            return back()->with(
                'error',
                'Wilayah tidak dapat dihapus karena masih digunakan oleh pengguna UPTD atau data TPS.'
            );
        }

        $wilayah->delete();

        return redirect()
            ->route('admin.wilayah.index')
            ->with('success', 'Wilayah berhasil dihapus.');
    }
}