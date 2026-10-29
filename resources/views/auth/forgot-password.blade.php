<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - SI Pantau TPS</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f2f6f3;
            color: #25352c;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 520px;
            background: white;
            border: 1px solid #dce5de;
            border-radius: 14px;
            padding: 35px;
        }

        h1 {
            color: #176b45;
            font-size: 27px;
        }

        p {
            color: #718078;
            line-height: 1.6;
        }

        a {
            color: #176b45;
            text-decoration: none;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <main class="container">
        <h1>Lupa Kata Sandi?</h1>

        <p>
            Halaman ini digunakan untuk memulai proses pemulihan
            kata sandi akun SI Pantau TPS.
        </p>

        <p>
            Fitur pengiriman tautan pemulihan kata sandi belum diaktifkan.
            Silakan kembali ke halaman masuk untuk sementara.
        </p>

        <a class="back" href="{{ route('login') }}">
            &larr; Kembali ke halaman masuk
        </a>
    </main>
</body>
</html>