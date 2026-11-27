@extends('layouts.uptd')

@section('title', 'Deteksi Spam')
@section('page-title', 'Deteksi Spam')

@section('content')
<style>
    .spam-page {
        color: #26382f;
    }

    .spam-heading {
        margin-bottom: 22px;
    }

    .spam-heading h2 {
        font-size: 24px;
        font-weight: 750;
        letter-spacing: -.4px;
        margin-bottom: 6px;
    }

    .spam-heading p {
        color: #718078;
        font-size: 13px;
        margin: 0;
    }

    .spam-stat {
        background: #fff;
        border: 1px solid #e5ece7;
        border-radius: 13px;
        padding: 17px 19px;
        height: 100%;
        box-shadow: 0 3px 12px rgba(25, 70, 43, .035);
    }

    .spam-stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 13px;
    }

    .spam-stat-label {
        color: #718078;
        font-size: 12px;
    }

    .spam-stat-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #e7f3eb;
        color: #176b43;
        font-size: 17px;
    }

    .spam-stat-number {
        color: #26382f;
        font-size: 26px;
        font-weight: 750;
        line-height: 1.2;
    }

    .spam-panel {
        background: #fff;
        border: 1px solid #e5ece7;
        border-radius: 13px;
        box-shadow: 0 3px 12px rgba(25, 70, 43, .035);
        overflow: hidden;
    }

    .spam-panel-header {
        padding: 19px 21px;
        border-bottom: 1px solid #edf1ee;
    }

    .spam-panel-header h5 {
        font-size: 15px;
        font-weight: 700;
        margin: 0 0 4px;
    }

    .spam-panel-header p {
        color: #87938b;
        font-size: 12px;
        margin: 0;
    }

    .spam-table-wrap {
        overflow-x: auto;
        padding: 0 20px 15px;
    }

    .spam-table {
        min-width: 1120px;
        margin: 0;
        font-size: 12px;
        vertical-align: middle;
    }

    .spam-table thead th {
        color: #718078;
        background: #f8faf8;
        font-size: 11px;
        font-weight: 650;
        padding: 13px 10px;
        border-bottom: 1px solid #e8eee9;
        white-space: nowrap;
    }

    .spam-table tbody td {
        padding: 14px 10px;
        border-color: #edf1ee;
    }

    .spam-table tbody tr:hover {
        background: #fbfdfb;
    }

    .spam-muted {
        color: #87938b;
        font-size: 11px;
    }

    .spam-review {
        min-width: 220px;
    }

    .spam-review .form-select,
    .spam-review .form-control {
        border-color: #dfe8e1;
        border-radius: 8px;
        font-size: 12px;
        box-shadow: none;
    }

    .spam-review .form-select:focus,
    .spam-review .form-control:focus {
        border-color: #70a987;
        box-shadow: 0 0 0 3px rgba(23, 107, 67, .08);
    }

    .btn-spam-save {
        width: 100%;
        background: #176b43;
        color: #fff;
        border: 0;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-spam-save:hover {
        background: #125735;
        color: #fff;
    }

    .spam-info {
        background: #f0f7f2;
        border: 1px solid #dcebe0;
        color: #42634e;
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 12px;
        margin-bottom: 18px;
    }

    @media (max-width: 768px) {
        .spam-heading h2 {
            font-size: 21px;
        }

        .spam-panel-header {
            padding: 16px;
        }

        .spam-table-wrap {
            padding-left: 12px;
            padding-right: 12px;
        }
    }
</style>

<div class="spam-page">
    <div class="spam-heading">
        <h2>Pemantauan Deteksi Spam</h2>
        <p>
            Tinjau indikasi laporan berulang dan lonjakan laporan pada TPS
            di wilayah kerja UPTD.
        </p>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show small">
            <i class="bi bi-check-circle-fill me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger small">
            <strong>Peninjauan gagal disimpan.</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="spam-info">
        <i class="bi bi-info-circle-fill me-1"></i>
        Deteksi spam merupakan indikasi awal berdasarkan aktivitas laporan.
        UPTD perlu meninjau kondisi sebelum menentukan hasil peninjauan.
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="spam-stat">
                <div class="spam-stat-top">
                    <span class="spam-stat-label">Total Deteksi</span>
                    <span class="spam-stat-icon"><i class="bi bi-shield-exclamation"></i></span>
                </div>
                <div class="spam-stat-number">{{ $totalDeteksi }}</div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="spam-stat">
                <div class="spam-stat-top">
                    <span class="spam-stat-label">Perlu Ditinjau</span>
                    <span class="spam-stat-icon"><i class="bi bi-hourglass-split"></i></span>
                </div>
                <div class="spam-stat-number">{{ $totalPerluDitinjau }}</div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="spam-stat">
                <div class="spam-stat-top">
                    <span class="spam-stat-label">Terkonfirmasi</span>
                    <span class="spam-stat-icon"><i class="bi bi-check-circle"></i></span>
                </div>
                <div class="spam-stat-number">{{ $totalTerkonfirmasi }}</div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="spam-stat">
                <div class="spam-stat-top">
                    <span class="spam-stat-label">Bukan Spam</span>
                    <span class="spam-stat-icon"><i class="bi bi-shield-check"></i></span>
                </div>
                <div class="spam-stat-number">{{ $totalBukanSpam }}</div>
            </div>
        </div>
    </div>

    <div class="spam-panel">
        <div class="spam-panel-header d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h5>Riwayat Deteksi Spam Wilayah</h5>
                <p>Data deteksi berdasarkan wilayah kerja akun UPTD.</p>
            </div>
            <span class="spam-muted">
                {{ $deteksi->total() }} data ditemukan
            </span>
        </div>

        <div class="spam-table-wrap">
            <table class="table spam-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Jenis Deteksi</th>
                        <th>Informasi TPS</th>
                        <th>Aktivitas Laporan</th>
                        <th>Periode</th>
                        <th>Status Saat Ini</th>
                        <th>Peninjauan UPTD</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($deteksi as $index => $item)
                        <tr>
                            <td>{{ $deteksi->firstItem() + $index }}</td>

                            <td>
                                @if ($item->jenis_deteksi === 'laporan_berulang')
                                    <span class="badge text-bg-warning">Laporan Berulang</span>
                                    <div class="spam-muted mt-1">Pengguna yang sama</div>
                                @elseif ($item->jenis_deteksi === 'lonjakan_laporan_tps')
                                    <span class="badge text-bg-info">Lonjakan Laporan</span>
                                    <div class="spam-muted mt-1">Banyak pengguna pada TPS yang sama</div>
                                @else
                                    <span class="badge text-bg-secondary">
                                        {{ ucfirst(str_replace('_', ' ', $item->jenis_deteksi)) }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                <strong>{{ $item->tps->nama_tps ?? 'TPS tidak tersedia' }}</strong>
                                <div class="spam-muted">ID TPS: {{ $item->id_tps ?? '-' }}</div>
                                @if ($item->tps?->alamat)
                                    <div class="spam-muted">{{ $item->tps->alamat }}</div>
                                @endif
                            </td>

                            <td>
                                <strong>{{ $item->jumlah_laporan }} laporan</strong>
                                <div class="spam-muted">
                                    {{ $item->jumlah_pengguna }} pengguna berbeda
                                </div>
                                @if ($item->id_laporan)
                                    <div class="spam-muted">ID laporan: #{{ $item->id_laporan }}</div>
                                @endif
                            </td>

                            <td>
                                <div>{{ $item->periode_mulai?->format('d/m/Y H:i') ?? '-' }}</div>
                                <div class="spam-muted">
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

                            <td>
                                <form class="spam-review"
                                      method="POST"
                                      action="{{ route('uptd.spam.review', $item->id) }}">
                                    @csrf

                                    <label class="form-label fw-semibold mb-1">
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

                                    <label class="form-label fw-semibold mb-1">
                                        Catatan UPTD
                                    </label>

                                    <textarea name="catatan_uptd"
                                              class="form-control form-control-sm mb-2"
                                              rows="3"
                                              maxlength="5000"
                                              placeholder="Tuliskan hasil pemeriksaan (opsional)">{{ $item->catatan_uptd }}</textarea>

                                    <button type="submit" class="btn-spam-save">
                                        <i class="bi bi-check2-circle me-1"></i>
                                        Simpan Peninjauan
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-secondary">
                                <i class="bi bi-shield-check fs-2 d-block mb-2"></i>
                                Belum ada data deteksi spam pada wilayah ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($deteksi->hasPages())
            <div class="p-3 border-top">
                {{ $deteksi->links() }}
            </div>
        @endif
    </div>
</div>
@endsection