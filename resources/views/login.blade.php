
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In | Explore Ondo</title>
</head>

<body style="margin: 0; min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: Arial, sans-serif; background-color: #f4f7f5; color: #26352d; padding: 20px; box-sizing: border-box;">

    <div style="width: 100%; max-width: 400px; padding: 35px; background-color: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); box-sizing: border-box;">

        <h1 style="text-align: center; color: #176b45; margin: 0 0 10px;">
            Explore Ondo
        </h1>

        <p style="text-align: center; color: #6b786f; margin-bottom: 30px;">
            Log In
        </p>

        @if (session('status'))
            <p role="status" style="padding: 12px; background-color: #eaf5ee; border-radius: 6px; color: #176b45; line-height: 1.5;">{{ session('status') }}</p>
        @endif

        @if ($errors->any())
            <div id="login-errors" role="alert" style="margin-bottom: 20px; padding: 12px; background-color: #fff1f0; border: 1px solid #e6aaa5; border-radius: 6px; color: #a12622; font-size: 14px; line-height: 1.5;">
                @foreach ($errors->all() as $error)
                    <p style="margin: 0;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label for="email" style="display: block; margin-bottom: 8px; font-weight: bold;">
                    Email Address
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    autocomplete="username"
                    @if ($errors->has('email')) aria-invalid="true" aria-describedby="login-errors" @endif
                    required
                    style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 15px;"
                >
            </div>

            <div style="margin-bottom: 25px;">
                <label for="password" style="display: block; margin-bottom: 8px; font-weight: bold;">
                    Password
                </label>

                <div style="position: relative;">
                <input
                    type="password"
                    id="password"
                    name="password"
                    autocomplete="current-password"
                    @if ($errors->has('password')) aria-invalid="true" aria-describedby="login-errors" @endif
                    required
                    style="width: 100%; padding: 12px 48px 12px 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 15px;"
                >
                    <button type="button" id="toggle-password" aria-label="Show password" aria-controls="password" aria-pressed="false"
                        style="position: absolute; top: 0; right: 0; width: 44px; height: 100%; display: flex; align-items: center; justify-content: center; border: none; border-radius: 0 6px 6px 0; background: transparent; color: #176b45; cursor: pointer;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                            <circle cx="12" cy="12" r="3"/>
                            <path id="password-eye-slash" d="M3 3l18 18" style="display: none;"/>
                        </svg>
                    </button>
                </div>
            </div>

            <p style="text-align: right; margin: -10px 0 25px; font-size: 14px;">
                <a href="{{ route('password.request') }}" style="color: #176b45;">Forgot password?</a>
            </p>

            <button
                type="submit"
                style="width: 100%; padding: 13px; background-color: #176b45; color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: bold; cursor: pointer;"
            >
                Log In
            </button>
        </form>

        <p style="text-align: center; margin: 25px 0 0; font-size: 14px;">
            Don't have an account? <a href="{{ route('signup') }}" style="color: #176b45;">Sign Up</a>
        </p>

        <p style="text-align: center; margin: 25px 0 0; font-size: 14px;">
            <a href="/" style="color: #176b45; text-decoration: none;">
                ← Back to Home
            </a>
        </p>

    </div>

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
