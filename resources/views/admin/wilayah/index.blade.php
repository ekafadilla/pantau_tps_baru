@extends('layouts.admin')

@section('title', 'Data Wilayah')
@section('page-title', 'Data Wilayah')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="font-size:23px">Data Wilayah</h2>
            <p class="text-secondary mb-0">
                Kelola wilayah kerja UPTD dan cakupan pelayanan TPS.
            </p>
        </div>

        <a href="{{ route('admin.wilayah.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Tambah Wilayah
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
            <form action="{{ route('admin.wilayah.index') }}" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-12 col-md-7">
                        <label for="cari" class="form-label">Cari wilayah</label>
                        <input
                            type="text"
                            id="cari"
                            name="cari"
                            class="form-control"
                            value="{{ request('cari') }}"
                            placeholder="Nama atau keterangan wilayah"
                        >
                    </div>

                    <div class="col-12 col-md-3">
                        <label for="urutkan" class="form-label">Urutkan nama</label>
                        <select id="urutkan" name="urutkan" class="form-select">
                            <option value="nama_az" @selected($urutkan === 'nama_az')>A–Z</option>
                            <option value="nama_za" @selected($urutkan === 'nama_za')>Z–A</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-success">Terapkan</button>
                        <a href="{{ route('admin.wilayah.index') }}"
                           class="btn btn-outline-secondary"
                           title="Reset pencarian">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="panel">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span>Daftar Wilayah</span>
            <span class="text-secondary small">{{ $wilayah->total() }} wilayah</span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:70px">No.</th>
                        <th>Nama Wilayah</th>
                        <th>Keterangan</th>
                        <th style="width:130px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($wilayah as $item)
                        <tr>
                            <td>{{ $wilayah->firstItem() + $loop->index }}</td>
                            <td class="fw-semibold">{{ $item->nama_wilayah }}</td>
                            <td>{{ $item->keterangan ?: '-' }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a
                                        href="{{ route('admin.wilayah.edit', $item->id) }}"
                                        class="btn btn-sm btn-outline-success"
                                        title="Edit wilayah"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form
                                        action="{{ route('admin.wilayah.destroy', $item->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus wilayah ini? Wilayah yang digunakan UPTD atau TPS tidak dapat dihapus.')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Hapus wilayah"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-secondary py-5">
                                <i class="bi bi-geo-alt fs-3 d-block mb-2"></i>
                                Belum ada data wilayah yang sesuai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($wilayah->hasPages())
            <div class="p-3 border-top">
                {{ $wilayah->links() }}
            </div>
        @endif
    </section>
@endsection