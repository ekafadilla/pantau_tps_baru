@extends('layouts.admin')

@section('title', 'Deteksi Spam')
@section('page-title', 'Deteksi Spam')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-1">Pemantauan Deteksi Spam</h4>
    <p class="text-secondary mb-0">
        Tinjau laporan berulang dan lonjakan laporan pada TPS.
        Hasil deteksi merupakan indikasi awal, bukan keputusan otomatis.
    </p>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Peninjauan gagal disimpan.</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-label">Total Deteksi</div>
            <div class="stat-number">{{ $totalDeteksi }}</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-label">Perlu Ditinjau</div>
            <div class="stat-number">{{ $totalPerluDitinjau }}</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-label">Terkonfirmasi</div>
            <div class="stat-number">{{ $totalTerkonfirmasi }}</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-label">Bukan Spam</div>
            <div class="stat-number">{{ $totalBukanSpam }}</div>
        </div>
    </div>
</div>

<div class="panel">
    <div class="panel-heading d-flex justify-content-between align-items-center flex-wrap gap-2">
        <span>Riwayat Deteksi</span>
        <span class="text-secondary small">
            {{ $deteksi->total() }} data ditemukan
        </span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Jenis Deteksi</th>
                    <th>Informasi TPS</th>
                    <th>Aktivitas Laporan</th>
                    <th>Periode</th>
                    <th>Status Peninjauan</th>
                    <th>Peninjauan Admin</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($deteksi as $index => $item)
                    <tr>
                        <td>{{ $deteksi->firstItem() + $index }}</td>

                        <td>
                            @if ($item->jenis_deteksi === 'laporan_berulang')
                                <span class="badge text-bg-warning">Laporan Berulang</span>
                                <div class="small text-secondary mt-1">
                                    Pengguna yang sama
                                </div>
                            @elseif ($item->jenis_deteksi === 'lonjakan_laporan_tps')
                                <span class="badge text-bg-info">Lonjakan Laporan</span>
                                <div class="small text-secondary mt-1">
                                    Banyak pengguna pada TPS yang sama
                                </div>
                            @else
                                <span class="badge text-bg-secondary">
                                    {{ ucfirst(str_replace('_', ' ', $item->jenis_deteksi)) }}
                                </span>
                            @endif
                        </td>

                        <td>
                            <strong>{{ $item->tps->nama_tps ?? 'TPS tidak tersedia' }}</strong>
                            <div class="small text-secondary">
                                ID TPS: {{ $item->id_tps }}
                            </div>
                            @if ($item->pengguna)
                                <div class="small text-secondary">
                                    Pelapor: {{ $item->pengguna->name }}
                                </div>
                            @endif
                        </td>

                        <td>
                            <div>{{ $item->jumlah_laporan }} laporan</div>
                            <div class="small text-secondary">
                                {{ $item->jumlah_pengguna }} pengguna berbeda
                            </div>
                            @if ($item->id_laporan)
                                <div class="small text-secondary">
                                    ID laporan: #{{ $item->id_laporan }}
                                </div>
                            @endif
                        </td>

                        <td>
                            <div class="small">
                                {{ $item->periode_mulai?->format('d/m/Y H:i') ?? '-' }}
                            </div>
                            <div class="small text-secondary">
                                s.d. {{ $item->periode_selesai?->format('d/m/Y H:i') ?? '-' }}
                            </div>
                        </td>

                        <td>
                            @if ($item->status_peninjauan === 'terkonfirmasi')
                                <span class="badge text-bg-success">Terkonfirmasi</span>
                            @elseif ($item->status_peninjauan === 'bukan_spam')
                                <span class="badge text-bg-secondary">Bukan Spam</span>
                            @else
                                <span class="badge text-bg-warning">Perlu Ditinjau</span>
                            @endif
                        </td>

                        <td style="min-width: 230px;">
                            <form method="POST"
                                  action="{{ route('admin.spam.review', $item->id) }}">
                                @csrf

                                <label class="form-label small fw-semibold">
                                    Hasil peninjauan
                                </label>

                                <select name="status_peninjauan"
                                        class="form-select form-select-sm mb-2"
                                        required>
                                    <option value="perlu_ditinjau"
                                        {{ $item->status_peninjauan === 'perlu_ditinjau' ? 'selected' : '' }}>
                                        Perlu Ditinjau
                                    </option>
                                    <option value="terkonfirmasi"
                                        {{ $item->status_peninjauan === 'terkonfirmasi' ? 'selected' : '' }}>
                                        Terkonfirmasi
                                    </option>
                                    <option value="bukan_spam"
                                        {{ $item->status_peninjauan === 'bukan_spam' ? 'selected' : '' }}>
                                        Bukan Spam
                                    </option>
                                </select>

                                <textarea name="catatan_admin"
                                          class="form-control form-control-sm mb-2"
                                          rows="2"
                                          maxlength="5000"
                                          placeholder="Catatan admin (opsional)">{{ old('catatan_admin', $item->catatan_admin) }}</textarea>

                                <button type="submit" class="btn btn-success btn-sm w-100">
                                    <i class="bi bi-check2-circle"></i>
                                    Simpan Peninjauan
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-secondary">
                            <i class="bi bi-shield-check fs-2 d-block mb-2"></i>
                            Belum ada data deteksi spam.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($deteksi->hasPages())
        <div class="p-3">
            {{ $deteksi->links() }}
        </div>
    @endif
</div>
@endsection