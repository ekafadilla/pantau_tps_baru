<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SI Pantau TPS</title>

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<main class="auth-page">
    <div class="auth-layout">

        <section class="auth-brand-panel">
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
                <h2>Kelola Lingkungan, Mulai dari Sekarang.</h2>
                <p>
                    Pantau kondisi Tempat Pembuangan Sampah dan
                    sampaikan laporan untuk membantu menciptakan
                    lingkungan yang lebih bersih dan terjaga.
                </p>
            </div>

            <div class="brand-illustration">
                <div class="illustration-icon">
                    <i class="bi bi-recycle"></i>
                </div>
                <div class="illustration-text">
                    <strong>Lingkungan Bersih</strong>
                    <span>Dimulai dari kepedulian<br>dan tindakan bersama.</span>
                </div>
            </div>

            <div class="brand-footer">
                Sistem Informasi Pemantauan Tempat Pembuangan Sampah
            </div>
        </section>

        <section class="auth-form-panel">

            <div class="auth-heading">
                <h1>Selamat Datang!</h1>
                <p>Silakan masuk ke akun Anda untuk mengakses layanan SI Pantau TPS.</p>
            </div>

            @if ($errors->any())
                <div class="auth-error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan alamat email"
                        autocomplete="username"
                        required
                        autofocus
                    >

                    @error('email')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <div class="password-wrapper">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="toggle-password"
                            id="togglePassword"
                            aria-label="Lihat kata sandi"
                            title="Lihat kata sandi"
                        >
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="password-options">
                    <label class="remember-option" for="remember">
                        <input
                            type="checkbox"
                            id="remember"
                            name="remember"
                            value="1"
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        <span>Ingat saya</span>
                    </label>

                    <a href="{{ route('password.request') }}" class="forgot-password">
                        Lupa kata sandi?
                    </a>
                </div>

                <button type="submit" class="auth-button">
                    Masuk ke Akun
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>

            <div class="auth-switch">
                Belum memiliki akun?
                <a href="{{ route('register') }}" class="auth-link">Daftar sekarang</a>
            </div>

            <a href="{{ route('landing') }}" class="back-home">
                <i class="bi bi-arrow-left"></i>
                Kembali ke halaman utama
            </a>

        </section>
    </div>
</main>

<script>
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function () {
        const isHidden = passwordInput.type === 'password';

        passwordInput.type = isHidden ? 'text' : 'password';

        eyeIcon.classList.toggle('bi-eye', !isHidden);
        eyeIcon.classList.toggle('bi-eye-slash', isHidden);

        togglePassword.setAttribute(
            'aria-label',
            isHidden ? 'Sembunyikan kata sandi' : 'Lihat kata sandi'
        );

        togglePassword.setAttribute(
            'title',
            isHidden ? 'Sembunyikan kata sandi' : 'Lihat kata sandi'
        );
    });
</script>

</body>
</html>
