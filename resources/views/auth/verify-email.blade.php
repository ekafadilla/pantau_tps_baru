<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - SI Pantau TPS</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
<main class="auth-page">
    <section class="auth-form-panel" style="margin: auto;">
        <div class="auth-heading">
            <h1>Verifikasi Email Anda</h1>
            <p>
                Kami telah mengirim tautan verifikasi ke <strong>{{ auth()->user()->email }}</strong>.
                Klik tautan tersebut untuk mengaktifkan akun. Jika belum menerima email, periksa folder spam.
            </p>
        </div>

        @if (session('status'))
            <div style="padding: 12px; margin-bottom: 16px; border-radius: 8px; background: #f0faf2; color: #176b43;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="auth-button">Kirim Ulang Email Verifikasi</button>
        </form>

        <form method="POST" action="{{ route('logout') }}" style="margin-top: 14px;">
            @csrf
            <button type="submit" class="auth-link" style="background: none; border: 0; cursor: pointer;">Keluar</button>
        </form>
    </section>
</main>
</body>
</html>