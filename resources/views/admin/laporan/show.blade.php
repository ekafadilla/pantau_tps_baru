@extends('layouts.admin')

@section('title', 'Detail Laporan #' . $laporan->id)
@section('page-title', 'Detail Laporan')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <div>
        <h4 class="fw-bold mb-1">Detail Laporan #{{ $laporan->id }}</h4>
        <p class="text-secondary mb-0">
            Informasi lengkap laporan masyarakat dan riwayat penanganan.
        </p>
    </div>

    <div class="d-flex gap-2">
        <button type="button" onclick="window.print()" class="btn btn-outline-secondary">
            <i class="bi bi-printer"></i> Cetak Laporan
        </button>
        <a href="{{ route('admin.laporan.index') }}" class="btn btn-outline-success">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>

@php
    $kelasStatus = match ($laporan->status_laporan) {
        'selesai' => 'selesai',
        'ditolak' => 'ditolak',
        'diproses', 'ditangani', 'ditugaskan', 'sedang_dikerjakan' => 'diproses',
        'diverifikasi' => 'diverifikasi',
        default => 'menunggu',
    };
@endphp

<!-- 1. INFORMASI LAPORAN UTAMA -->
<div class="panel mb-4">
    <div class="panel-heading d-flex justify-content-between align-items-center">
        <span>Informasi Laporan Masyarakat</span>
        <span class="status {{ $kelasStatus }}">
            Status: {{ ucfirst(str_replace('_', ' ', $laporan->status_laporan)) }}
        </span>
    </div>
    <div class="p-4">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="text-secondary small mb-1">Nama Pelapor</div>
                <div class="fw-semibold">{{ $laporan->pengguna->name ?? '-' }}</div>
            </div>

            <div class="col-md-6">
                <div class="text-secondary small mb-1">Email Pelapor</div>
                <div class="fw-semibold">{{ $laporan->pengguna->email ?? '-' }}</div>
            </div>

            <div class="col-md-6">
                <div class="text-secondary small mb-1">Tempat Penampungan (TPS)</div>
                <div class="fw-semibold">{{ $laporan->tps->nama_tps ?? '-' }}</div>
                @if ($laporan->tps)
                    <small>
                        <a href="{{ route('admin.tps.show', $laporan->tps->id) }}" class="text-success text-decoration-none">
                            Lihat Profil TPS &rarr;
                        </a>
                    </small>
                @endif
            </div>

            <div class="col-md-6">
                <div class="text-secondary small mb-1">Wilayah UPTD</div>
                <div class="fw-semibold">
                    {{ $laporan->tps->wilayah->nama_wilayah ?? '-' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="text-secondary small mb-1">Kategori Kondisi</div>
                <div class="fw-semibold">{{ ucfirst($laporan->kategori_kondisi) }}</div>
            </div>

            <div class="col-md-6">
                <div class="text-secondary small mb-1">Waktu Pelaporan</div>
                <div class="fw-semibold">
                    {{ $laporan->waktu_pelaporan ? $laporan->waktu_pelaporan->format('d-m-Y H:i') : '-' }} WIB
                </div>
            </div>

            <div class="col-12">
                <div class="text-secondary small mb-1">Detail Lokasi / Patokan</div>
                <div>{{ $laporan->lokasi ?: ($laporan->tps->alamat ?? '-') }}</div>
            </div>

            <div class="col-12">
                <div class="text-secondary small mb-1">Keterangan / Keluhan</div>
                <div class="p-3 bg-light rounded" style="white-space: pre-line;">{{ $laporan->keterangan ?: '-' }}</div>
            </div>
        </div>
    </div>
</div>

<!-- 2. INFORMASI PENUGASAN LAPANGAN (JIKA ADA DISPOSISI UPTD) -->
@if ($laporan->tingkat_urgensi || $laporan->id_supir || $laporan->id_armada || $laporan->instruksi_penanganan)
<div class="panel mb-4">
    <div class="panel-heading">
        Informasi Disposisi & Penugasan UPTD
    </div>
    <div class="p-4">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-secondary small mb-1">Tingkat Urgensi</div>
                <div>
                    @php
                        $badgeUrgensi = match (strtolower($laporan->tingkat_urgensi ?? '')) {
                            'sangat tinggi' => 'bg-danger text-white',
                            'tinggi' => 'bg-warning text-dark',
                            'sedang' => 'bg-info text-dark',
                            default => 'bg-secondary text-white',
                        };
                    @endphp
                    <span class="badge {{ $badgeUrgensi }} px-3 py-2">
                        {{ ucfirst($laporan->tingkat_urgensi ?? 'Belum ditentukan') }}
                    </span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="text-secondary small mb-1">Petugas Supir Pengangkut</div>
                <div class="fw-semibold">
                    {{ $laporan->supir->name ?? 'Belum ditugaskan' }}
                </div>
                @if ($laporan->supir)
                    <small class="text-secondary">{{ $laporan->supir->email }}</small>
                @endif
            </div>

            <div class="col-md-4">
                <div class="text-secondary small mb-1">Armada Pengangkutan</div>
                <div class="fw-semibold">
                    {{ $laporan->armada->kode_armada ?? 'Belum ditentukan' }}
                </div>
                @if ($laporan->armada)
                    <small class="text-secondary">
                        {{ $laporan->armada->jenis_armada }} ({{ $laporan->armada->nomor_polisi ?? '-' }})
                    </small>
                @endif
            </div>

            @if ($laporan->target_waktu)
                <div class="col-md-6">
                    <div class="text-secondary small mb-1">Target Batas Waktu Penanganan</div>
                    <div>{{ \Carbon\Carbon::parse($laporan->target_waktu)->format('d-m-Y H:i') }} WIB</div>
                </div>
            @endif

            @if ($laporan->waktu_mulai)
                <div class="col-md-6">
                    <div class="text-secondary small mb-1">Waktu Mulai Pengerjaan</div>
                    <div>{{ \Carbon\Carbon::parse($laporan->waktu_mulai)->format('d-m-Y H:i') }} WIB</div>
                </div>
            @endif

            @if ($laporan->instruksi_penanganan)
                <div class="col-12">
                    <div class="text-secondary small mb-1">Instruksi Penanganan dari UPTD</div>
                    <div class="p-3 bg-light rounded" style="white-space: pre-line;">{{ $laporan->instruksi_penanganan }}</div>
                </div>
            @endif
        </div>
    </div>
</div>
@endif

<!-- 3. FOTO DARI MASYARAKAT -->
<div class="panel mb-4">
    <div class="panel-heading d-flex justify-content-between align-items-center">
        <span>Foto Kondisi TPS (Bukti Pelapor)</span>
        <span class="badge text-bg-light border">{{ $laporan->fotoLaporans->count() }} Foto</span>
    </div>
    <div class="p-4">
        @if ($laporan->fotoLaporans->isNotEmpty())
            <div class="row g-3">
                @foreach ($laporan->fotoLaporans as $foto)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="border rounded p-2 text-center bg-light">
                            <a href="{{ \Illuminate\Support\Facades\Storage::url($foto->path_foto) }}" target="_blank" rel="noopener">
                                <img
                                    src="{{ \Illuminate\Support\Facades\Storage::url($foto->path_foto) }}"
                                    alt="Foto laporan"
                                    class="img-fluid rounded border mb-2"
                                    style="width: 100%; height: 220px; object-fit: cover;"
                                >
                            </a>
                            <div class="small text-secondary text-truncate" title="{{ $foto->nama_file }}">
                                {{ $foto->nama_file }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-secondary mb-0">Tidak ada lampiran foto pada laporan ini.</p>
        @endif
    </div>
</div>

<!-- 4. FOTO BUKTI PENANGANAN (DARI SUPIR LAPANGAN) -->
@if ($laporan->buktiPenanganans->isNotEmpty())
<div class="panel mb-4">
    <div class="panel-heading d-flex justify-content-between align-items-center bg-success-subtle text-success-emphasis">
        <span class="fw-bold"><i class="bi bi-check2-circle me-1"></i> Bukti Penanganan Selesai (Petugas Supir)</span>
        <span class="badge bg-success">{{ $laporan->buktiPenanganans->count() }} Bukti</span>
    </div>
    <div class="p-4">
        <div class="row g-3">
            @foreach ($laporan->buktiPenanganans as $bukti)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="border rounded p-3 bg-light">
                        <a href="{{ \Illuminate\Support\Facades\Storage::url($bukti->foto_path) }}" target="_blank" rel="noopener">
                            <img
                                src="{{ \Illuminate\Support\Facades\Storage::url($bukti->foto_path) }}"
                                alt="Foto Bukti Penanganan"
                                class="img-fluid rounded border mb-2"
                                style="width: 100%; height: 220px; object-fit: cover;"
                            >
                        </a>
                        <div class="fw-semibold small text-success">
                            Pengirim: {{ $bukti->supir->name ?? 'Petugas Supir' }}
                        </div>
                        <div class="small text-secondary mb-1">
                            Waktu: {{ $bukti->waktu_pengiriman?->format('d-m-Y H:i') ?? '-' }} WIB
                        </div>
                        <div class="small text-dark mt-2 border-top pt-2">
                            <strong>Keterangan:</strong> {{ $bukti->keterangan }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- 5. RIWAYAT PERUBAHAN STATUS & TINDAK LANJUT -->
<div class="panel">
    <div class="panel-heading">
        Riwayat Status & Jejak Tindak Lanjut
    </div>
    <div class="p-4">
        @if ($laporan->riwayatStatuses->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No.</th>
                            <th>Waktu Perubahan</th>
                            <th>Status Baru</th>
                            <th>Petugas / Aktor</th>
                            <th>Catatan Tindak Lanjut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporan->riwayatStatuses->sortByDesc('waktu_perubahan') as $riwayat)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $riwayat->waktu_perubahan?->format('d-m-Y H:i') ?? '-' }} WIB</td>
                                <td>
                                    @php
                                        $classR = match ($riwayat->status_baru) {
                                            'selesai' => 'selesai',
                                            'ditolak' => 'ditolak',
                                            'diproses', 'ditangani', 'ditugaskan', 'sedang_dikerjakan' => 'diproses',
                                            'diverifikasi' => 'diverifikasi',
                                            default => 'menunggu',
                                        };
                                    @endphp
                                    <span class="status {{ $classR }}">
                                        {{ ucfirst(str_replace('_', ' ', $riwayat->status_baru)) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $riwayat->pengguna->name ?? '-' }}</div>
                                    <small class="text-secondary">{{ ucfirst($riwayat->pengguna->role ?? '') }}</small>
                                </td>
                                <td>{{ $riwayat->catatan ?: '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-secondary mb-0">Belum ada riwayat status yang tercatat.</p>
        @endif
    </div>
</div>
@endsection
