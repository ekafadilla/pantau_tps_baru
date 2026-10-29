
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Edit Landing Page</h4>
            <p class="text-muted mb-0">Atur teks yang ditampilkan pada halaman utama SI Pantau TPS.</p>
        </div>
        <a href="{{ route('landing') }}" target="_blank" class="btn btn-outline-success">
            Lihat Landing Page
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali input berikut:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.landing.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Bagian Utama</h5>

                <div class="mb-3">
                    <label for="judul_hero" class="form-label">Judul utama</label>
                    <input type="text" id="judul_hero" name="judul_hero"
                        class="form-control" maxlength="255" required
                        value="{{ old('judul_hero', $pengaturan['judul_hero']) }}">
                </div>

                <div class="mb-3">
                    <label for="deskripsi_hero" class="form-label">Deskripsi utama</label>
                    <textarea id="deskripsi_hero" name="deskripsi_hero"
                        class="form-control" rows="4" maxlength="2000" required>{{ old('deskripsi_hero', $pengaturan['deskripsi_hero']) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="judul_tombol_tps" class="form-label">Teks tombol TPS</label>
                        <input type="text" id="judul_tombol_tps" name="judul_tombol_tps"
                            class="form-control" maxlength="100" required
                            value="{{ old('judul_tombol_tps', $pengaturan['judul_tombol_tps']) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="judul_tombol_laporan" class="form-label">Teks tombol laporan</label>
                        <input type="text" id="judul_tombol_laporan" name="judul_tombol_laporan"
                            class="form-control" maxlength="100" required
                            value="{{ old('judul_tombol_laporan', $pengaturan['judul_tombol_laporan']) }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Bagian Layanan</h5>

                <div class="mb-3">
                    <label for="judul_layanan" class="form-label">Judul layanan</label>
                    <input type="text" id="judul_layanan" name="judul_layanan"
                        class="form-control" maxlength="255" required
                        value="{{ old('judul_layanan', $pengaturan['judul_layanan']) }}">
                </div>

                <div class="mb-3">
                    <label for="deskripsi_layanan" class="form-label">Deskripsi layanan</label>
                    <textarea id="deskripsi_layanan" name="deskripsi_layanan"
                        class="form-control" rows="4" maxlength="2000" required>{{ old('deskripsi_layanan', $pengaturan['deskripsi_layanan']) }}</textarea>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Bagian Footer</h5>

                <div class="mb-3">
                    <label for="teks_footer" class="form-label">Teks footer</label>
                    <textarea id="teks_footer" name="teks_footer"
                        class="form-control" rows="3" maxlength="2000" required>{{ old('teks_footer', $pengaturan['teks_footer']) }}</textarea>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mb-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-light border">Batal</a>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
