
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Explore Ondo</title>
</head>

<body style="margin: 0; min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: Arial, sans-serif; background-color: #f4f7f5; color: #26352d; padding: 20px; box-sizing: border-box;">

    <div style="width: 100%; max-width: 400px; padding: 35px; background-color: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); box-sizing: border-box;">

        <h1 style="text-align: center; color: #176b45; margin: 0 0 10px;">
            Explore Ondo
        </h1>

        <p style="text-align: center; color: #6b786f; margin-bottom: 30px;">
            Reset Password
        </p>

        <p style="color: #6b786f; line-height: 1.5;">Enter the code from your email and choose a new password.</p>
        <p id="reset-email" style="color: #6b786f; font-size: 14px; overflow-wrap: anywhere;">{{ $email }}</p>
        @if (session('status'))
            <p role="status" style="color: #176b45; line-height: 1.5;">{{ session('status') }}</p>
        @endif
        @if ($errors->any())
            <div role="alert" style="color: #a12622; margin-bottom: 20px;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <form id="reset-password-form" method="POST" action="{{ route('password.update') }}">
            @csrf
            <div style="margin-bottom: 20px;">
                <label for="code" style="display: block; margin-bottom: 8px; font-weight: bold;">Email Code</label>
                <input type="text" id="code" name="code" required autocomplete="one-time-code" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 15px;">
            </div>
            <div style="margin-bottom: 20px;">
                <label for="password" style="display: block; margin-bottom: 8px; font-weight: bold;">New Password</label>
                <div style="position: relative;">
                    <input type="password" id="password" name="password" minlength="8" required autocomplete="new-password" style="width: 100%; padding: 12px 48px 12px 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 15px;">
                    <button type="button" data-password-toggle="password" data-password-label="new password" aria-label="Show new password" aria-controls="password" aria-pressed="false"
                        style="position: absolute; top: 0; right: 0; width: 44px; height: 100%; display: flex; align-items: center; justify-content: center; border: none; border-radius: 0 6px 6px 0; background: transparent; color: #176b45; cursor: pointer;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                            <circle cx="12" cy="12" r="3"/>
                            <path data-eye-slash d="M3 3l18 18" style="display: none;"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div style="margin-bottom: 20px;">
                <label for="password_confirmation" style="display: block; margin-bottom: 8px; font-weight: bold;">Confirm New Password</label>
                <div style="position: relative;">
                    <input type="password" id="password_confirmation" name="password_confirmation" minlength="8" required autocomplete="new-password" style="width: 100%; padding: 12px 48px 12px 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 15px;">
                    <button type="button" data-password-toggle="password_confirmation" data-password-label="confirmed password" aria-label="Show confirmed password" aria-controls="password_confirmation" aria-pressed="false"
                        style="position: absolute; top: 0; right: 0; width: 44px; height: 100%; display: flex; align-items: center; justify-content: center; border: none; border-radius: 0 6px 6px 0; background: transparent; color: #176b45; cursor: pointer;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                            <circle cx="12" cy="12" r="3"/>
                            <path data-eye-slash d="M3 3l18 18" style="display: none;"/>
                        </svg>
                    </button>
                </div>
            </div>
            <button type="submit" style="width: 100%; padding: 13px; background-color: #176b45; color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: bold; cursor: pointer;">Send</button>
        </form>
        <p style="font-size: 14px;"><a href="{{ route('password.request') }}" style="color: #176b45;">Request a new code</a></p>

        <p style="text-align: center; margin: 25px 0 0; font-size: 14px;">
            <a href="{{ route('login') }}" style="color: #176b45; text-decoration: none;">
                ← Back to Log In
            </a>
        </p>

    </div>

<script>
    document.querySelectorAll('[data-password-toggle]').forEach(function (button) {
        const input = document.getElementById(button.dataset.passwordToggle);
        const slash = button.querySelector('[data-eye-slash]');

        function setVisibility(visible) {
            input.type = visible ? 'text' : 'password';
            button.setAttribute('aria-label', (visible ? 'Hide ' : 'Show ') + button.dataset.passwordLabel);
            button.setAttribute('aria-pressed', String(visible));
            slash.style.display = visible ? '' : 'none';
        }

        button.addEventListener('click', function () {
            setVisibility(input.type === 'password');
        });

        window.addEventListener('pageshow', function () {
            setVisibility(false);
        });
    });
</script>
</body>
</html>
