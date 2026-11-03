@extends('layouts.uptd')

@section('title', 'Pengaturan Akun')
@section('page-title', 'Pengaturan Akun')

@section('content')
<style>
    .setting-page { color: #26382f; }
    .setting-heading { margin-bottom: 20px; }
    .setting-heading h2 { font-size: 21px; font-weight: 700; margin-bottom: 5px; }
    .setting-heading p { color: #7b8980; font-size: 12px; margin: 0; }

    .setting-card {
        background: #fff;
        border: 1px solid #e3ebe5;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
        box-shadow: 0 3px 12px rgba(25,70,43,.035);
    }

    .setting-card h5 {
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .setting-description {
        font-size: 11px;
        color: #849188;
        margin-bottom: 18px;
    }

    .setting-page .form-label {
        font-size: 12px;
        font-weight: 600;
        color: #53645a;
        margin-bottom: 7px;
    }

    .setting-page .form-control {
        min-height: 39px;
        border-radius: 8px;
        border-color: #dfe8e1;
        font-size: 12px;
        box-shadow: none;
    }

    .setting-page .form-control:focus {
        border-color: #70a987;
        box-shadow: 0 0 0 3px rgba(23,107,67,.08);
    }

    .setting-role {
        display: inline-block;
        background: #e7f3eb;
        color: #176b43;
        border-radius: 20px;
        padding: 6px 11px;
        font-size: 11px;
        font-weight: 700;
    }

    .setting-btn {
        background: #176b43;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 9px 15px;
        font-size: 12px;
        font-weight: 600;
    }

    .setting-btn:hover { background: #125735; color: white; }

    .setting-alert {
        border-radius: 9px;
        font-size: 12px;
        padding: 11px 14px;
    }

    @media(max-width:600px) {
        .setting-card { padding: 16px; }
    }
</style>

<div class="setting-page">
    <div class="setting-heading">
        <h2>Pengaturan Akun</h2>
        <p>Kelola informasi profil dan keamanan akun UPTD Anda.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success setting-alert">{{ session('success') }}</div>
    @endif

    @if(session('success_password'))
        <div class="alert alert-success setting-alert">{{ session('success_password') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger setting-alert">
            <strong>Periksa kembali data yang dimasukkan.</strong>
            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="setting-card">
        <h5><i class="bi bi-person-circle me-2" style="color:#176b43"></i>Informasi Profil</h5>
        <p class="setting-description">Perbarui nama dan alamat email akun Anda.</p>

        <form action="{{ route('uptd.pengaturan.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label" for="name">Nama UPTD / Pengguna</label>
                <input type="text" id="name" name="name" class="form-control"
                    value="{{ old('name', $user->name) }}" required maxlength="100">
            </div>

            <div class="mb-3">
                <label class="form-label" for="email">Alamat Email</label>
                <input type="email" id="email" name="email" class="form-control"
                    value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Jenis Akun</label>
                <span class="setting-role">UPTD</span>
                <small class="text-muted ms-2">Tidak dapat diubah.</small>
            </div>

            <button type="submit" class="setting-btn">
                <i class="bi bi-check2-circle me-1"></i> Simpan Perubahan
            </button>
        </form>
    </div>

    <div class="setting-card">
        <h5><i class="bi bi-shield-lock me-2" style="color:#176b43"></i>Keamanan Akun</h5>
        <p class="setting-description">Gunakan kata sandi yang kuat untuk menjaga keamanan akun.</p>

        <form action="{{ route('uptd.pengaturan.password') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label" for="password_lama">Kata Sandi Lama</label>
                <input type="password" id="password_lama" name="password_lama"
                    class="form-control" autocomplete="current-password" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="password">Kata Sandi Baru</label>
                <input type="password" id="password" name="password"
                    class="form-control" minlength="8" autocomplete="new-password" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                <input type="password" id="password_confirmation"
                    name="password_confirmation" class="form-control"
                    minlength="8" autocomplete="new-password" required>
            </div>

            <button type="submit" class="setting-btn">
                <i class="bi bi-lock me-1"></i> Ubah Kata Sandi
            </button>
        </form>
    </div>
</div>
@endsection