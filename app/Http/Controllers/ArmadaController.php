<?php

namespace App\Http\Controllers;

use App\Models\Armada;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ArmadaController extends Controller
{
    private function penggunaBerwenang(): void
    {
        abort_unless(
            auth()->check()
            && in_array(auth()->user()->role, ['admin', 'uptd'], true),
            403
        );
    }

    private function queryArmada()
    {
        $user = auth()->user();

        $query = Armada::with('wilayah');

        if ($user->role === 'uptd') {
            abort_unless($user->id_wilayah, 403);
            $query->where('id_wilayah', $user->id_wilayah);
        }

        return $query;
    }

    private function cariArmada(int $id): Armada
    {
        return $this->queryArmada()->whereKey($id)->firstOrFail();
    }

    private function daftarWilayah()
    {
        $user = auth()->user();

        $query = Wilayah::orderBy('nama_wilayah');

        if ($user->role === 'uptd') {
            $query->whereKey($user->id_wilayah);
        }

        return $query->get();
    }

    public function index(Request $request)
    {
        $this->penggunaBerwenang();

        $query = $this->queryArmada();

        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('kode_armada', 'like', "%{$cari}%")
                    ->orWhere('jenis_armada', 'like', "%{$cari}%")
                    ->orWhere('nomor_polisi', 'like', "%{$cari}%");
            });
        }

        if (auth()->user()->role === 'admin' && $request->filled('id_wilayah')) {
            $query->where('id_wilayah', $request->id_wilayah);
        }

        if ($request->filled('status_armada')) {
            $query->where('status_armada', $request->status_armada);
        }

        $armadas = $query->orderBy('kode_armada')
            ->paginate(10)
            ->withQueryString();

        $wilayah = $this->daftarWilayah();

        return view('armada.index', compact('armadas', 'wilayah'));
    }

    public function create()
    {
        $this->penggunaBerwenang();

        $armada = new Armada();
        $wilayah = $this->daftarWilayah();

        return view('armada.form', compact('armada', 'wilayah'));
    }

    public function store(Request $request)
    {
        $this->penggunaBerwenang();

        $user = auth()->user();

        $data = $request->validate([
            'id_wilayah' => [
                'required',
                'integer',
                Rule::exists('wilayahs', 'id'),
            ],
            'kode_armada' => ['required', 'string', 'max:255', 'unique:armadas,kode_armada'],
            'jenis_armada' => ['nullable', 'string', 'max:255'],
            'nomor_polisi' => ['nullable', 'string', 'max:255'],
            'status_armada' => [
                'required',
                Rule::in(['tersedia', 'rusak', 'perbaikan', 'nonaktif']),
            ],
            'keterangan' => ['nullable', 'string', 'max:2000'],
        ]);

        if ($user->role === 'uptd') {
            abort_unless(
                (int) $data['id_wilayah'] === (int) $user->id_wilayah,
                403
            );
        }

        Armada::create($data);

        return redirect()
            ->route($user->role . '.armada.index')
            ->with('success', 'Data armada berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $this->penggunaBerwenang();

        $armada = $this->cariArmada($id);
        $wilayah = $this->daftarWilayah();

        return view('armada.form', compact('armada', 'wilayah'));
    }

    public function update(Request $request, int $id)
    {
        $this->penggunaBerwenang();

        $armada = $this->cariArmada($id);
        $user = auth()->user();

        $data = $request->validate([
            'id_wilayah' => ['required', 'integer', Rule::exists('wilayahs', 'id')],
            'kode_armada' => [
                'required',
                'string',
                'max:255',
                Rule::unique('armadas', 'kode_armada')->ignore($armada->id),
            ],
            'jenis_armada' => ['nullable', 'string', 'max:255'],
            'nomor_polisi' => ['nullable', 'string', 'max:255'],
            'status_armada' => [
                'required',
                Rule::in(['tersedia', 'rusak', 'perbaikan', 'nonaktif']),
            ],
            'keterangan' => ['nullable', 'string', 'max:2000'],
        ]);

        if ($user->role === 'uptd') {
            abort_unless(
                (int) $data['id_wilayah'] === (int) $user->id_wilayah,
                403
            );
        }

        if ($armada->laporans()->whereIn('status_laporan', [
            'diproses',
            'ditangani',
            'menunggu_pemeriksaan',
            'perlu_perbaikan',
        ])->exists()) {
            $data['status_armada'] = 'digunakan';
        }

        $armada->update($data);

        return redirect()
            ->route($user->role . '.armada.index')
            ->with('success', 'Data armada berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $this->penggunaBerwenang();

        $armada = $this->cariArmada($id);

        if ($armada->laporans()->exists()) {
            return back()->with(
                'error',
                'Armada tidak dapat dihapus karena sudah memiliki riwayat laporan.'
            );
        }

        $armada->delete();

        return redirect()
            ->route(auth()->user()->role . '.armada.index')
            ->with('success', 'Data armada berhasil dihapus.');
    }
}