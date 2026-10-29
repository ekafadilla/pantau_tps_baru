
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | SI Pantau TPS</title>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f3f6f3;
            color: #28372d;
        }

        .page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
        }

        .register-card {
            width: 100%;
            max-width: 460px;
            background: white;
            padding: 35px;
            border: 1px solid #e2e9e3;
            border-radius: 10px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 27px;
            text-decoration: none;
        }

        .brand-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #176b43;
            color: white;
            font-size: 23px;
            border-radius: 8px;
        }

        .brand h2 {
            margin: 0;
            font-size: 18px;
            color: #176b43;
        }

        .brand p {
            margin: 4px 0 0;
            color: #758078;
            font-size: 12px;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 25px;
        }

        .description {
            color: #748078;
            font-size: 14px;
            margin-bottom: 24px;
            line-height: 1.6;
        }

        .form-group { margin-bottom: 16px; }

        label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #d9e1da;
            border-radius: 6px;
            outline: none;
        }

        input:focus { border-color: #176b43; }

        .error {
            color: #bd3030;
            font-size: 12px;
            margin-top: 6px;
        }

        .error-box {
            background: #fff0f0;
            border: 1px solid #f0cccc;
            color: #a72b2b;
            padding: 12px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .btn {
            width: 100%;
            border: 0;
            padding: 13px;
            border-radius: 6px;
            background: #176b43;
            color: white;
            font-size: 14px;
            cursor: pointer;
        }

        .btn:hover { background: #105534; }

        .login-link {
            text-align: center;
            font-size: 13px;
            margin-top: 22px;
            color: #68756c;
        }

        a {
            color: #176b43;
            text-decoration: none;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 17px;
            font-size: 13px;
        }

        @media (max-width: 480px) {
            .register-card { padding: 25px 20px; }
        }
    </style>
</head>
<body>

<div class="page">
    <div class="register-card">

        <a href="{{ route('landing') }}" class="brand">
            <div class="brand-icon">
                <i class="bi bi-recycle"></i>
            </div>
            <div>
                <h2>SI PANTAU TPS</h2>
                <p>DLH Kabupaten Indramayu</p>
            </div>
        </a>

        <h1>Daftar Akun Masyarakat</h1>
        <p class="description">
            Isi formulir berikut untuk membuat akun SI Pantau TPS.
        </p>

        @if ($errors->any())
            <div class="error-box">
                Periksa kembali data yang kamu masukkan.
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama lengkap</label>
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
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
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
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimal 8 karakter"
                    autocomplete="new-password"
                    required
                >
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Masukkan ulang password"
                    autocomplete="new-password"
                    required
                >
            </div>

            <button type="submit" class="btn">Daftar Akun</button>
        </form>

        <div class="login-link">
            Sudah memiliki akun?
            <a href="{{ route('login') }}">Masuk</a>
        </div>

        <a href="{{ route('landing') }}" class="back-link">
            <i class="bi bi-arrow-left"></i>
            Kembali ke halaman utama
        </a>

    </div>
</div>

</body>
</html>
