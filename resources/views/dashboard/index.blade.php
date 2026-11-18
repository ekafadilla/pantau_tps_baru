@extends($role === 'uptd' ? 'layouts.uptd' : 'layouts.app')

@section('title', 'Dashboard ' . $roleLabel . ' | SI Pantau TPS')
@section('page-title', 'Dashboard ' . $roleLabel)

@push('styles')
<style>
    .welcome {
        position: relative;
        overflow: hidden;
        padding: 25px 28px;
        margin-bottom: 25px;
        border: 1px solid #dcebe0;
        border-radius: 12px;
        background: linear-gradient(110deg, #e8f4eb 0%, #f7fbf8 100%);
        box-shadow: 0 4px 15px rgba(23, 107, 67, .035);
    }

    .welcome::after {
        content: "";
        position: absolute;
        top: -55px;
        right: -35px;
        width: 190px;
        height: 190px;
        border: 25px solid rgba(44, 128, 88, .055);
        border-radius: 50%;
        pointer-events: none;
    }

    .welcome h1 {
        position: relative;
        z-index: 1;
        margin: 0 0 9px;
        color: #174e34;
        font-size: 22px;
        font-weight: 700;
        line-height: 1.4;
    }

    .welcome p {
        position: relative;
        z-index: 1;
        max-width: 650px;
        margin: 0;
        color: #66796c;
        font-size: 13px;
        line-height: 1.7;
    }

    .section-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 25px 0 15px;
    }

    .section-heading h2 {
        margin: 0;
        color: #26382f;
        font-size: 16px;
        font-weight: 700;
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
    }

    .stat-card {
        padding: 17px;
        border: 1px solid #e5ece6;
        border-radius: 10px;
        background: white;
        box-shadow: 0 3px 12px rgba(30, 60, 40, .025);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 18px rgba(30, 60, 40, .07);
    }

    .stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        color: #6d7a71;
        font-size: 12px;
        font-weight: 600;
    }

    .stat-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 8px;
        background: #e7f4eb;
        color: #176b43;
        font-size: 16px;
    }

    .stat-number { margin-top: 10px; font-size: 24px; font-weight: bold; color: #26382f; }
    .stat-note { margin-top: 4px; color: #78857c; font-size: 11px; }

    .chart-grid {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: 14px;
        margin-top: 18px;
    }

    .chart-card {
        min-width: 0;
        padding: 18px;
        border: 1px solid #e1e9e3;
        border-radius: 10px;
        background: white;
        box-shadow: 0 3px 12px rgba(30, 60, 40, .025);
    }

    .chart-heading { margin-bottom: 13px; }
    .chart-heading h3 { margin: 0; font-size: 14px; font-weight: 700; }
    .chart-heading p { margin: 5px 0 0; color: #78857c; font-size: 11px; }

    .chart-container {
        position: relative;
        width: 100%;
        height: 220px;
    }

    .panel, .simple-card {
        overflow: hidden;
        border: 1px solid #e1e9e3;
        border-radius: 10px;
        background: white;
        box-shadow: 0 3px 12px rgba(30, 60, 40, .025);
    }

    .panel-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 18px;
        border-bottom: 1px solid #e8eee9;
    }

    .panel-heading h2 { margin: 0; font-size: 14px; font-weight: 700; }
    .table-wrap { overflow-x: auto; }

    .dashboard-table { width: 100%; border-collapse: collapse; font-size: 12px; }
    .dashboard-table th, .dashboard-table td { padding: 12px 16px; border-bottom: 1px solid #edf1ee; text-align: left; white-space: nowrap; }
    .dashboard-table th { background: #f8faf8; color: #647168; font-weight: 600; }

    .status {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        background: #fff2d8;
        color: #946200;
        font-size: 11px;
        font-weight: 600;
    }

    .status-diproses { background: #e5efff; color: #245ab1; }
    .status-selesai { background: #e2f5e8; color: #176b43; }
    .status-ditolak { background: #fde8e7; color: #ad302b; }

    .empty { padding: 32px 15px; color: #78857c; font-size: 13px; text-align: center; }
    .empty i { display: block; margin-bottom: 8px; font-size: 28px; }

    .help-panel {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 16px;
        margin-top: 18px;
        border: 1px solid #dcece0;
        border-radius: 10px;
        background: #eef7f0;
    }

    .help-icon { color: #176b43; font-size: 20px; }
    .help-panel h3 { margin: 0 0 5px; font-size: 13px; font-weight: 700; }
    .help-panel p { margin: 0; color: #627267; font-size: 12px; line-height: 1.5; }

    .simple-card { padding: 20px; }

    @media (max-width: 900px) {
        .chart-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 650px) {
        .welcome { padding: 19px; }
        .welcome h1 { font-size: 18px; }
        .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
    }
</style>
@endpush

@section('content')
    @if ($role === 'uptd')
        <section class="welcome">
            <h1>Selamat Datang, {{ auth()->user()->name }}!</h1>
            <p>
                Ringkasan laporan dan kondisi TPS untuk wilayah kerja
                {{ auth()->user()->wilayah->nama_wilayah ?? 'belum ditentukan' }}.
            </p>
        </section>

        <div class="section-heading"><h2>Ringkasan Laporan Wilayah</h2></div>

        <section class="stats">
            <div class="stat-card">
                <div class="stat-top"><span>Total Laporan</span><span class="stat-icon"><i class="bi bi-file-text"></i></span></div>
                <div class="stat-number">{{ $totalLaporan }}</div>
                <div class="stat-note">Laporan di wilayah kerja</div>
            </div>
            <div class="stat-card">
                <div class="stat-top"><span>Menunggu</span><span class="stat-icon"><i class="bi bi-clock-history"></i></span></div>
                <div class="stat-number">{{ $laporanMenunggu }}</div>
                <div class="stat-note">Menunggu pemeriksaan</div>
            </div>
            <div class="stat-card">
                <div class="stat-top"><span>Diproses</span><span class="stat-icon"><i class="bi bi-arrow-repeat"></i></span></div>
                <div class="stat-number">{{ $laporanDiproses }}</div>
                <div class="stat-note">Sedang ditindaklanjuti</div>
            </div>
            <div class="stat-card">
                <div class="stat-top"><span>Selesai</span><span class="stat-icon"><i class="bi bi-check-circle"></i></span></div>
                <div class="stat-number">{{ $laporanSelesai }}</div>
                <div class="stat-note">Laporan selesai</div>
            </div>
        </section>

        <section class="chart-grid">
            <div class="chart-card">
                <div class="chart-heading">
                    <h3>Tren Laporan</h3>
                    <p>Jumlah laporan selama 7 hari terakhir</p>
                </div>
                <div class="chart-container">
                    <canvas id="grafikTren"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <div class="chart-heading">
                    <h3>Status Laporan</h3>
                    <p>Perbandingan status laporan wilayah</p>
                </div>
                <div class="chart-container">
                    <canvas id="grafikStatus"></canvas>
                </div>
            </div>
        </section>

        <section class="panel" style="margin-top: 24px;">
            <div class="panel-heading"><h2>Laporan Terbaru di Wilayah</h2></div>
            @if ($laporanTerbaru->isEmpty())
                <div class="empty">
                    <i class="bi bi-inbox"></i>
                    <strong>Belum ada laporan</strong>
                    <p>Belum ada laporan yang tercatat pada TPS di wilayah kerja ini.</p>
                </div>
            @else
                <div class="table-wrap">
                    <table class="dashboard-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama TPS</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($laporanTerbaru as $laporan)
                            @php
                                $status = $laporan->status_laporan;
                                $statusClass = match ($status) {
                                    'selesai' => 'status-selesai',
                                    'diproses', 'ditangani' => 'status-diproses',
                                    'ditolak' => 'status-ditolak',
                                    default => '',
                                };
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $laporan->tps->nama_tps ?? 'TPS tidak tersedia' }}</td>
                                <td>{{ $laporan->kategori_kondisi }}</td>
                                <td>{{ $laporan->waktu_pelaporan?->format('d-m-Y') ?? '-' }}</td>
                                <td><span class="status {{ $statusClass }}">{{ ucfirst($status) }}</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

        <section class="help-panel">
            <i class="bi bi-info-circle help-icon"></i>
            <div>
                <h3>Informasi Wilayah Kerja</h3>
                <p>Data pada dashboard ini dibatasi berdasarkan wilayah yang terhubung dengan akun UPTD Anda.</p>
            </div>
        </section>
    @else
        <section class="welcome">
            <h1>Selamat Datang, {{ auth()->user()->name }}!</h1>
            <p>Anda berhasil masuk ke Sistem Pengaduan dan Monitoring TPS Sampah Kabupaten Indramayu.</p>
        </section>
        <section class="simple-card">
            <h2 style="margin-top: 0;">Dashboard {{ $roleLabel }}</h2>
            <p>Halaman ini akan menampilkan fitur sesuai hak akses {{ strtolower($roleLabel) }}.</p>
        </section>
    @endif
@endsection

@push('scripts')
@if ($role === 'uptd')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const trenCanvas = document.getElementById('grafikTren');

    if (trenCanvas) {
        new Chart(trenCanvas, {
            type: 'bar',
            data: {
                labels: @json($grafikTrenLabel),
                datasets: [{
                    label: 'Jumlah Laporan',
                    data: @json($grafikTrenData),
                    backgroundColor: '#2c8058',
                    borderRadius: 5,
                    maxBarThickness: 35
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 },
                        grid: { color: '#edf1ee' }
                    },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    const statusCanvas = document.getElementById('grafikStatus');

    if (statusCanvas) {
        new Chart(statusCanvas, {
            type: 'doughnut',
            data: {
                labels: ['Menunggu', 'Diproses', 'Selesai'],
                datasets: [{
                    data: @json($grafikStatus),
                    backgroundColor: ['#b7d9c3', '#2c8058', '#176b43'],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 7,
                            padding: 15,
                            font: { size: 11 }
                        }
                    }
                }
            }
        });
    }
</script>
@endif
@endpush