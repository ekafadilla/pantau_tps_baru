@extends('layouts.admin')

@section('title', ($mode === 'tambah' ? 'Tambah Pengguna' : 'Edit Pengguna'))
@section('page-title', ($mode === 'tambah' ? 'Tambah Pengguna' : 'Edit Pengguna'))

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.pengguna.index') }}"
           class="text-success">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Data Pengguna
        </a>

        <h2 class="fw-bold mt-3 mb-1" style="font-size:23px">
            {{ $mode === 'tambah' ? 'Tambah Pengguna' : 'Edit Pengguna' }}
        </h2>
        <p class="text-secondary mb-0">
            {{ $mode === 'tambah'
                ? 'Lengkapi data untuk membuat akun pengguna baru.'
                : 'Perbarui informasi akun pengguna.' }}
        </p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Data belum dapat disimpan.</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="panel">
        <div class="panel-heading">Informasi Akun</div>

        <form
            action="{{ $mode === 'tambah'
                ? route('admin.pengguna.store')
                : route('admin.pengguna.update', $user->id) }}"
            method="POST"
        >
            @csrf

            @if ($mode === 'edit')
                @method('PUT')
            @endif

            <div class="p-4">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="name" class="form-label fw-semibold">
                            Nama Lengkap <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}"
                            placeholder="Masukkan nama lengkap"
                            maxlength="255"
                            required
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label fw-semibold">
                            Email <span class="text-danger">*</span>
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}"
                            placeholder="contoh@email.com"
                            maxlength="255"
                            required
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="role" class="form-label fw-semibold">
                            Role Pengguna <span class="text-danger">*</span>
                        </label>
                        <select
                            id="role"
                            name="role"
                            class="form-select @error('role') is-invalid @enderror"
                            required
                        >
                            <option value="">Pilih role</option>

                            @if ($mode === 'edit' && $user->role === 'admin')
                                <option value="admin" @selected(old('role', $user->role) === 'admin')>
                                    Admin
                                </option>
                            @endif

                            <option value="masyarakat" @selected(old('role', $user->role) === 'masyarakat')>
                                Masyarakat
                            </option>
                            <option value="uptd" @selected(old('role', $user->role) === 'uptd')>
                                UPTD
                            </option>
                            <option value="supir" @selected(old('role', $user->role) === 'supir')>
                                Supir
                            </option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-secondary">
                            Akun baru hanya dapat dibuat untuk Masyarakat, UPTD, dan Supir.
                        </small>
                    </div>

                    <div class="col-12 col-md-6" id="wilayah-wrapper">
                        <label for="id_wilayah" class="form-label fw-semibold">
                            Wilayah Kerja UPTD
                        </label>
                        <select
                            id="id_wilayah"
                            name="id_wilayah"
                            class="form-select @error('id_wilayah') is-invalid @enderror"
                        >
                            <option value="">Pilih wilayah kerja</option>
                            @foreach ($wilayah as $itemWilayah)
                                <option
                                    value="{{ $itemWilayah->id }}"
                                    @selected((string) old('id_wilayah', $user->id_wilayah) === (string) $itemWilayah->id)
                                >
                                    {{ $itemWilayah->nama_wilayah }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_wilayah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-secondary">
                            Wajib dipilih jika role pengguna adalah UPTD.
                        </small>
                    </div>

                    <div class="col-12">
                        <hr>
                        <h3 class="fw-bold" style="font-size:16px">
                            {{ $mode === 'tambah' ? 'Kredensial Login' : 'Ubah Password (Opsional)' }}
                        </h3>
                        @if ($mode === 'edit')
                            <p class="text-secondary small">
                                Kosongkan password jika tidak ingin mengubahnya.
                            </p>
                        @endif
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="password" class="form-label fw-semibold">
                            Password
                            @if ($mode === 'tambah')
                                <span class="text-danger">*</span>
                            @endif
                        </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            minlength="8"
                            autocomplete="{{ $mode === 'tambah' ? 'new-password' : 'new-password' }}"
                            placeholder="{{ $mode === 'tambah' ? 'Minimal 8 karakter' : 'Kosongkan jika tidak diubah' }}"
                            {{ $mode === 'tambah' ? 'required' : '' }}
                        >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="password_confirmation" class="form-label fw-semibold">
                            Konfirmasi Password
                            @if ($mode === 'tambah')
                                <span class="text-danger">*</span>
                            @endif
                        </label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control"
                            minlength="8"
                            autocomplete="new-password"
                            placeholder="Ketik ulang password"
                            {{ $mode === 'tambah' ? 'required' : '' }}
                        >
                    </div>
                </div>
            </div>

            <div class="p-3 border-top d-flex justify-content-end gap-2">
                <a href="{{ route('admin.pengguna.index') }}"
                   class="btn btn-outline-secondary">
                    Batal
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ $mode === 'tambah' ? 'Simpan Pengguna' : 'Simpan Perubahan' }}
                </button>
            </div>
        </form>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const role = document.getElementById('role');
            const wilayahWrapper = document.getElementById('wilayah-wrapper');
            const wilayah = document.getElementById('id_wilayah');

            function aturWilayah() {
                const wajibWilayah = role.value === 'uptd';
                wilayahWrapper.style.display = wajibWilayah ? '' : 'none';
                wilayah.required = wajibWilayah;

                if (!wajibWilayah) {
                    wilayah.value = '';
                }
            }

            role.addEventListener('change', aturWilayah);
            aturWilayah();
        });
    </script>
@endsection