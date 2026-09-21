<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ورود | سیستم مدیریت پرسنل</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Tahoma, Arial, sans-serif;
            background:
                radial-gradient(circle at top right, #1e3a5f 0, transparent 35%),
                linear-gradient(135deg, #07111f, #0f2742);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .login-wrapper {
            width: 100%;
            max-width: 430px;
            padding: 20px;
        }

        .login-card {
            background: rgba(255,255,255,.97);
            color: #172033;
            border-radius: 24px;
            padding: 38px;
            box-shadow: 0 25px 70px rgba(0,0,0,.35);
        }

        .logo {
            width: 72px;
            height: 72px;
            margin: 0 auto 20px;
            border-radius: 20px;
            background: #d4a72c;
            color: #07111f;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: 900;
        }

        h1 {
            text-align: center;
            margin: 0 0 8px;
            font-size: 24px;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            font-size: 13px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 800;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #dbe2ea;
            border-radius: 12px;
            outline: none;
            font-size: 14px;
            transition: .2s;
        }

        input:focus {
            border-color: #d4a72c;
            box-shadow: 0 0 0 4px rgba(212,167,44,.12);
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 22px;
            color: #64748b;
            font-size: 12px;
        }

        .login-btn {
            width: 100%;
            border: 0;
            border-radius: 12px;
            padding: 14px;
            background: #0f2742;
            color: #fff;
            font-size: 14px;
            font-weight: 900;
            cursor: pointer;
            transition: .2s;
        }

        .login-btn:hover {
            background: #173b63;
            transform: translateY(-1px);
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            border-radius: 10px;
            padding: 10px 12px;
            margin-bottom: 18px;
            font-size: 12px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            padding: 10px 12px;
            margin-bottom: 18px;
            font-size: 12px;
        }

        .footer {
            text-align: center;
            color: #94a3b8;
            font-size: 11px;
            margin-top: 22px;
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <div class="login-card">

        <div class="logo">
            PF
        </div>

        <h1>سیستم مدیریت پرسنل</h1>

        <div class="subtitle">
            سامانه مدیریت و کنترل امور پرسنلی
        </div>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="username">نام کاربری</label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username') }}"
                    autocomplete="username"
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">رمز عبور</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    autocomplete="current-password"
                >
            </div>

            <label class="remember">
                <input type="checkbox" name="remember" value="1">
                مرا به خاطر بسپار
            </label>

            <button type="submit" class="login-btn">
                ورود به سامانه
            </button>
        </form>

    </div>

    <div class="footer">
        Personal System Faraja
    </div>

</div>

</body>
</html>