
@extends('layouts.supir')

@section('page-title', 'Detail & Progres Tugas')

@section('content')

@php
    $status = $tugas->status_laporan;

    $statusLabels = [
        'ditugaskan' => 'Tugas Baru',
        'sedang_dikerjakan' => 'Dalam Penanganan',
        'perlu_perbaikan' => 'Perlu Perbaikan',
        'menunggu_pemeriksaan' => 'Menunggu Pemeriksaan',
        'selesai' => 'Selesai',
        'ditolak' => 'Ditolak',
    ];

    $statusClass = match($status) {
        'ditugaskan' => 'status-baru',
        'sedang_dikerjakan' => 'status-proses',
        'perlu_perbaikan' => 'status-perbaikan',
        'menunggu_pemeriksaan' => 'status-periksa',
        'selesai' => 'status-selesai',
        'ditolak' => 'status-ditolak',
        default => 'status-baru',
    };

    $urgensi = $tugas->tingkat_urgensi;

    $urgensiLabels = [
        'sangat_tinggi' => 'Sangat Tinggi',
        'tinggi' => 'Tinggi',
        'sedang' => 'Sedang',
        'rendah' => 'Rendah',
    ];

    $urgensiClass = match($urgensi) {
        'sangat_tinggi', 'tinggi' => 'urgensi-tinggi',
        'sedang' => 'urgensi-sedang',
        'rendah' => 'urgensi-rendah',
        default => 'urgensi-default',
    };

    $lat = $tugas->tps?->latitude;
    $lng = $tugas->tps?->longitude;

    $mapUrl = null;
    $mapLink = null;

    if ($lat !== null && $lng !== null) {
        $lat = (float) $lat;
        $lng = (float) $lng;

        $bbox = implode(',', [
            $lng - 0.005,
            $lat - 0.004,
            $lng + 0.005,
            $lat + 0.004,
        ]);

        $mapUrl = "https://www.openstreetmap.org/export/embed.html?bbox={$bbox}&layer=mapnik&marker={$lat},{$lng}";
        $mapLink = "https://www.google.com/maps?q={$lat},{$lng}";
    }

    $kodeLaporan = '#LAP-' . str_pad(
        $tugas->id,
        5,
        '0',
        STR_PAD_LEFT
    );

    $sudahMulai = !empty($tugas->waktu_mulai);

    $bisaProses = $status === 'sedang_dikerjakan';
@endphp

<style>
    .detail-page {
        color: #183d30;
    }

    .detail-breadcrumb {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 15px;
    }

    .detail-breadcrumb small {
        color: #718078;
        font-size: 11px;
    }

    .detail-breadcrumb a {
        font-size: 11px;
        color: #176b43;
    }

    .detail-heading {
        margin-bottom: 17px;
    }

    .detail-heading h4 {
        font-size: 20px;
        font-weight: 700;
        margin: 0 0 7px;
    }

    .detail-tag {
        display: inline-block;
        font-size: 10px;
        border-radius: 20px;
        padding: 5px 10px;
        margin-right: 5px;
    }

    .status-baru {
        background: #dff4e5;
        color: #176b43;
    }

    .status-proses {
        background: #cceedd;
        color: #145a3d;
    }

    .status-perbaikan {
        background: #fff0c9;
        color: #8a5b10;
    }

    .status-periksa {
        background: #dceef8;
        color: #28627e;
    }

    .status-selesai {
        background: #dff4e5;
        color: #176b43;
    }

    .status-ditolak {
        background: #ffe0df;
        color: #a52b2b;
    }

    .urgensi-tinggi {
        background: #ffe1df;
        color: #aa2929;
    }

    .urgensi-sedang {
        background: #fff0cd;
        color: #805c12;
    }

    .urgensi-rendah {
        background: #def3e4;
        color: #176b43;
    }

    .urgensi-default {
        background: #edf1ed;
        color: #617067;
    }

    .detail-card {
        background: white;
        border: 1px solid #e4eee7;
        border-radius: 10px;
        padding: 17px;
        margin-bottom: 15px;
    }

    .execution-card {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        padding: 18px;
    }

    .execution-left {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .execution-icon {
        width: 42px;
        height: 42px;
        border-radius: 9px;
        background: #e4f4e9;
        color: #176b43;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .execution-left small {
        display: block;
        font-size: 10px;
        color: #718078;
        margin-bottom: 4px;
    }

    .execution-left strong {
        font-size: 12px;
        display: block;
    }

    .execution-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
    }

    .execution-actions .btn {
        font-size: 10px;
        padding: 8px 11px;
    }

    .detail-section-title {
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .detail-section-title small {
        display: block;
        font-size: 9px;
        font-weight: 400;
        color: #78877e;
        margin-top: 3px;
    }

    .ticket-code {
        font-size: 14px;
        font-weight: 700;
    }

    .deadline {
        color: #b52d2d;
        font-size: 11px;
        font-weight: 700;
    }

    .location-panel {
        border-radius: 8px;
        background: #e7f5ed;
        padding: 12px;
        margin-top: 12px;
        margin-bottom: 13px;
    }

    .location-panel strong {
        font-size: 11px;
    }

    .location-panel p {
        font-size: 10px;
        color: #526b5b;
        margin: 5px 0;
    }

    .coordinate {
        font-size: 9px;
        color: #47765b;
    }

    .map-frame {
        width: 100%;
        height: 175px;
        border: 0;
        border-radius: 7px;
        display: block;
        margin-top: 8px;
    }

    .map-placeholder {
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        background: #dceee2;
        color: #54715d;
        border-radius: 7px;
        font-size: 11px;
        padding: 15px;
        margin-top: 8px;
    }

    .description-box {
        background: #e8f6ee;
        border-radius: 8px;
        padding: 13px;
        font-size: 11px;
        line-height: 1.6;
        color: #405b4a;
        white-space: pre-line;
    }

    .photo-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .photo-item {
        border: 1px solid #e5eee7;
        border-radius: 8px;
        overflow: hidden;
        background: #f7faf7;
    }

    .photo-item img {
        display: block;
        width: 100%;
        height: 140px;
        object-fit: cover;
    }

    .photo-caption {
        padding: 8px;
        font-size: 10px;
        color: #52685b;
    }

    .instruction-box {
        padding: 13px;
        background: #e3f5ef;
        border-radius: 8px;
        font-size: 10px;
        line-height: 1.6;
        color: #42604f;
        white-space: pre-line;
    }

    .armada-info {
        background: #edf5ef;
        border-radius: 8px;
        padding: 13px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .armada-info strong {
        font-size: 11px;
    }

    .armada-info small {
        display: block;
        font-size: 9px;
        color: #718078;
        margin-top: 4px;
    }

    .progress-form label {
        font-size: 10px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .progress-form .form-control {
        font-size: 11px;
        border-color: #dfeae2;
        background: #f7faf8;
    }

    .progress-form textarea {
        min-height: 105px;
        resize: vertical;
    }

    .progress-form .form-text {
        font-size: 9px;
    }

    .progress-button {
        background: #073e32;
        border-color: #073e32;
        color: white;
        font-size: 11px;
        font-weight: 600;
        width: 100%;
        padding: 10px;
    }

    .progress-button:hover {
        background: #176b43;
        color: white;
    }

    .evidence-history {
        border: 1px solid #e5eee7;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 10px;
    }

    .evidence-history img {
        width: 100%;
        max-height: 160px;
        object-fit: cover;
        display: block;
    }

    .evidence-info {
        padding: 10px;
        font-size: 10px;
        background: #f6faf7;
    }

    .evidence-info p {
        margin: 5px 0;
        color: #53685a;
        white-space: pre-line;
    }

    .status-message {
        background: #e9f5ed;
        border-radius: 8px;
        padding: 13px;
        font-size: 11px;
        color: #42614e;
        line-height: 1.6;
    }

    .route-info {
        background: #e8f5ec;
        border-radius: 9px;
        padding: 15px;
        display: flex;
        gap: 12px;
        align-items: center;
        font-size: 10px;
        color: #536b5a;
    }

    .route-info i {
        font-size: 21px;
        color: #176b43;
    }

    @media(max-width: 768px) {
        .execution-card {
            align-items: flex-start;
        }

        .execution-actions {
            width: 100%;
        }

        .execution-actions form,
        .execution-actions button {
            flex: 1;
        }

        .photo-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="detail-page">

    {{-- BREADCRUMB --}}
    <div class="detail-breadcrumb">
        <small>
            <a href="{{ route('supir.dashboard') }}">Dashboard</a>
            /
            <a href="{{ route('supir.tugas.index') }}">Tugas Penanganan</a>
            /
            {{ $kodeLaporan }}
        </small>

        <a href="{{ route('supir.tugas.index') }}"
           class="btn btn-light btn-sm">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Daftar Tugas
        </a>
    </div>

    {{-- JUDUL DETAIL --}}
    <div class="detail-heading">

        <h4>
            {{ $tugas->tps->nama_tps
                ?? $tugas->lokasi
                ?? 'Detail Tugas Penanganan' }}
        </h4>

        <span class="detail-tag {{ $statusClass }}">
            <i class="bi bi-circle-fill"></i>
            {{ $statusLabels[$status] ?? ucfirst(str_replace('_', ' ', $status)) }}
        </span>

        <span class="detail-tag {{ $urgensiClass }}">
            <i class="bi bi-exclamation-triangle"></i>
            Urgensi:
            {{ $urgensiLabels[$urgensi] ?? 'Belum ditentukan' }}
        </span>

    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert alert-success py-2 small">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger py-2 small">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger small">
            <strong>Periksa kembali data yang dikirim:</strong>
            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- STATUS EKSEKUSI DAN TOMBOL --}}
    <div class="detail-card execution-card">

        <div class="execution-left">
            <div class="execution-icon">
                <i class="bi bi-truck"></i>
            </div>

            <div>
                <small>STATUS EKSEKUSI ARMADA</small>

                <strong>
                    {{ $tugas->armada->kode_armada ?? 'Armada belum ditentukan' }}
                    siap melakukan penanganan laporan.
                </strong>

                <small class="mt-1">
                    @if($tugas->waktu_mulai)
                        Dimulai pukul:
                        {{ \Carbon\Carbon::parse($tugas->waktu_mulai)->format('H:i') }} WIB
                    @else
                        Penanganan belum dimulai.
                    @endif
                </small>
            </div>
        </div>

        <div class="execution-actions">

            @if(in_array($status, ['ditugaskan', 'perlu_perbaikan'], true))

                <form method="POST"
                      action="{{ route('supir.tugas.mulai', $tugas->id) }}">
                    @csrf

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-play-circle"></i>
                        Mulai Penanganan
                    </button>
                </form>

            @elseif($status === 'sedang_dikerjakan')

                <span class="btn btn-outline-success disabled">
                    <i class="bi bi-check-circle"></i>
                    Penanganan Berlangsung
                </span>

            @elseif($status === 'menunggu_pemeriksaan')

                <span class="btn btn-info btn-sm disabled">
                    Menunggu Pemeriksaan
                </span>

            @else

                <span class="btn btn-outline-secondary btn-sm disabled">
                    {{ $statusLabels[$status] ?? 'Status Tugas' }}
                </span>

            @endif

        </div>

    </div>

    {{-- KONTEN DUA KOLOM --}}
    <div class="row g-3">

        {{-- KOLOM KIRI --}}
        <div class="col-12 col-lg-7">

            <div class="detail-card">

                {{-- IDENTITAS TIKET --}}
                <div class="d-flex justify-content-between
                            align-items-start gap-2 flex-wrap">

                    <div>
                        <small class="text-muted">
                            IDENTIFIKASI TIKET TUGAS
                        </small>

                        <div class="ticket-code">
                            {{ $kodeLaporan }}
                        </div>

                        <small class="text-muted">
                            ID Laporan: {{ $tugas->id }}
                        </small>
                    </div>

                    <div class="text-end">
                        <small class="text-muted d-block">
                            Target Penyelesaian
                        </small>

                        <span class="deadline">
                            @if($tugas->target_waktu)
                                {{ \Carbon\Carbon::parse($tugas->target_waktu)->format('d M Y - H:i') }}
                                WIB
                            @else
                                Belum ditentukan
                            @endif
                        </span>
                    </div>

                </div>

                {{-- LOKASI TPS --}}
                <div class="location-panel">

                    <strong>
                        <i class="bi bi-geo-alt"></i>
                        {{ $tugas->tps->nama_tps ?? 'Lokasi TPS' }}
                    </strong>

                    <p>
                        {{ $tugas->tps->alamat ?? $tugas->lokasi ?? 'Alamat belum tersedia' }}
                    </p>

                    @if($lat !== null && $lng !== null)
                        <div class="coordinate">
                            Koordinat: {{ $lat }}, {{ $lng }}
                        </div>

                        <iframe
                            src="{{ $mapUrl }}"
                            class="map-frame"
                            loading="lazy"
                            title="Peta lokasi TPS">
                        </iframe>

                        <a href="{{ $mapLink }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="small text-success mt-2 d-inline-block">
                            <i class="bi bi-map"></i>
                            Buka lokasi di Google Maps
                        </a>
                    @else
                        <div class="map-placeholder">
                            <div>
                                <i class="bi bi-map fs-3 d-block mb-2"></i>
                                Koordinat TPS belum tersedia.
                            </div>
                        </div>
                    @endif

                </div>

                {{-- DESKRIPSI LAPORAN --}}
                <div class="mb-3">
                    <div class="detail-section-title">
                        <i class="bi bi-chat-left-text"></i>
                        Deskripsi Pengaduan Warga
                    </div>

                    <div class="description-box">
                        {{ $tugas->keterangan ?: 'Tidak ada deskripsi pengaduan.' }}
                    </div>
                </div>

                {{-- FOTO PENGADUAN AWAL --}}
                <div class="mb-3">

                    <div class="detail-section-title">
                        <i class="bi bi-images"></i>
                        Foto Bukti Pengaduan Awal
                        <small>Foto yang dikirim oleh pelapor.</small>
                    </div>

                    @if($tugas->fotoLaporans->isNotEmpty())

                        <div class="photo-grid">

                            @foreach($tugas->fotoLaporans as $foto)

                                <div class="photo-item">

                                    <a href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($foto->path_foto) }}"
                                       target="_blank">
                                        <img
                                            src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($foto->path_foto) }}"
                                            alt="{{ $foto->nama_file ?? 'Foto laporan' }}">
                                    </a>

                                    <div class="photo-caption">
                                        {{ $foto->nama_file ?? 'Foto pengaduan' }}
                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="status-message">
                            Belum ada foto bukti pengaduan awal.
                        </div>

                    @endif

                </div>

                {{-- INSTRUKSI PENANGANAN --}}
                <div class="mb-3">

                    <div class="detail-section-title">
                        <i class="bi bi-info-circle"></i>
                        Instruksi Penanganan
                    </div>

                    <div class="instruction-box">
                        {{ $tugas->instruksi_penanganan
                            ?: 'Belum ada instruksi khusus dari petugas.' }}
                    </div>

                </div>

                {{-- INFORMASI ARMADA DAN SUPIR --}}
                <div class="armada-info">

                    <div>
                        <strong>
                            <i class="bi bi-truck"></i>
                            {{ $tugas->armada->kode_armada ?? 'Armada belum tersedia' }}
                        </strong>

                        <small>
                            No. Polisi:
                            {{ $tugas->armada->nomor_polisi ?? '-' }}
                        </small>

                        <small>
                            Jenis Armada:
                            {{ $tugas->armada->jenis_armada ?? '-' }}
                        </small>
                    </div>

                    <div>
                        <strong>
                            <i class="bi bi-person"></i>
                            Supir: {{ auth()->user()->name }}
                        </strong>

                        <small>
                            ID Supir: {{ auth()->id() }}
                        </small>
                    </div>

                </div>

            </div>

        </div>

        {{-- KOLOM KANAN --}}
        <div class="col-12 col-lg-5">

            {{-- FORM PROGRES --}}
            <div class="detail-card">

                <div class="d-flex justify-content-between
                            align-items-center gap-2 mb-3">

                    <div>
                        <h6 class="fw-bold mb-1">
                            <i class="bi bi-clipboard-check"></i>
                            Formulir Progres Supir
                        </h6>

                        <small class="text-muted">
                            Perbarui perkembangan penanganan TPS.
                        </small>
                    </div>

                    <span class="detail-tag {{ $statusClass }}">
                        {{ $statusLabels[$status] ?? $status }}
                    </span>

                </div>

                @if($bisaProses)

                    <form
                        action="{{ route('supir.tugas.progres', $tugas->id) }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="progress-form">

                        @csrf

                        <div class="mb-3">
                            <label>STATUS PENANGANAN OPERASIONAL</label>

                            <div class="description-box">
                                Dalam Penanganan / Sedang Diangkut
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan">
                                Catatan Pelaksanaan Lapangan
                                <span class="text-danger">*</span>
                            </label>

                            <textarea
                                name="keterangan"
                                id="keterangan"
                                class="form-control"
                                placeholder="Tuliskan perkembangan penanganan TPS..."
                                required>{{ old('keterangan') }}</textarea>

                            <div class="form-text">
                                Maksimal 1.000 karakter.
                            </div>

                            @error('keterangan')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="foto">
                                Unggah Foto Bukti Penanganan
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="file"
                                name="foto"
                                id="foto"
                                class="form-control"
                                accept="image/jpeg,image/png,image/webp"
                                required>

                            <div class="form-text">
                                Unggah foto kondisi setelah atau selama penanganan.
                                Format JPG, JPEG, PNG, atau WEBP. Maksimal 4 MB.
                            </div>

                            @error('foto')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn progress-button">
                            <i class="bi bi-cloud-arrow-up"></i>
                            Simpan Pembaruan Progres
                        </button>

                    </form>

                    <hr>

                    <form
                        action="{{ route('supir.tugas.selesai', $tugas->id) }}"
                        method="POST"
                        onsubmit="return confirm('Kirim tugas ini untuk pemeriksaan? Pastikan foto bukti penanganan sudah diunggah.')">

                        @csrf

                        <button type="submit"
                                class="btn btn-success w-100 btn-sm">
                            <i class="bi bi-check-circle"></i>
                            Selesaikan Penanganan
                        </button>

                    </form>

                    <small class="text-muted d-block mt-2">
                        Tugas akan berubah menjadi Menunggu Pemeriksaan,
                        bukan langsung dianggap selesai.
                    </small>

                @elseif(in_array($status, ['ditugaskan', 'perlu_perbaikan'], true))

                    <div class="status-message mb-3">
                        <strong>Penanganan belum dimulai.</strong>
                        <br>
                        Tekan tombol Mulai Penanganan di bagian atas
                        sebelum mengirim catatan progres dan foto bukti.
                    </div>

                @elseif($status === 'menunggu_pemeriksaan')

                    <div class="status-message">
                        <i class="bi bi-hourglass-split"></i>
                        <strong>Menunggu pemeriksaan.</strong>
                        <br>
                        Bukti penanganan sudah dikirim. Silakan menunggu
                        hasil pemeriksaan dari petugas.
                    </div>

                @elseif($status === 'selesai')

                    <div class="status-message">
                        <i class="bi bi-check-circle"></i>
                        <strong>Penanganan telah selesai.</strong>
                        <br>
                        Tugas ini telah diselesaikan dan tidak dapat
                        diperbarui lagi melalui halaman ini.
                    </div>

                @else

                    <div class="status-message">
                        Status tugas saat ini:
                        {{ $statusLabels[$status] ?? $status }}
                    </div>

                @endif

            </div>

            {{-- RIWAYAT FOTO BUKTI --}}
            <div class="detail-card">

                <div class="detail-section-title">
                    <i class="bi bi-camera"></i>
                    Foto Bukti Penanganan
                    <small>Dokumentasi yang sudah dikirim oleh supir.</small>
                </div>

                @forelse($tugas->buktiPenanganans as $bukti)

                    <div class="evidence-history">

                        <img
                            src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($bukti->foto_path) }}"
                            alt="Foto bukti penanganan">

                        <div class="evidence-info">

                            <strong>
                                <i class="bi bi-camera"></i>
                                Bukti Penanganan
                            </strong>

                            <small class="text-muted float-end">
                                {{ $bukti->waktu_pengiriman
                                    ? $bukti->waktu_pengiriman->format('d M Y, H:i')
                                    : '-' }}
                            </small>

                            <p>{{ $bukti->keterangan }}</p>

                            <small class="text-muted">
                                Dikirim oleh:
                                {{ $bukti->supir->name ?? 'Supir' }}
                            </small>

                        </div>

                    </div>

                @empty

                    <div class="status-message">
                        Belum ada foto bukti penanganan yang dikirim.
                    </div>

                @endforelse

            </div>

            {{-- INFORMASI RUTE --}}
            <div class="route-info">
                <i class="bi bi-sign-turn-right"></i>

                <div>
                    <strong>Informasi Lokasi TPS</strong>
                    <div>
                        @if($tugas->tps?->alamat)
                            {{ $tugas->tps->alamat }}
                        @else
                            Alamat TPS belum tersedia.
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
