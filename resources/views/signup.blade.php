
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Explore Ondo</title>
</head>

<body style="margin: 0; min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: Arial, sans-serif; background-color: #f4f7f5; color: #26352d; padding: 20px; box-sizing: border-box;">

    <div style="width: 100%; max-width: 400px; padding: 35px; background-color: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); box-sizing: border-box;">

        <h1 style="text-align: center; color: #176b45; margin: 0 0 10px;">
            Explore Ondo
        </h1>

        <p style="text-align: center; color: #6b786f; margin-bottom: 30px;">
            Create Your Account
        </p>

        @if (session('status'))
            <p role="status" style="padding: 12px; background-color: #eaf5ee; border-radius: 6px; color: #176b45; line-height: 1.5;">{{ session('status') }}</p>
        @endif

        @if ($errors->any())
            <div id="signup-errors" role="alert" style="margin-bottom: 20px; padding: 12px; background-color: #fff1f0; border: 1px solid #e6aaa5; border-radius: 6px; color: #a12622; font-size: 14px; line-height: 1.5;">
                @foreach ($errors->all() as $error)
                    <p style="margin: 0;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('signup.submit') }}" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label for="name" style="display: block; margin-bottom: 8px; font-weight: bold;">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" autocomplete="name" maxlength="255" required
                    @if ($errors->has('name')) aria-invalid="true" aria-describedby="signup-errors" @endif
                    style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 15px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="email" style="display: block; margin-bottom: 8px; font-weight: bold;">
                    Email Address
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    maxlength="255"
                    @if ($errors->has('email')) aria-invalid="true" aria-describedby="signup-errors" @endif
                    required
                    style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 15px;"
                >
            </div>

            <div style="margin-bottom: 25px;">
                <label for="password" style="display: block; margin-bottom: 8px; font-weight: bold;">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    autocomplete="new-password"
                    minlength="8"
                    aria-describedby="password-hint{{ $errors->has('password') ? ' signup-errors' : '' }}"
                    @if ($errors->has('password')) aria-invalid="true" @endif
                    required
                    style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 15px;"
                >
            </div>

            <p id="password-hint" style="font-size: 14px; color: #6b786f;">Use at least 8 characters for your password.</p>
            <div style="margin-bottom: 25px;">
                <label for="password_confirmation" style="display: block; margin-bottom: 8px; font-weight: bold;">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" minlength="8" required
                    style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 15px;">
            </div>

            <button
                type="submit"
                style="width: 100%; padding: 13px; background-color: #176b45; color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: bold; cursor: pointer;"
            >
                Create Your Account
            </button>
        </form>

        <p style="text-align: center; margin: 25px 0 0; font-size: 14px;">
            Already have an account? <a href="{{ route('login') }}" style="color: #176b45;">Log In</a>
        </p>

        <p style="text-align: center; margin: 25px 0 0; font-size: 14px;">
            <a href="{{ route('home') }}" style="color: #176b45; text-decoration: none;">
                ← Back to Home
            </a>
        </p>

    </div>

</body>
</html>
