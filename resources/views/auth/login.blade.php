<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | {{ config('app.name', 'Assanadiyah') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@600;800&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #14532d;
            --primary-color-hover: #166534;
            --bg-color: #f8f5e9;
            --supporting-color: #ffffff;
            --secondary-color: #d4af37;
            --accent-color: #4d7c0f;
            --main-text: #1f2937;
            --secondary-text: #4b5563;
            --light-gray: #e5e7eb;
            --danger: #b91c1c;
            --font-head: "Bricolage Grotesque", "Roboto", sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Roboto", Arial, Helvetica, sans-serif;
            color: var(--main-text);
            background: var(--bg-color);
        }

        :focus-visible {
            outline: 3px solid var(--secondary-color);
            outline-offset: 2px;
        }

        .auth-wrap {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
        }

        /* ---------- Panel kiri (brand) ---------- */
        .auth-brand {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            text-align: center;
            color: var(--bg-color);
            overflow: hidden;
            background:
                radial-gradient(circle at 50% 50%, rgba(212, 175, 55, 0.18) 0 2px, transparent 3px),
                conic-gradient(from 45deg at 50% 50%, transparent 0 25%, rgba(255, 255, 255, 0.05) 0 50%, transparent 0 75%, rgba(255, 255, 255, 0.05) 0),
                linear-gradient(150deg, #0e3d21 0%, var(--primary-color) 60%, var(--primary-color-hover) 100%);
            background-size: 56px 56px, 56px 56px, cover;
        }

        .auth-brand::after {
            content: "";
            position: absolute;
            right: 0;
            top: 12%;
            bottom: 12%;
            width: 4px;
            border-radius: 4px;
            background: linear-gradient(180deg, transparent, var(--secondary-color), transparent);
        }

        .auth-monogram {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 96px;
            height: 96px;
            margin-bottom: 1.5rem;
            font-family: var(--font-head);
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--primary-color);
            background: var(--secondary-color);
            border-radius: 50%;
            box-shadow: 0 0 0 8px rgba(212, 175, 55, 0.25);
        }

        .auth-brand h1 {
            margin: 0 0 0.6rem;
            font-family: var(--font-head);
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            letter-spacing: 1px;
        }

        .auth-brand p {
            max-width: 340px;
            margin: 0;
            line-height: 1.7;
            color: rgba(248, 245, 233, 0.88);
        }

        /* ---------- Panel kanan (form) ---------- */
        .auth-panel {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 1.5rem;
        }

        .auth-card {
            width: 100%;
            max-width: 420px;
        }

        .auth-card h2 {
            margin: 0 0 0.4rem;
            font-family: var(--font-head);
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary-color);
        }

        .auth-card .auth-sub {
            margin: 0 0 1.8rem;
            color: var(--secondary-text);
        }

        .auth-status {
            margin-bottom: 1.2rem;
            padding: 0.8rem 1rem;
            font-size: 0.95rem;
            color: var(--primary-color);
            background: rgba(77, 124, 15, 0.12);
            border-left: 4px solid var(--accent-color);
            border-radius: 8px;
        }

        .auth-field { margin-bottom: 1.2rem; }

        .auth-field label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--main-text);
        }

        .auth-input-wrap { position: relative; }

        .auth-input {
            width: 100%;
            padding: 13px 16px;
            font: inherit;
            color: var(--main-text);
            background: var(--supporting-color);
            border: 2px solid var(--light-gray);
            border-radius: 12px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .auth-input:hover { border-color: #cbd5d1; }

        .auth-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(20, 83, 45, 0.15);
        }

        .auth-input.is-invalid { border-color: var(--danger); }

        .auth-input.has-toggle { padding-right: 48px; }

        .auth-toggle {
            position: absolute;
            top: 50%;
            right: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            padding: 0;
            color: var(--secondary-text);
            background: transparent;
            border: 0;
            border-radius: 8px;
            cursor: pointer;
            transform: translateY(-50%);
        }

        .auth-toggle:hover { color: var(--primary-color); }

        .auth-error {
            margin: 6px 0 0;
            font-size: 0.88rem;
            color: var(--danger);
        }

        .auth-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 1.6rem;
        }

        .auth-check {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
            color: var(--secondary-text);
            cursor: pointer;
        }

        .auth-check input {
            width: 18px;
            height: 18px;
            accent-color: var(--primary-color);
        }

        .auth-link {
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--primary-color);
            text-decoration: none;
            border-bottom: 2px solid var(--secondary-color);
        }

        .auth-link:hover { color: var(--primary-color-hover); border-bottom-color: var(--primary-color); }

        .auth-submit {
            width: 100%;
            padding: 14px 20px;
            font: inherit;
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--primary-color);
            background: var(--secondary-color);
            border: 2px solid var(--secondary-color);
            border-radius: 999px;
            cursor: pointer;
            box-shadow: 0 8px 18px rgba(212, 175, 55, 0.4);
            transition: all 0.25s ease;
        }

        .auth-submit:hover {
            color: var(--bg-color);
            background: var(--primary-color);
            border-color: var(--primary-color);
            box-shadow: 0 10px 22px rgba(20, 83, 45, 0.35);
            transform: translateY(-2px);
        }

        .auth-back {
            margin-top: 1.8rem;
            text-align: center;
            font-size: 0.95rem;
        }

        .auth-back a {
            color: var(--secondary-text);
            text-decoration: none;
        }

        .auth-back a:hover { color: var(--primary-color); }

        /* ---------- Mobile ---------- */
        @media (max-width: 860px) {
            .auth-wrap { grid-template-columns: 1fr; }

            .auth-brand {
                min-height: auto;
                padding: 2.2rem 1.5rem 2.6rem;
            }

            .auth-brand::after { display: none; }

            .auth-monogram {
                width: 68px;
                height: 68px;
                margin-bottom: 1rem;
                font-size: 2rem;
            }

            .auth-brand p { display: none; }

            .auth-panel { padding-top: 2rem; }
        }

        @media (prefers-reduced-motion: reduce) {
            * { transition-duration: 0.01ms !important; }
        }
    </style>
</head>
<body>
<div class="auth-wrap">

    {{-- Panel brand --}}
    <aside class="auth-brand">
        <div class="auth-monogram" aria-hidden="true">A</div>
        <h1>Assanadiyah</h1>
        <p>Masuk untuk mengelola konten dan informasi website pondok pesantren.</p>
    </aside>

    {{-- Panel form --}}
    <main class="auth-panel">
        <div class="auth-card">
            <h2>Selamat Datang</h2>
            <p class="auth-sub">Silakan masuk dengan akun kamu.</p>

            @if (session('status'))
                <div class="auth-status" role="status">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="auth-field">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email"
                        class="auth-input @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        required autofocus autocomplete="username">
                    @error('email')
                        <p class="auth-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="auth-field">
                    <label for="password">Password</label>
                    <div class="auth-input-wrap">
                        <input id="password" type="password" name="password"
                            class="auth-input has-toggle @error('password') is-invalid @enderror"
                            placeholder="Masukkan password"
                            required autocomplete="current-password">
                        <button type="button" class="auth-toggle" id="togglePassword"
                            aria-label="Tampilkan password" aria-pressed="false">
                            <svg id="eyeIcon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="auth-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember + Lupa password --}}
                <div class="auth-row">
                    <label class="auth-check" for="remember_me">
                        <input id="remember_me" type="checkbox" name="remember">
                        Ingat saya
                    </label>

                    @if (Route::has('password.request'))
                        <a class="auth-link" href="{{ route('password.request') }}">Lupa password?</a>
                    @endif
                </div>

                <button type="submit" class="auth-submit">Masuk</button>
            </form>

            <p class="auth-back"><a href="{{ url('/') }}">&larr; Kembali ke beranda</a></p>
        </div>
    </main>

</div>

<script>
    (function () {
        var btn = document.getElementById('togglePassword');
        var input = document.getElementById('password');
        if (!btn || !input) return;

        btn.addEventListener('click', function () {
            var show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            btn.setAttribute('aria-pressed', show ? 'true' : 'false');
            btn.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
        });
    })();
</script>
</body>
</html>