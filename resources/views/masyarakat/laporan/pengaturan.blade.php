
@extends('layouts.masyarakat')

@section('content')
<div class="page-heading">
    <h1 class="page-title">Pengaturan Akun</h1>
    <p class="page-description">
        Kelola informasi profil dan keamanan akun Anda.
    </p>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('success_password'))
    <div class="alert alert-success">
        {{ session('success_password') }}
    </div>
@endif

<div class="app-panel p-4 mb-4">
    <h2 class="app-panel-title mb-3">Informasi Profil</h2>

    <form action="{{ route('masyarakat.pengaturan.update') }}"
          method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text"
                   id="name"
                   name="name"
                   class="form-control"
                   value="{{ old('name', $user->name) }}"
                   required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email"
                   id="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email', $user->email) }}"
                   required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-app-primary">
            Simpan Perubahan
        </button>
    </form>
</div>

<div class="app-panel p-4">
    <h2 class="app-panel-title mb-3">Ubah Kata Sandi</h2>

    <form action="{{ route('masyarakat.pengaturan.password') }}"
          method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="password_lama" class="form-label">
                Kata Sandi Lama
            </label>
            <input type="password"
                   id="password_lama"
                   name="password_lama"
                   class="form-control"
                   autocomplete="current-password"
                   required>
            @error('password_lama')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">
                Kata Sandi Baru
            </label>
            <input type="password"
                   id="password"
                   name="password"
                   class="form-control"
                   autocomplete="new-password"
                   minlength="8"
                   required>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">
                Konfirmasi Kata Sandi Baru
            </label>
            <input type="password"
                   id="password_confirmation"
                   name="password_confirmation"
                   class="form-control"
                   autocomplete="new-password"
                   minlength="8"
                   required>
        </div>

        <button type="submit" class="btn-app-primary">
            Ubah Kata Sandi
        </button>
    </form>
</div>
@endsection
