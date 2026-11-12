<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#153f31">
    <title>Admin login | Explore Ondo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css-explore-ondo.css') }}?v={{ md5_file(public_path('css-explore-ondo.css')) }}">
    @endif
</head>
<body class="auth-body">
    <main class="auth-layout">
        <section class="auth-story" aria-labelledby="welcome-heading">
            <a class="brand auth-brand" href="{{ route('home') }}"><span class="brand-mark" aria-hidden="true">✳</span><span>Explore Ondo</span></a>
            <div class="auth-story-copy">
                <p class="eyebrow">Your city guide workspace</p>
                <h1 id="welcome-heading">Welcome back.</h1>
                <p>Sign in to care for the places, stories, and updates that help people discover Ondo.</p>
            </div>
            <div class="auth-story-bottom"><span class="auth-ornament" aria-hidden="true">O</span><p>Rooted in Ekimogun.<br>Made with care in Ondo.</p></div>
        </section>

        <section class="auth-panel" aria-labelledby="login-heading">
            <a class="auth-home-link" href="{{ route('home') }}">← Back to Explore Ondo</a>
            <div class="auth-card">
                <p class="section-kicker">Administrator access</p>
                <h2 id="login-heading">Sign in</h2>
                <p class="auth-card-intro">Use your approved administrator email and password.</p>

                @if (session('status'))
                    <p class="auth-notice" role="status">{{ session('status') }}</p>
                @endif

                @if ($errors->any())
                    <div id="login-errors" class="auth-error" role="alert">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form class="auth-form" action="{{ route('login.submit') }}" method="post">
                    @csrf
                    <div class="auth-field">
                        <label for="email">Email address</label>
                        <input class="auth-input" type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="username" @if ($errors->has('email')) aria-invalid="true" aria-describedby="login-errors" @endif required autofocus>
                    </div>
                    <div class="auth-field">
                        <div class="auth-label-row"><label for="password">Password</label><a href="{{ route('password.request') }}">Forgot password?</a></div>
                        <div class="auth-password-wrap">
                            <input class="auth-input" type="password" id="password" name="password" autocomplete="current-password" @if ($errors->has('password')) aria-invalid="true" aria-describedby="login-errors" @endif required>
                            <button class="auth-password-toggle" type="button" id="toggle-password" aria-label="Show password" aria-controls="password" aria-pressed="false">
                                <svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/><path id="password-eye-slash" d="M3 3l18 18" style="display:none"/></svg>
                            </button>
                        </div>
                    </div>
                    <button class="auth-submit" type="submit" style="display:flex !important; visibility:visible !important; opacity:1 !important; width:100%; min-height:49px; align-items:center; justify-content:center; gap:12px; margin-top:8px; border:0; border-radius:6px; background:#153f31; color:#fff; font:700 13px 'DM Sans',sans-serif; cursor:pointer;">Sign in to dashboard <span aria-hidden="true">→</span></button>
                </form>
                <p class="auth-access-note"><span aria-hidden="true">✳</span> Access is limited to approved administrator accounts.</p>
            </div>
            <p class="auth-copyright">© {{ date('Y') }} Explore Ondo</p>
        </section>
    </main>
    <script>
        const passwordInput = document.getElementById('password');
        const passwordToggle = document.getElementById('toggle-password');
        const eyeSlash = document.getElementById('password-eye-slash');

        function hidePassword() {
            passwordInput.type = 'password';
            passwordToggle.setAttribute('aria-label', 'Show password');
            passwordToggle.setAttribute('aria-pressed', 'false');
            eyeSlash.style.display = 'none';
        }

        passwordToggle.addEventListener('click', function () {
            const showPassword = passwordInput.type === 'password';
            passwordInput.type = showPassword ? 'text' : 'password';
            passwordToggle.setAttribute('aria-label', showPassword ? 'Hide password' : 'Show password');
            passwordToggle.setAttribute('aria-pressed', String(showPassword));
            eyeSlash.style.display = showPassword ? '' : 'none';
        });

        window.addEventListener('pageshow', hidePassword);
    </script>
</body>
</html>
