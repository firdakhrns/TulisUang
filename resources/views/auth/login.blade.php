<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - TulisUang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('/images/keuangan.jpg'); /* Ganti dengan path gambar kamu */
            background-size: cover;
            background-position: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background-color: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
            color: white;
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 10px;
            font-weight: 600;
            font-size: 1.75rem;
        }

        .subtitle {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 24px;
        }

        .form-input {
            width: 100%;
            padding: 14px;
            margin-bottom: 20px;
            border: none;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .form-input::placeholder {
            color: #e0e0e0;
        }

        .form-button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background-color: #2874c5;
            color: white;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .form-button:hover {
            background-color: #1d5fa6;
        }

        .register {
            margin-top: 30px;
            font-size: 0.95rem;
        }

        .register a {
            color: #ffffff;
            font-weight: bold;
            text-decoration: underline;
        }

        .error-box {
            background-color: rgba(255, 0, 0, 0.2);
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            color: #fff;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Welcome to TulisUang</h2>
            <p class="subtitle">Kelola keuanganmu dengan rapi, cerdas, dan bebas stres</p>

            @if (session('status'))
                <div class="error-box">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="email" name="email" class="form-input" placeholder="Email" required autofocus>
                <input type="password" name="password" class="form-input" placeholder="Password" required>
                <button type="submit" class="form-button">LOGIN</button>
            </form>

            <div class="register">
                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
            </div>
        </div>
    </div>
</body>
</html>
