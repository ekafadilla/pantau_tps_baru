@extends('layouts.admin')

@section('title', 'Data Pengguna')
@section('page-title', 'Data Pengguna')

@section('content')
    @php
        $roleAktif = request('role', '');
        $urutkanAktif = request('urutkan', 'terbaru');

        $daftarRole = [
            '' => 'Semua',
            'admin' => 'Admin',
            'masyarakat' => 'Masyarakat',
            'uptd' => 'UPTD',
            'supir' => 'Supir',
        ];
    @endphp

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="font-size:23px">Data Pengguna</h2>
            <p class="text-secondary mb-0">Kelola akun pengguna SI PANTAU TPS.</p>
        </div>

        <a href="{{ route('admin.pengguna.create') }}" class="btn btn-success">
            <i class="bi bi-person-plus me-1"></i> Tambah Pengguna
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data yang dimasukkan.</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="panel mb-4">
        <div class="p-3">
            <div class="mb-3">
                <label class="form-label fw-semibold">Filter Role</label>

                <div class="d-flex flex-wrap gap-2">
                    @foreach ($daftarRole as $nilai => $label)
                        <a
                            href="{{ route('admin.pengguna.index', array_filter([
                                'cari' => request('cari'),
                                'urutkan' => $urutkanAktif,
                                'role' => $nilai !== '' ? $nilai : null,
                            ], fn ($v) => $v !== null && $v !== '')) }}"
                            class="btn btn-sm {{ $roleAktif === $nilai ? 'btn-success' : 'btn-outline-success' }}"
                        >
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>

            <form action="{{ route('admin.pengguna.index') }}" method="GET">
                <input type="hidden" name="role" value="{{ $roleAktif }}">

                <div class="row g-3 align-items-end">
                    <div class="col-12 col-md-6">
                        <label for="cari" class="form-label">Cari pengguna</label>
                        <input
                            type="text"
                            id="cari"
                            name="cari"
                            class="form-control"
                            value="{{ request('cari') }}"
                            placeholder="Nama atau email pengguna"
                        >
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="urutkan" class="form-label">Urutkan berdasarkan</label>
                        <select id="urutkan" name="urutkan" class="form-select">
                            <option value="nama_az" @selected($urutkanAktif === 'nama_az')>
                                Nama A–Z
                            </option>
                            <option value="nama_za" @selected($urutkanAktif === 'nama_za')>
                                Nama Z–A
                            </option>
                            <option value="terbaru" @selected($urutkanAktif === 'terbaru')>
                                Terbaru ke terlama
                            </option>
                            <option value="terlama" @selected($urutkanAktif === 'terlama')>
                                Terlama ke terbaru
                            </option>
                        </select>
                    </div>

                    <div class="col-12 col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            Terapkan
                        </button>
                        <a href="{{ route('admin.pengguna.index') }}"
                           class="btn btn-outline-secondary" title="Reset filter">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="panel">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span>Daftar Pengguna</span>
            <span class="text-secondary small">{{ $pengguna->total() }} akun</span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Wilayah</th>
                        <th style="min-width:120px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengguna as $item)
                        <tr>
                            <td>{{ $pengguna->firstItem() + $loop->index }}</td>
                            <td class="fw-semibold">{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <span class="badge text-bg-light border">
                                    {{ strtoupper($item->role) }}
                                </span>
                            </td>
                            <td>{{ $item->wilayah->nama_wilayah ?? '-' }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a
                                        href="{{ route('admin.pengguna.edit', $item->id) }}"
                                        class="btn btn-sm btn-outline-success"
                                        title="Edit pengguna"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    @if ($item->id !== auth()->id())
                                        <form
                                            action="{{ route('admin.pengguna.destroy', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus akun ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Hapus pengguna">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-secondary py-5">
                                <i class="bi bi-people fs-3 d-block mb-2"></i>
                                Tidak ada pengguna yang sesuai dengan filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($pengguna->hasPages())
            <div class="p-3 border-top">
                {{ $pengguna->links() }}
            </div>
        @endif
    </section>
@endsection