@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.uptd')

@section('title', 'Data Armada')
@section('page-title', 'Data Armada')

@section('content')
@php
    $prefix = auth()->user()->role;
    $daftarStatus = [
        'tersedia' => 'Tersedia',
        'digunakan' => 'Sedang Digunakan',
        'rusak' => 'Rusak',
        'perbaikan' => 'Dalam Perbaikan',
        'nonaktif' => 'Nonaktif',
    ];
@endphp

<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">Data Armada</h4>
            <p class="text-muted mb-0">
                Kelola kendaraan operasional pengangkutan sampah.
            </p>
        </div>

        <a href="{{ route($prefix . '.armada.create') }}" class="btn btn-success">
            + Tambah Armada
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
            <form action="{{ route($prefix . '.armada.index') }}" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label for="cari" class="form-label">Cari Armada</label>
                        <input type="text" name="cari" id="cari"
                            class="form-control"
                            placeholder="Kode, jenis, atau nomor polisi"
                            value="{{ request('cari') }}">
                    </div>

                    @if ($prefix === 'admin')
                        <div class="col-md-3">
                            <label for="id_wilayah" class="form-label">Wilayah</label>
                            <select name="id_wilayah" id="id_wilayah" class="form-select">
                                <option value="">Semua Wilayah</option>
                                @foreach ($wilayah as $itemWilayah)
                                    <option value="{{ $itemWilayah->id }}"
                                        @selected(request('id_wilayah') == $itemWilayah->id)>
                                        {{ $itemWilayah->nama_wilayah }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="col-md-2">
                        <label for="status_armada" class="form-label">Status</label>
                        <select name="status_armada" id="status_armada" class="form-select">
                            <option value="">Semua Status</option>
                            @foreach ($daftarStatus as $nilai => $label)
                                <option value="{{ $nilai }}"
                                    @selected(request('status_armada') === $nilai)>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-success">Cari</button>
                        <a href="{{ route($prefix . '.armada.index') }}"
                            class="btn btn-outline-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Daftar Armada</h6>
                <span class="text-muted small">
                    Total: {{ $armadas->total() }} armada
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Kode Armada</th>
                            <th>Jenis Armada</th>
                            <th>Nomor Polisi</th>
                            <th>Wilayah</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($armadas as $item)
                            <tr>
                                <td>{{ $armadas->firstItem() + $loop->index }}</td>
                                <td class="fw-semibold">{{ $item->kode_armada }}</td>
                                <td>{{ $item->jenis_armada ?: '-' }}</td>
                                <td>{{ $item->nomor_polisi ?: '-' }}</td>
                                <td>{{ $item->wilayah->nama_wilayah ?? '-' }}</td>
                                <td>
                                    @php
                                        $warnaStatus = [
                                            'tersedia' => 'success',
                                            'digunakan' => 'primary',
                                            'rusak' => 'danger',
                                            'perbaikan' => 'warning',
                                            'nonaktif' => 'secondary',
                                        ];
                                    @endphp
                                    <span class="badge text-bg-{{ $warnaStatus[$item->status_armada] ?? 'secondary' }}">
                                        {{ $daftarStatus[$item->status_armada] ?? ucfirst($item->status_armada) }}
                                    </span>
                                </td>
                                <td>{{ $item->keterangan ?: '-' }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route($prefix . '.armada.edit', $item->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            Edit
                                        </a>

                                        <form action="{{ route($prefix . '.armada.destroy', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus armada ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    Belum ada data armada.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $armadas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection