@extends($layout)

@section('title', 'Pengaturan Akun')
@section('header', 'Pengaturan Akun')
@section('page-title', 'Pengaturan Akun')

@section('content')
<div class="container py-3" style="max-width: 760px;">

    <div class="mb-4">
        <h2 class="mb-1">Pengaturan Akun</h2>
        <p class="text-muted mb-0">Kelola profil dan keamanan akun Anda.</p>
    </div>

    @if (session('status'))
        <div class="alert alert-info">{{ session('status') }}</div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('success_password'))
        <div class="alert alert-success">{{ session('success_password') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data yang dimasukkan.</strong>
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- PROFIL --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="mb-1">Informasi Profil</h5>
            <p class="text-muted small mb-3">
                Mengubah email memerlukan verifikasi ulang lewat tautan yang dikirim ke alamat baru.
            </p>

            <form action="{{ route('pengaturan.profil') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label" for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-control"
                           value="{{ old('name', $user->name) }}" maxlength="100" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                           value="{{ old('email', $user->email) }}" required>
                    @if (! $user->hasVerifiedEmail())
                        <small class="text-warning">Email belum diverifikasi.</small>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Jenis Akun</label>
                    <span class="badge bg-success">{{ ucfirst($user->role) }}</span>
                    <small class="text-muted ms-2">Tidak dapat diubah sendiri.</small>
                </div>

                @if ($user->role === 'uptd')
                    <div class="mb-3">
                        <label class="form-label d-block">Wilayah Kerja</label>
                        <span>{{ $user->wilayah->nama_wilayah ?? 'Belum ditetapkan' }}</span>
                        <small class="text-muted ms-2">Dikelola oleh admin.</small>
                    </div>
                @endif

                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    {{-- KEAMANAN --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="mb-1">Keamanan Akun</h5>
            <p class="text-muted small mb-3">
                Kata sandi minimal 8 karakter, memuat huruf dan angka.
            </p>

            <form action="{{ route('pengaturan.password') }}" method="POST">
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
                           class="form-control" autocomplete="new-password" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="form-control" autocomplete="new-password" required>
                </div>

                <button type="submit" class="btn btn-success">Ubah Kata Sandi</button>
            </form>
        </div>
    </div>

</div>
@endsection