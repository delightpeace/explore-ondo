
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
                <input type="password" id="password" name="password" minlength="8" required autocomplete="new-password" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 15px;">
            </div>
            <div style="margin-bottom: 20px;">
                <label for="password_confirmation" style="display: block; margin-bottom: 8px; font-weight: bold;">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" minlength="8" required autocomplete="new-password" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 15px;">
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

</body>
</html>
