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
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">Total Pengguna</span>
                    <span class="stat-icon"><i class="bi bi-people"></i></span>
                </div>
                <div class="stat-number">{{ $totalPengguna }}</div>
                <div class="text-secondary small">Semua akun terdaftar</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3" id="pengguna">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">UPTD</span>
                    <span class="stat-icon"><i class="bi bi-person-badge"></i></span>
                </div>
                <div class="stat-number">{{ $totalUptd }}</div>
                <div class="text-secondary small">Akun petugas UPTD</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">Supir</span>
                    <span class="stat-icon"><i class="bi bi-truck"></i></span>
                </div>
                <div class="stat-number">{{ $totalSupir }}</div>
                <div class="text-secondary small">Akun petugas pengangkutan</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">Masyarakat</span>
                    <span class="stat-icon"><i class="bi bi-person"></i></span>
                </div>
                <div class="stat-number">{{ $totalMasyarakat }}</div>
                <div class="text-secondary small">Akun pelapor</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3" id="wilayah">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">Wilayah</span>
                    <span class="stat-icon"><i class="bi bi-geo"></i></span>
                </div>
                <div class="stat-number">{{ $totalWilayah }}</div>
                <div class="text-secondary small">Wilayah terdaftar</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3" id="tps">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">Data TPS</span>
                    <span class="stat-icon"><i class="bi bi-trash"></i></span>
                </div>
                <div class="stat-number">{{ $totalTps }}</div>
                <div class="text-secondary small">TPS terdaftar</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3" id="laporan">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">Total Laporan</span>
                    <span class="stat-icon"><i class="bi bi-file-earmark-text"></i></span>
                </div>
                <div class="stat-number">{{ $totalLaporan }}</div>
                <div class="text-secondary small">Semua laporan masuk</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">Laporan Selesai</span>
                    <span class="stat-icon"><i class="bi bi-check-circle"></i></span>
                </div>
                <div class="stat-number">{{ $laporanSelesai }}</div>
                <div class="text-secondary small">Telah selesai ditangani</div>
            </div>
        </div>
    </div>

    <h5 class="fw-bold mb-3">Status Laporan</h5>
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-4">
            <div class="stat-card">
                <div class="stat-label">Menunggu Verifikasi</div>
                <div class="stat-number">{{ $laporanMenunggu }}</div>
            </div>
        </div>
        <div class="col-6 col-lg-4">
            <div class="stat-card">
                <div class="stat-label">Sedang Diproses</div>
                <div class="stat-number">{{ $laporanDiproses }}</div>
            </div>
        </div>
        <div class="col-6 col-lg-4">
            <div class="stat-card">
                <div class="stat-label">Ditolak</div>
                <div class="stat-number">{{ $laporanDitolak }}</div>
            </div>
        </div>
    </div>

    <section class="panel">
        <div class="panel-heading">Laporan Terbaru</div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pelapor</th>
                        <th>Lokasi TPS</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporanTerbaru as $laporan)
                        @php
                            $status = $laporan->status_laporan;
                            $classStatus = match ($status) {
                                'selesai' => 'selesai',
                                'ditolak' => 'ditolak',
                                'diproses', 'ditangani', 'ditugaskan',
                                'sedang_dikerjakan' => 'diproses',
                                default => '',
                            };
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $laporan->pengguna->name ?? '-' }}</td>
                            <td>{{ $laporan->tps->nama_tps ?? $laporan->lokasi ?? '-' }}</td>
                            <td>{{ $laporan->kategori_kondisi }}</td>
                            <td>{{ $laporan->waktu_pelaporan?->format('d-m-Y H:i') ?? '-' }}</td>
                            <td>
                                <span class="status {{ $classStatus }}">
                                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-secondary py-5">
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