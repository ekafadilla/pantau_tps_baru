@extends('layouts.uptd')

@section('title', 'Data TPS Wilayah')
@section('page-title', 'Data TPS Wilayah')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-4">
    <div>
        <h2 class="fw-bold mb-1" style="font-size:23px;">Data TPS Wilayah</h2>
        <p class="mb-0" style="color:#718078;">
            Daftar tempat pembuangan sampah di wilayah kerja Anda.
        </p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <div class="mb-2" style="color:#718078;">Total TPS Wilayah</div>
                <div class="fs-3 fw-bold">{{ $totalTps }}</div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-3 p-md-4">
        <form method="GET" action="{{ route('uptd.tps.index') }}"
              class="row g-2 mb-4">
            <div class="col-12 col-md-9">
                <input
                    type="text"
                    name="cari"
                    class="form-control"
                    placeholder="Cari nama TPS atau alamat..."
                    value="{{ request('cari') }}"
                >
            </div>
            <div class="col-6 col-md-2">
                <button type="submit" class="btn btn-success w-100">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
            <div class="col-6 col-md-1">
                <a href="{{ route('uptd.tps.index') }}"
                   class="btn btn-outline-secondary w-100">Reset</a>
            </div>
        </form>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">Daftar TPS</h5>
            <span style="color:#718078;">{{ $tps->total() }} data</span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Nama TPS</th>
                        <th>Alamat</th>
                        <th>Koordinat</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tps as $item)
                        <tr>
                            <td>{{ $tps->firstItem() + $loop->index }}</td>
                            <td class="fw-semibold">{{ $item->nama_tps }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>
                                @if ($item->latitude !== null && $item->longitude !== null)
                                    <span>{{ $item->latitude }}, {{ $item->longitude }}</span>
                                @else
                                    <span class="text-muted">Belum tersedia</span>
                                @endif
                            </td>
                            <td>{{ $item->keterangan ?: '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="bi bi-inbox fs-2 d-block mb-2"
                                   style="color:#718078;"></i>
                                <strong>Belum ada data TPS</strong>
                                <p class="mb-0 mt-1" style="color:#718078;">
                                    @if (request('cari'))
                                        Tidak ditemukan TPS yang sesuai dengan pencarian.
                                    @else
                                        Belum ada TPS yang terdaftar di wilayah kerja Anda.
                                    @endif
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($tps->hasPages())
            <div class="mt-3">
                {{ $tps->links() }}
            </div>
        @endif
    </div>
</div>
@endsection