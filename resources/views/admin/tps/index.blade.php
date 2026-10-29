@extends('layouts.admin')

@section('title', 'Data TPS')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">Data TPS</h4>
            <p class="text-muted mb-0">Kelola data tempat pembuangan sementara.</p>
        </div>
        <a href="{{ route('admin.tps.create') }}" class="btn btn-success">
            + Tambah TPS
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.tps.index') }}" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label" for="cari">Cari TPS</label>
                        <input type="text" id="cari" name="cari"
                            class="form-control"
                            placeholder="Nama TPS atau alamat"
                            value="{{ $cari ?? '' }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label" for="id_wilayah">Filter Wilayah UPTD</label>
                        <select id="id_wilayah" name="id_wilayah" class="form-select">
                            <option value="">Semua Wilayah</option>
                            @foreach ($wilayah as $wilayahItem)
                                <option value="{{ $wilayahItem->id }}"
                                    {{ (string) ($idWilayah ?? '') === (string) $wilayahItem->id ? 'selected' : '' }}>
                                    {{ $wilayahItem->nama_wilayah }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label" for="urutkan">Urutkan</label>
                        <select id="urutkan" name="urutkan" class="form-select">
                            <option value="nama_az" {{ ($urutkan ?? '') === 'nama_az' ? 'selected' : '' }}>Nama A-Z</option>
                            <option value="nama_za" {{ ($urutkan ?? '') === 'nama_za' ? 'selected' : '' }}>Nama Z-A</option>
                        </select>
                    </div>

                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-success">Cari</button>
                        <a href="{{ route('admin.tps.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Daftar TPS</h6>
                <span class="text-muted small">Total: {{ $tps->total() }} TPS</span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Nama TPS</th>
                            <th>Wilayah</th>
                            <th>Alamat</th>
                            <th>Koordinat</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tps as $item)
                            <tr>
                                <td>{{ $tps->firstItem() + $loop->index }}</td>
                                <td class="fw-semibold">{{ $item->nama_tps }}</td>
                                <td>{{ $item->wilayah->nama_wilayah ?? '-' }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>
                                    @if ($item->latitude !== null && $item->longitude !== null)
                                        {{ $item->latitude }}, {{ $item->longitude }}
                                    @else
                                        <span class="text-muted">Belum diisi</span>
                                    @endif
                                </td>
                                <td>{{ $item->keterangan ?: '-' }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.tps.edit', $item->id) }}"
                                            class="btn btn-sm btn-outline-success">Edit</a>
                                        <form action="{{ route('admin.tps.destroy', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus TPS ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    Belum ada data TPS. Silakan tambahkan TPS terlebih dahulu.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $tps->links() }}
            </div>
        </div>
    </div>
</div>
@endsection