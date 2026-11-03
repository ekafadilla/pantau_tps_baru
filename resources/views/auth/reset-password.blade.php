<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Kata Sandi - SI Pantau TPS</title>
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
                <h2>Buat Kata Sandi Baru.</h2>
                <p>
                    Gunakan kata sandi yang kuat agar akun
                    SI Pantau TPS tetap aman.
                </p>
            </div>

            <div class="brand-footer">
                Sistem Informasi Pemantauan Tempat Pembuangan Sampah
            </div>
        </section>

        <section class="auth-form-panel recovery-form-panel">
            <div class="auth-heading">
                <h1>Atur Ulang Kata Sandi</h1>
                <p>
                    Silakan buat kata sandi baru untuk akun Anda.
                    Gunakan minimal 8 karakter.
                </p>
            </div>

            @if ($errors->any())
                <div class="auth-error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $email) }}"
                        placeholder="Masukkan email akun"
                        autocomplete="email"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi Baru</label>
                    <div class="password-wrapper">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Minimal 8 karakter"
                            autocomplete="new-password"
                            required
                        >
                        <button type="button" class="toggle-password" id="togglePassword"
                            aria-label="Lihat kata sandi">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <div class="password-wrapper">
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Ulangi kata sandi baru"
                            autocomplete="new-password"
                            required
                        >
                        <button type="button" class="toggle-password" id="toggleConfirmation"
                            aria-label="Lihat konfirmasi kata sandi">
                            <i class="bi bi-eye" id="confirmationEyeIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="auth-button">
                    Simpan Kata Sandi Baru
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>

            <a href="{{ route('login') }}" class="back-home recovery-back">
                <i class="bi bi-arrow-left"></i>
                Kembali ke halaman masuk
            </a>
        </section>

    </div>
</main>

<script>
    function setupPasswordToggle(inputId, buttonId, iconId) {
        const input = document.getElementById(inputId);
        const button = document.getElementById(buttonId);
        const icon = document.getElementById(iconId);

        button.addEventListener('click', function () {
            const hidden = input.type === 'password';
            input.type = hidden ? 'text' : 'password';

            icon.classList.toggle('bi-eye', !hidden);
            icon.classList.toggle('bi-eye-slash', hidden);

            button.setAttribute(
                'aria-label',
                hidden ? 'Sembunyikan kata sandi' : 'Lihat kata sandi'
            );
        });
    }

    setupPasswordToggle('password', 'togglePassword', 'eyeIcon');
    setupPasswordToggle(
        'password_confirmation',
        'toggleConfirmation',
        'confirmationEyeIcon'
    );
</script>

</body>
</html>
