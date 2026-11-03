
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SI Pantau TPS</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f2f6f3;
            color: #25352c;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 16px;
        }

        .login-container {
            width: 100%;
            max-width: 645px;
            background: #ffffff;
            border: 1px solid #dce5de;
            border-radius: 17px;
            padding: 52px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 44px;
        }

        .brand-icon {
            width: 68px;
            height: 68px;
            background: #176b45;
            color: #ffffff;
            border-radius: 13px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 36px;
            flex-shrink: 0;
        }

        .brand-name {
            font-size: 28px;
            font-weight: bold;
            color: #176b45;
            margin-bottom: 5px;
        }

        .brand-description {
            font-size: 17px;
            color: #718078;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #263a30;
        }

        .subtitle {
            font-size: 20px;
            line-height: 1.5;
            color: #78847d;
            margin-bottom: 34px;
        }

        .alert-error {
            padding: 16px 18px;
            background: #fff0f0;
            border: 1px solid #ffc7c7;
            border-radius: 9px;
            color: #c62828;
            margin-bottom: 24px;
            line-height: 1.5;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 23px;
        }

        .form-group label {
            display: block;
            margin-bottom: 11px;
            font-size: 18px;
            font-weight: bold;
            color: #263a30;
        }

        .form-group input {
            width: 100%;
            height: 61px;
            padding: 0 18px;
            border: 1px solid #d5dfd7;
            border-radius: 9px;
            background: #ffffff;
            font-size: 17px;
            color: #25352c;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-group input:focus {
            border-color: #176b45;
            box-shadow: 0 0 0 3px rgba(23, 107, 69, 0.10);
        }

        .field-error {
            color: #d93025;
            font-size: 14px;
            margin-top: 8px;
        }

        /* Kolom password dan ikon mata */
        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 55px;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            color: #64756b;
            font-size: 21px;
            cursor: pointer;
            padding: 6px;
        }

        .toggle-password:hover {
            color: #176b45;
        }

        .password-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 15px;
            margin-bottom: 28px;
            flex-wrap: wrap;
        }

        .remember-option {
            display: flex;
            align-items: center;
            gap: 9px;
            color: #68766e;
            font-size: 16px;
        }

        .remember-option input {
            width: 18px;
            height: 18px;
            accent-color: #176b45;
            cursor: pointer;
        }

        .forgot-password {
            color: #176b45;
            font-size: 15px;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .btn-login {
            display: block;
            width: 100%;
            height: 63px;
            border: none;
            border-radius: 9px;
            background: #176b45;
            color: #ffffff;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-login:hover {
            background: #105536;
        }

        .register-text {
            margin-top: 31px;
            text-align: center;
            color: #78847d;
            font-size: 17px;
            line-height: 1.6;
        }

        .register-text a {
            color: #176b45;
            font-weight: bold;
            text-decoration: none;
        }

        .register-text a:hover {
            text-decoration: underline;
        }

        .back-home {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #64756b;
            font-size: 15px;
            text-decoration: none;
        }

        .back-home:hover {
            color: #176b45;
        }

        @media (max-width: 600px) {
            .login-container {
                padding: 30px 23px;
            }

            .brand {
                gap: 13px;
                margin-bottom: 35px;
            }

            .brand-icon {
                width: 54px;
                height: 54px;
                font-size: 29px;
            }

            .brand-name {
                font-size: 22px;
            }

            .brand-description {
                font-size: 14px;
            }

            h1 {
                font-size: 29px;
            }

            .subtitle {
                font-size: 16px;
            }

            .form-group label {
                font-size: 16px;
            }

            .form-group input {
                height: 54px;
                font-size: 16px;
            }

            .password-options {
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    <main class="login-container">

        <!-- Identitas aplikasi -->
        <div class="brand">
            <div class="brand-icon">
                <i class="bi bi-recycle"></i>
            </div>

            <div>
                <div class="brand-name">SI PANTAU TPS</div>
                <div class="brand-description">DLH Kabupaten Indramayu</div>
            </div>
        </div>

        <!-- Judul halaman -->
        <h1>Masuk ke Akun</h1>

        <p class="subtitle">
            Masuk untuk mengakses layanan SI Pantau TPS.
        </p>

        <!-- Pesan kesalahan -->
        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- Form login -->
        <form action="{{ route('login.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>

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

            <!-- Ingat saya dan lupa password -->
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

                <a
                    href="{{ route('password.request') }}"
                    class="forgot-password"
                >
                    Lupa kata sandi?
                </a>
            </div>

            <button type="submit" class="btn-login">
                Masuk
            </button>
        </form>

        <!-- Link pendaftaran -->
        <div class="register-text">
            Belum memiliki akun?
            <a href="{{ route('register') }}">Daftar sekarang</a>
        </div>

        <!-- Kembali ke halaman utama -->
        <a href="{{ route('landing') }}" class="back-home">
            <i class="bi bi-arrow-left"></i>
            Kembali ke halaman utama
        </a>

    </main>

    <!-- Fungsi tampil/sembunyikan password -->
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
