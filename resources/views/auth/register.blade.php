<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - SI Pantau TPS</title>

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
                <h2>Bersama Wujudkan Lingkungan yang Lebih Bersih.</h2>
                <p>
                    Bergabunglah dengan SI Pantau TPS untuk
                    melaporkan kondisi tempat pembuangan sampah
                    dan ikut berkontribusi menjaga lingkungan.
                </p>
            </div>

            <div class="brand-illustration">
                <div class="illustration-icon">
                    <i class="bi bi-tree"></i>
                </div>
                <div class="illustration-text">
                    <strong>Mulai dari Kepedulian</strong>
                    <span>Satu laporan dapat membantu<br>menjaga lingkungan bersama.</span>
                </div>
            </div>

            <div class="brand-footer">
                Sistem Informasi Pemantauan Tempat Pembuangan Sampah
            </div>
        </section>

        <section class="auth-form-panel">

            <div class="auth-heading">
                <h1>Buat Akun Baru</h1>
                <p>Lengkapi informasi berikut untuk mulai menggunakan SI Pantau TPS.</p>
            </div>

            @if ($errors->any())
                <div class="auth-error">
                    Periksa kembali data yang Anda masukkan.
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        autocomplete="name"
                        required
                    >

                    @error('name')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        autocomplete="email"
                        required
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
                            placeholder="Minimal 8 karakter"
                            autocomplete="new-password"
                            required
                        >
                        <button type="button" class="toggle-password" data-target="password" aria-label="Lihat password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>

                    @error('password')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="password-wrapper">
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Masukkan ulang password"
                            autocomplete="new-password"
                            required
                        >
                        <button type="button" class="toggle-password" data-target="password_confirmation" aria-label="Lihat konfirmasi password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="auth-button">
                    Buat Akun
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>

            <div class="auth-switch">
                Sudah memiliki akun?
                <a href="{{ route('login') }}" class="auth-link">Masuk sekarang</a>
            </div>

            <a href="{{ route('landing') }}" class="back-home">
                <i class="bi bi-arrow-left"></i>
                Kembali ke halaman utama
            </a>

        </section>
    </div>
</main>

<script>
    document.querySelectorAll('.toggle-password').forEach(function (button) {
        button.addEventListener('click', function () {
            const target = document.getElementById(this.dataset.target);
            const icon = this.querySelector('i');
            const isHidden = target.type === 'password';

            target.type = isHidden ? 'text' : 'password';

            icon.classList.toggle('bi-eye', !isHidden);
            icon.classList.toggle('bi-eye-slash', isHidden);

            this.setAttribute(
                'aria-label',
                isHidden ? 'Sembunyikan password' : 'Lihat password'
            );
        });
    });
</script>

</body>
</html>
