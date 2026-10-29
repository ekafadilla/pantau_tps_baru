<?php

namespace App\Http\Controllers;

use App\Models\Tps;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminTpsController extends Controller
{
    private function pastikanAdmin()
    {
        abort_unless(Auth::check() && Auth::user()->role === 'admin', 403);
    }

    public function index(Request $request)
    {
        $this->pastikanAdmin();

        $cari = $request->query('cari');
        $idWilayah = $request->query('id_wilayah');
        $urutkan = $request->query('urutkan', 'nama_az');

        $query = Tps::with('wilayah');

        if ($cari) {
            $query->where(function ($q) use ($cari) {
                $q->where('nama_tps', 'like', "%{$cari}%")
                    ->orWhere('alamat', 'like', "%{$cari}%")
                    ->orWhere('keterangan', 'like', "%{$cari}%");
            });
        }

        if ($idWilayah) {
            $query->where('id_wilayah', $idWilayah);
        }

        if ($urutkan === 'nama_za') {
            $query->orderBy('nama_tps', 'desc');
        } else {
            $query->orderBy('nama_tps', 'asc');
        }

        $tps = $query->paginate(10)->withQueryString();
        $wilayah = Wilayah::orderBy('nama_wilayah')->get();

        return view('admin.tps.index', compact(
            'tps',
            'wilayah',
            'cari',
            'idWilayah',
            'urutkan'
        ));
    }

    public function create()
    {
        $this->pastikanAdmin();

        $wilayah = Wilayah::orderBy('nama_wilayah')->get();

        return view('admin.tps.form', compact('wilayah'));
    }

    public function store(Request $request)
    {
        $this->pastikanAdmin();

        $data = $request->validate([
            'id_wilayah' => ['required', 'integer', 'exists:wilayahs,id'],
            'nama_tps' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:1000'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'keterangan' => ['nullable', 'string', 'max:2000'],
        ]);

        Tps::create($data);

        return redirect()
            ->route('admin.tps.index')
            ->with('success', 'Data TPS berhasil ditambahkan.');
    }

    public function edit(Tps $tps)
    {
        $this->pastikanAdmin();

        $wilayah = Wilayah::orderBy('nama_wilayah')->get();

        return view('admin.tps.form', compact('tps', 'wilayah'));
    }

    public function update(Request $request, Tps $tps)
    {
        $this->pastikanAdmin();

        $data = $request->validate([
            'id_wilayah' => ['required', 'integer', 'exists:wilayahs,id'],
            'nama_tps' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:1000'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'keterangan' => ['nullable', 'string', 'max:2000'],
        ]);

        $tps->update($data);

        return redirect()
            ->route('admin.tps.index')
            ->with('success', 'Data TPS berhasil diperbarui.');
    }

    public function destroy(Tps $tps)
    {
        $this->pastikanAdmin();

        if ($tps->laporans()->exists()) {
            return redirect()
                ->route('admin.tps.index')
                ->with('error', 'TPS tidak dapat dihapus karena masih digunakan dalam laporan.');
        }

        $tps->delete();

        return redirect()
            ->route('admin.tps.index')
            ->with('success', 'Data TPS berhasil dihapus.');
    }

    public function show(\App\Models\Tps $tps)
    {
        abort_unless(
            \Illuminate\Support\Facades\Auth::check()
                && \Illuminate\Support\Facades\Auth::user()->role === 'admin',
            403
        );

        $tps->load('wilayah');

        return view('admin.tps.show', compact('tps'));
    }}