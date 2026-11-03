@extends('layouts.uptd')

@section('title', 'Data TPS Wilayah')
@section('page-title', 'Data TPS Wilayah')

@section('content')

<style>
    .tps-page {
        color: #26382f;
    }

    .tps-heading {
        margin-bottom: 24px;
    }

    .tps-heading h2 {
        font-size: 25px;
        font-weight: 750;
        letter-spacing: -.5px;
        margin-bottom: 7px;
    }

    .tps-heading p {
        color: #718078;
        font-size: 14px;
        margin: 0;
    }

    .tps-stat {
        background: #fff;
        border: 1px solid #e5ece7;
        border-radius: 14px;
        padding: 20px;
        height: 100%;
        box-shadow: 0 3px 12px rgba(25, 70, 43, .035);
        transition: .2s ease;
    }

    .tps-stat:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 22px rgba(25, 70, 43, .08);
    }

    .tps-stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 17px;
    }

    .tps-stat-label {
        color: #718078;
        font-size: 13px;
        font-weight: 500;
    }

    .tps-stat-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #e7f3eb;
        color: #176b43;
        font-size: 19px;
    }

    .tps-stat-number {
        font-size: 29px;
        font-weight: 750;
        line-height: 1.2;
        color: #26382f;
    }

    .tps-stat-note {
        color: #89958e;
        font-size: 12px;
        margin-top: 7px;
    }

    .tps-panel {
        background: #fff;
        border: 1px solid #e5ece7;
        border-radius: 14px;
        box-shadow: 0 3px 12px rgba(25, 70, 43, .035);
        overflow: hidden;
    }

    .tps-panel-header {
        padding: 21px 23px;
        border-bottom: 1px solid #edf1ee;
    }

    .tps-panel-header h5 {
        font-size: 16px;
        font-weight: 700;
        margin: 0 0 5px;
    }

    .tps-panel-header p {
        color: #87938b;
        font-size: 12px;
        margin: 0;
    }

    .tps-toolbar {
        padding: 18px 23px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .tps-search {
        display: flex;
        gap: 8px;
        flex: 1;
        max-width: 540px;
    }

    .tps-search .form-control {
        border: 1px solid #dfe8e1;
        border-radius: 9px;
        min-height: 42px;
        font-size: 13px;
        box-shadow: none;
    }

    .tps-search .form-control:focus {
        border-color: #70a987;
        box-shadow: 0 0 0 3px rgba(23, 107, 67, .08);
    }

    .btn-tps-search {
        background: #176b43;
        color: #fff;
        border: none;
        border-radius: 9px;
        padding: 9px 17px;
        font-size: 13px;
        white-space: nowrap;
    }

    .btn-tps-search:hover {
        background: #125735;
        color: #fff;
    }

    .btn-tps-reset {
        background: #fff;
        color: #53645a;
        border: 1px solid #dfe8e1;
        border-radius: 9px;
        padding: 9px 14px;
        font-size: 13px;
        text-decoration: none;
    }

    .btn-tps-reset:hover {
        background: #f4f7f5;
        color: #176b43;
    }

    .tps-result-info {
        color: #7d8981;
        font-size: 12px;
    }

    .tps-table-wrap {
        padding: 0 23px 20px;
    }

    .tps-table {
        margin: 0;
        min-width: 720px;
    }

    .tps-table thead th {
        background: #f5f8f6;
        color: #65756b;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 14px 13px;
        border-bottom: 1px solid #e7eee9;
        white-space: nowrap;
    }

    .tps-table tbody td {
        padding: 16px 13px;
        border-bottom: 1px solid #eef2ef;
        font-size: 13px;
        color: #526158;
        vertical-align: middle;
    }

    .tps-table tbody tr:last-child td {
        border-bottom: none;
    }

    .tps-table tbody tr:hover {
        background: #f9fbf9;
    }

    .tps-number {
        color: #87938b;
        font-size: 12px;
    }

    .tps-name {
        color: #26382f;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .tps-address {
        color: #87938b;
        font-size: 12px;
        line-height: 1.5;
        max-width: 280px;
    }

    .tps-coordinate {
        font-size: 12px;
        color: #65756b;
        line-height: 1.7;
    }

    .tps-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 9px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .tps-badge-available {
        color: #176b43;
        background: #e7f4eb;
    }

    .tps-badge-empty {
        color: #9a6b22;
        background: #fff4df;
    }

    .tps-map-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #176b43;
        background: #edf6f0;
        border: 1px solid #dfede3;
        padding: 7px 10px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .tps-map-link:hover {
        color: #fff;
        background: #176b43;
        border-color: #176b43;
    }

    .tps-empty {
        padding: 55px 20px !important;
        text-align: center;
    }

    .tps-empty-icon {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        background: #edf5ef;
        color: #176b43;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        margin: 0 auto 15px;
    }

    .tps-empty strong {
        color: #34483b;
        font-size: 14px;
    }

    .tps-empty p {
        color: #87938b;
        font-size: 12px;
        margin: 6px 0 0;
    }

    .tps-pagination {
        padding: 0 23px 20px;
    }

    .tps-pagination nav {
        display: flex;
        justify-content: flex-end;
    }

    .tps-pagination .pagination {
        margin: 0;
    }

    .tps-pagination .page-link {
        color: #176b43;
        border-color: #e5ece7;
        font-size: 12px;
    }

    .tps-pagination .active .page-link {
        background: #176b43;
        border-color: #176b43;
        color: #fff;
    }

    @media (max-width: 600px) {
        .tps-heading h2 {
            font-size: 21px;
        }

        .tps-stat {
            padding: 16px;
        }

        .tps-toolbar {
            padding: 15px;
        }

        .tps-search {
            max-width: 100%;
            width: 100%;
        }

        .tps-table-wrap {
            padding: 0 15px 15px;
        }

        .tps-panel-header {
            padding: 17px 15px;
        }

        .tps-pagination {
            padding: 0 15px 15px;
        }
    }
</style>

<div class="tps-page">

    <div class="tps-heading">
        <h2>Data TPS Wilayah</h2>
        <p>Informasi tempat pembuangan sampah yang berada di wilayah kerja Anda.</p>
    </div>

    {{-- RINGKASAN DATA --}}
    <div class="row g-3 mb-4">

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="tps-stat">
                <div class="tps-stat-top">
                    <span class="tps-stat-label">Total TPS Wilayah</span>
                    <div class="tps-stat-icon">
                        <i class="bi bi-recycle"></i>
                    </div>
                </div>
                <div class="tps-stat-number">{{ $totalTps }}</div>
                <div class="tps-stat-note">Seluruh TPS yang terdaftar</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="tps-stat">
                <div class="tps-stat-top">
                    <span class="tps-stat-label">Lokasi Tersedia</span>
                    <div class="tps-stat-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                </div>
                <div class="tps-stat-number">{{ $totalDenganKoordinat }}</div>
                <div class="tps-stat-note">TPS dengan koordinat lokasi</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="tps-stat">
                <div class="tps-stat-top">
                    <span class="tps-stat-label">Lokasi Belum Tersedia</span>
                    <div class="tps-stat-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                </div>
                <div class="tps-stat-number">{{ $totalTanpaKoordinat }}</div>
                <div class="tps-stat-note">TPS tanpa koordinat lokasi</div>
            </div>
        </div>

    </div>

    {{-- DAFTAR TPS --}}
    <div class="tps-panel">

        <div class="tps-panel-header">
            <h5>Daftar TPS Wilayah</h5>
            <p>Daftar lokasi TPS beserta alamat dan informasi koordinatnya.</p>
        </div>

        <div class="tps-toolbar">

            <form method="GET" action="{{ route('uptd.tps.index') }}" class="tps-search">
                <input
                    type="text"
                    name="cari"
                    class="form-control"
                    placeholder="Cari nama TPS atau alamat..."
                    value="{{ request('cari') }}"
                    aria-label="Cari nama TPS atau alamat"
                >

                <button type="submit" class="btn-tps-search">
                    <i class="bi bi-search me-1"></i> Cari
                </button>

                @if(request('cari'))
                    <a href="{{ route('uptd.tps.index') }}" class="btn-tps-reset">
                        Reset
                    </a>
                @endif
            </form>

            <div class="tps-result-info">
                Menampilkan <strong>{{ $tps->count() }}</strong> dari
                <strong>{{ $tps->total() }}</strong> hasil pencarian
            </div>

        </div>

        <div class="tps-table-wrap">
            <div class="table-responsive">
                <table class="table tps-table align-middle">
                    <thead>
                        <tr>
                            <th width="55">No.</th>
                            <th>Informasi TPS</th>
                            <th>Koordinat Lokasi</th>
                            <th>Status Lokasi</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($tps as $item)
                            <tr>
                                <td>
                                    <span class="tps-number">
                                        {{ $tps->firstItem() + $loop->index }}
                                    </span>
                                </td>

                                <td>
                                    <div class="tps-name">{{ $item->nama_tps }}</div>
                                    <div class="tps-address">
                                        <i class="bi bi-geo-alt me-1"></i>
                                        {{ $item->alamat ?: 'Alamat belum tersedia' }}
                                    </div>
                                </td>

                                <td>
                                    @if ($item->latitude !== null && $item->longitude !== null)
                                        <div class="tps-coordinate">
                                            {{ $item->latitude }}<br>
                                            {{ $item->longitude }}
                                        </div>
                                    @else
                                        <span class="text-muted">Belum tersedia</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($item->latitude !== null && $item->longitude !== null)
                                        <span class="tps-badge tps-badge-available">
                                            <i class="bi bi-check-circle-fill"></i>
                                            Tersedia
                                        </span>
                                    @else
                                        <span class="tps-badge tps-badge-empty">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            Belum ada
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    @if ($item->latitude !== null && $item->longitude !== null)
                                        <a
                                            href="https://www.google.com/maps?q={{ $item->latitude }},{{ $item->longitude }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="tps-map-link"
                                        >
                                            <i class="bi bi-map"></i>
                                            Lihat Peta
                                        </a>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="tps-empty">
                                    <div class="tps-empty-icon">
                                        <i class="bi bi-inbox"></i>
                                    </div>

                                    <strong>
                                        {{ request('cari') ? 'TPS Tidak Ditemukan' : 'Belum Ada Data TPS' }}
                                    </strong>

                                    <p>
                                        @if(request('cari'))
                                            Tidak ada TPS yang sesuai dengan kata kunci pencarian.
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
        </div>

        @if ($tps->hasPages())
            <div class="tps-pagination">
                {{ $tps->links() }}
            </div>
        @endif

    </div>

</div>

<style>
/* TPS-COMPACT-SIZE-V2 */

/* Judul halaman */
.tps-heading {
    margin-bottom: 17px !important;
}

.tps-heading h2 {
    font-size: 21px !important;
    margin-bottom: 5px !important;
}

.tps-heading p {
    font-size: 12px !important;
}

/* Kartu ringkasan */
.tps-page .row.g-3 {
    --bs-gutter-x: 12px;
    --bs-gutter-y: 12px;
    margin-bottom: 18px !important;
}

.tps-stat {
    padding: 14px 16px !important;
    border-radius: 11px !important;
}

.tps-stat-top {
    margin-bottom: 10px !important;
}

.tps-stat-label {
    font-size: 12px !important;
}

.tps-stat-icon {
    width: 34px !important;
    height: 34px !important;
    border-radius: 9px !important;
    font-size: 16px !important;
}

.tps-stat-number {
    font-size: 24px !important;
}

.tps-stat-note {
    font-size: 11px !important;
    margin-top: 4px !important;
}

/* Panel daftar TPS */
.tps-panel {
    border-radius: 11px !important;
}

.tps-panel-header {
    padding: 15px 18px !important;
}

.tps-panel-header h5 {
    font-size: 14px !important;
    margin-bottom: 4px !important;
}

.tps-panel-header p {
    font-size: 11px !important;
}

/* Pencarian */
.tps-toolbar {
    padding: 13px 18px !important;
    gap: 10px !important;
}

.tps-search .form-control {
    min-height: 36px !important;
    font-size: 12px !important;
}

.btn-tps-search,
.btn-tps-reset {
    padding: 8px 12px !important;
    font-size: 11px !important;
}

.tps-result-info {
    font-size: 11px !important;
}

/* Tabel */
.tps-table-wrap {
    padding: 0 18px 14px !important;
}

.tps-table thead th {
    padding: 11px 10px !important;
    font-size: 10px !important;
}

.tps-table tbody td {
    padding: 11px 10px !important;
    font-size: 11px !important;
}

.tps-name {
    font-size: 12px !important;
}

.tps-address,
.tps-coordinate {
    font-size: 10px !important;
}

.tps-badge {
    padding: 5px 8px !important;
    font-size: 10px !important;
}

.tps-map-link {
    padding: 6px 8px !important;
    font-size: 10px !important;
}

.tps-empty {
    padding: 35px 15px !important;
}

.tps-pagination {
    padding: 0 18px 14px !important;
}

.tps-pagination .page-link {
    font-size: 11px !important;
    padding: 6px 10px !important;
}

/* Responsif */
@media (max-width: 600px) {
    .tps-heading h2 {
        font-size: 19px !important;
    }

    .tps-stat {
        padding: 13px !important;
    }

    .tps-toolbar {
        padding: 12px !important;
    }

    .tps-table-wrap {
        padding: 0 12px 12px !important;
    }
}
</style>
@endsection