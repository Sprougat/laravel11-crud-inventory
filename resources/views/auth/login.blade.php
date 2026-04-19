<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Inventaris Nana</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --pink:       #FF0080;
            --pink-light: #FF4DA6;
            --pink-dim:   rgba(255, 0, 128, 0.14);
            --bg:         #09090F;
            --bg-card:    #111118;
            --bg-card2:   #18181F;
            --text:       #EFEFFA;
            --text-muted: #8888AA;
            --border:     #1E1E2E;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* ambient glow */
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background:
                radial-gradient(ellipse 60% 50% at 15% 60%, rgba(255,0,128,.07) 0%, transparent 60%),
                radial-gradient(ellipse 50% 40% at 85% 30%, rgba(180,0,255,.04) 0%, transparent 50%);
            pointer-events: none;
        }

        .wrap {
            position: relative; z-index: 1;
            width: 100%; max-width: 420px;
        }

        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 40px 36px;
            box-shadow: 0 20px 70px rgba(0,0,0,.55), 0 0 50px rgba(255,0,128,.05);
        }

        /* logo */
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo-icon {
            width: 66px; height: 66px;
            background: linear-gradient(135deg, var(--pink), var(--pink-light));
            border-radius: 18px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 30px;
            box-shadow: 0 8px 36px rgba(255,0,128,.38);
            margin-bottom: 14px;
        }
        .logo-title { font-size: 21px; font-weight: 800; color: var(--text); }
        .logo-sub   { font-size: 12.5px; color: var(--text-muted); margin-top: 3px; }
        .logo-sub span { color: var(--pink-light); font-weight: 600; }

        /* form */
        .f-group  { margin-bottom: 16px; }
        .f-label  { display: block; font-size: 12.5px; font-weight: 600; color: var(--text-muted); margin-bottom: 7px; }
        .f-wrap   { position: relative; }
        .f-icon   { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 15px; pointer-events: none; }
        .f-input  {
            width: 100%;
            background: var(--bg-card2);
            border: 1px solid var(--border);
            color: var(--text);
            border-radius: 9px;
            padding: 11px 12px 11px 40px;
            font-size: 13.5px;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color .18s, box-shadow .18s;
        }
        .f-input:focus {
            border-color: var(--pink);
            box-shadow: 0 0 0 3px var(--pink-dim);
        }
        .f-input.err { border-color: #FF1744; }
        .f-input::placeholder { color: #33334a; }

        .pw-toggle {
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            background: none; border: none;
            color: var(--text-muted); cursor: pointer; font-size: 15px; padding: 0;
        }

        .f-error {
            font-size: 12px; color: #FF5252;
            margin-top: 5px;
            display: flex; align-items: center; gap: 4px;
        }

        /* remember row */
        .remember {
            display: flex; align-items: center; gap: 8px;
            margin-bottom: 22px;
        }
        .remember input { accent-color: var(--pink); width: 15px; height: 15px; }
        .remember label { font-size: 13px; color: var(--text-muted); cursor: pointer; }

        /* submit */
        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, var(--pink), var(--pink-light));
            border: none;
            color: #fff;
            font-family: 'Inter', sans-serif;
            font-weight: 700; font-size: 14.5px;
            padding: 12px;
            border-radius: 9px;
            cursor: pointer;
            transition: opacity .18s, transform .18s, box-shadow .18s;
            box-shadow: 0 4px 20px rgba(255,0,128,.38);
        }
        .btn-submit:hover {
            opacity: .92;
            transform: translateY(-1px);
            box-shadow: 0 6px 28px rgba(255,0,128,.50);
        }

        /* alerts */
        .alert-err {
            background: rgba(255,23,68,.09);
            border: 1px solid rgba(255,23,68,.22);
            color: #FF5252;
            border-radius: 9px;
            padding: 11px 14px;
            font-size: 13px;
            display: flex; align-items: center; gap: 9px;
            margin-bottom: 18px;
        }
        .alert-ok {
            background: rgba(0,230,118,.09);
            border: 1px solid rgba(0,230,118,.22);
            color: #00E676;
            border-radius: 9px;
            padding: 11px 14px;
            font-size: 13px;
            display: flex; align-items: center; gap: 9px;
            margin-bottom: 18px;
        }

        /* default cred hint */
        .cred-hint {
            margin-top: 26px;
            padding-top: 18px;
            border-top: 1px solid var(--border);
            text-align: center;
        }
        .cred-hint p { font-size: 11.5px; color: var(--text-muted); margin-bottom: 8px; }
        .cred-box {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--bg-card2);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 7px 14px;
            font-size: 12px;
        }
        .cred-box code { color: var(--pink-light); font-size: 11.5px; }
        .cred-sep { color: var(--border); }
    </style>
</head>
<body>
<div class="wrap">
    <div class="card">

        <div class="logo">
            <div class="logo-icon">🛍️</div>
            <h1 class="logo-title">Selamat Datang!</h1>
            <p class="logo-sub">
                <span>Inventaris Nana</span> — Pak Cik &amp; Mas Aimar
            </p>
        </div>

        {{-- Alert error --}}
        @if ($errors->any())
        <div class="alert-err">
            <i class="bi bi-exclamation-circle-fill" style="font-size:16px; flex-shrink:0;"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        {{-- Flash success (e.g. after logout) --}}
        @if (session('success'))
        <div class="alert-ok">
            <i class="bi bi-check-circle-fill" style="font-size:16px; flex-shrink:0;"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" novalidate>
            @csrf

            {{-- Email --}}
            <div class="f-group">
                <label class="f-label" for="email">Alamat Email</label>
                <div class="f-wrap">
                    <i class="bi bi-envelope-fill f-icon"></i>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="f-input {{ $errors->has('email') ? 'err' : '' }}"
                        value="{{ old('email') }}"
                        placeholder="admin@inventaris.com"
                        autocomplete="email"
                        autofocus
                        required>
                </div>
                @error('email')
                <p class="f-error"><i class="bi bi-x-circle-fill"></i> {{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="f-group">
                <label class="f-label" for="password">Password</label>
                <div class="f-wrap">
                    <i class="bi bi-lock-fill f-icon"></i>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="f-input {{ $errors->has('password') ? 'err' : '' }}"
                        placeholder="••••••••"
                        autocomplete="current-password"
                        required>
                    <button type="button" class="pw-toggle" id="pwToggle" aria-label="Tampilkan password">
                        <i class="bi bi-eye-fill" id="pwIcon"></i>
                    </button>
                </div>
                @error('password')
                <p class="f-error"><i class="bi bi-x-circle-fill"></i> {{ $message }}</p>
                @enderror
            </div>

            {{-- Remember me --}}
            <div class="remember">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingat saya di perangkat ini</label>
            </div>

            <button type="submit" class="btn-submit">
                <i class="bi bi-box-arrow-in-right" style="margin-right:6px;"></i>
                Masuk ke Dashboard
            </button>
        </form>

        <div class="cred-hint">
            <p>Akun default untuk demo:</p>
            <div class="cred-box">
                <i class="bi bi-person-fill" style="color:var(--pink-light);"></i>
                <code>admin@inventaris.com</code>
                <span class="cred-sep">|</span>
                <code>password</code>
            </div>
        </div>

    </div>
</div>

<script>
    const pwToggle = document.getElementById('pwToggle');
    const pwInput  = document.getElementById('password');
    const pwIcon   = document.getElementById('pwIcon');
    pwToggle.addEventListener('click', function () {
        if (pwInput.type === 'password') {
            pwInput.type = 'text';
            pwIcon.className = 'bi bi-eye-slash-fill';
        } else {
            pwInput.type = 'password';
            pwIcon.className = 'bi bi-eye-fill';
        }
    });
</script>
</body>
</html>
