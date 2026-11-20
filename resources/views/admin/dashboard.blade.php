@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold mb-1" style="font-size:23px">
            Selamat Datang, {{ auth()->user()->name }}!
        </h2>
        <p class="text-secondary mb-0">
            Ringkasan data pengaduan dan monitoring TPS Kabupaten Indramayu.
        </p>
    </div>

    <h5 class="fw-bold mb-3">Ringkasan Sistem</h5>

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <a href="{{ route('admin.pengguna.index') }}" class="stat-card clickable" title="Lihat semua pengguna terdaftar">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">Total Pengguna</span>
                    <span class="stat-icon"><i class="bi bi-people"></i></span>
                </div>
                <div class="stat-number">{{ $totalPengguna }}</div>
                <div class="text-secondary small">Semua akun terdaftar &rarr;</div>
            </a>
        </div>

        <div class="col-12 col-sm-6 col-xl-3" id="pengguna">
            <a href="{{ route('admin.pengguna.index', ['role' => 'uptd']) }}" class="stat-card clickable" title="Lihat petugas UPTD">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">UPTD</span>
                    <span class="stat-icon"><i class="bi bi-person-badge"></i></span>
                </div>
                <div class="stat-number">{{ $totalUptd }}</div>
                <div class="text-secondary small">Akun petugas UPTD &rarr;</div>
            </a>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <a href="{{ route('admin.pengguna.index', ['role' => 'supir']) }}" class="stat-card clickable" title="Lihat petugas supir">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">Supir</span>
                    <span class="stat-icon"><i class="bi bi-truck"></i></span>
                </div>
                <div class="stat-number">{{ $totalSupir }}</div>
                <div class="text-secondary small">Petugas pengangkutan &rarr;</div>
            </a>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <a href="{{ route('admin.pengguna.index', ['role' => 'masyarakat']) }}" class="stat-card clickable" title="Lihat akun masyarakat">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">Masyarakat</span>
                    <span class="stat-icon"><i class="bi bi-person"></i></span>
                </div>
                <div class="stat-number">{{ $totalMasyarakat }}</div>
                <div class="text-secondary small">Akun pelapor &rarr;</div>
            </a>
        </div>

        <div class="col-12 col-sm-6 col-xl-3" id="wilayah">
            <a href="{{ route('admin.wilayah.index') }}" class="stat-card clickable" title="Kelola data wilayah">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">Wilayah</span>
                    <span class="stat-icon"><i class="bi bi-geo"></i></span>
                </div>
                <div class="stat-number">{{ $totalWilayah }}</div>
                <div class="text-secondary small">Wilayah terdaftar &rarr;</div>
            </a>
        </div>

        <div class="col-12 col-sm-6 col-xl-3" id="tps">
            <a href="{{ route('admin.tps.index') }}" class="stat-card clickable" title="Kelola data TPS">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">Data TPS</span>
                    <span class="stat-icon"><i class="bi bi-trash"></i></span>
                </div>
                <div class="stat-number">{{ $totalTps }}</div>
                <div class="text-secondary small">TPS terdaftar &rarr;</div>
            </a>
        </div>

        <div class="col-12 col-sm-6 col-xl-3" id="laporan">
            <a href="{{ route('admin.laporan.index') }}" class="stat-card clickable" title="Lihat semua laporan">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">Total Laporan</span>
                    <span class="stat-icon"><i class="bi bi-file-earmark-text"></i></span>
                </div>
                <div class="stat-number">{{ $totalLaporan }}</div>
                <div class="text-secondary small">Semua laporan masuk &rarr;</div>
            </a>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <a href="{{ route('admin.laporan.index', ['status' => 'selesai']) }}" class="stat-card clickable" title="Lihat laporan selesai">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">Laporan Selesai</span>
                    <span class="stat-icon"><i class="bi bi-check-circle"></i></span>
                </div>
                <div class="stat-number text-success">{{ $laporanSelesai }}</div>
                <div class="text-secondary small">Telah selesai ditangani &rarr;</div>
            </a>
        </div>
    </div>

    <h5 class="fw-bold mb-3">Status Laporan</h5>
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-4">
            <a href="{{ route('admin.laporan.index', ['status' => 'menunggu']) }}" class="stat-card clickable" title="Filter laporan menunggu">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="stat-label">Menunggu Verifikasi</div>
                    <span class="status menunggu">Menunggu</span>
                </div>
                <div class="stat-number mt-2">{{ $laporanMenunggu }}</div>
                <div class="text-secondary small mt-2">Perlu diverifikasi UPTD &rarr;</div>
            </a>
        </div>
        <div class="col-6 col-lg-4">
            <a href="{{ route('admin.laporan.index', ['status' => 'diproses']) }}" class="stat-card clickable" title="Filter laporan diproses">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="stat-label">Sedang Diproses</div>
                    <span class="status diproses">Diproses</span>
                </div>
                <div class="stat-number mt-2">{{ $laporanDiproses }}</div>
                <div class="text-secondary small mt-2">Dalam tindak lanjut &rarr;</div>
            </a>
        </div>
        <div class="col-6 col-lg-4">
            <a href="{{ route('admin.laporan.index', ['status' => 'ditolak']) }}" class="stat-card clickable" title="Filter laporan ditolak">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="stat-label">Ditolak</div>
                    <span class="status ditolak">Ditolak</span>
                </div>
                <div class="stat-number mt-2">{{ $laporanDitolak }}</div>
                <div class="text-secondary small mt-2">Tidak dapat diproses &rarr;</div>
            </a>
        </div>
    </div>

    <section class="panel">
        <div class="panel-heading d-flex justify-content-between align-items-center flex-wrap gap-2">
            <span>Laporan Terbaru</span>
            <a href="{{ route('admin.laporan.index') }}" class="btn btn-sm btn-outline-success">
                Lihat Semua Laporan <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px;">No.</th>
                        <th>Pelapor</th>
                        <th>Wilayah</th>
                        <th>Lokasi TPS</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporanTerbaru as $laporan)
                        @php
                            $status = $laporan->status_laporan;
                            $classStatus = match ($status) {
                                'selesai' => 'selesai',
                                'ditolak' => 'ditolak',
                                'diproses', 'ditangani', 'ditugaskan', 'sedang_dikerjakan' => 'diproses',
                                'diverifikasi' => 'diverifikasi',
                                default => 'menunggu',
                            };
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="fw-semibold">{{ $laporan->pengguna->name ?? '-' }}</div>
                                <small class="text-secondary">{{ $laporan->pengguna->email ?? '' }}</small>
                            </td>
                            <td>{{ $laporan->tps->wilayah->nama_wilayah ?? '-' }}</td>
                            <td>{{ $laporan->tps->nama_tps ?? $laporan->lokasi ?? '-' }}</td>
                            <td>{{ $laporan->kategori_kondisi }}</td>
                            <td>{{ $laporan->waktu_pelaporan?->format('d-m-Y H:i') ?? '-' }}</td>
                            <td>
                                <span class="status {{ $classStatus }}">
                                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.laporan.show', $laporan->id) }}" class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-secondary py-5">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada laporan yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
