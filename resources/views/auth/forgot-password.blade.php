<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - SI Pantau TPS</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<main class="auth-page">
    <div class="auth-layout recovery-layout">

        <section class="auth-brand-panel recovery-brand">
            <div class="brand">
                <div class="brand-icon">
                    <i class="bi bi-recycle"></i>
                </div>
                <div>
                    <div class="brand-name">SI PANTAU TPS</div>
                    <div class="brand-description">DLH Kabupaten Indramayu</div>
                </div>
            </div>

            <div class="brand-content">
                <h2>Keamanan Akun Anda Penting.</h2>
                <p>
                    Pulihkan akses akun SI Pantau TPS dengan
                    membuat kata sandi baru melalui email terdaftar.
                </p>
            </div>

            <div class="brand-footer">
                Sistem Informasi Pemantauan Tempat Pembuangan Sampah
            </div>
        </section>

        <section class="auth-form-panel recovery-form-panel">
            <div class="auth-heading">
                <h1>Lupa Kata Sandi?</h1>
                <p>
                    Masukkan alamat email yang terdaftar.
                    Kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.
                </p>
            </div>

            @if (session('status'))
                <div class="auth-success">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="auth-error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email terdaftar"
                        autocomplete="email"
                        required
                        autofocus
                    >
                </div>

                <button type="submit" class="auth-button">
                    Kirim Tautan Pemulihan
                    <i class="bi bi-send"></i>
                </button>
            </form>

            <a href="{{ route('login') }}" class="back-home recovery-back">
                <i class="bi bi-arrow-left"></i>
                Kembali ke halaman masuk
            </a>
        </section>

    </div>
</main>

</body>
</html>
