
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Explore Ondo</title>
    <style>
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        #send-code-button:disabled {
            opacity: 0.7;
            cursor: wait;
        }

        #send-code-spinner {
            display: inline-block;
            width: 14px;
            height: 14px;
            margin-right: 8px;
            border: 2px solid rgba(255, 255, 255, 0.4);
            border-top-color: white;
            border-radius: 50%;
            vertical-align: middle;
            animation: spin 0.8s linear infinite;
        }

        #send-code-spinner[hidden] {
            display: none;
        }

        @media (prefers-reduced-motion: reduce) {
            #send-code-spinner { animation: none; }
        }
    </style>
</head>

<body style="margin: 0; min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: Arial, sans-serif; background-color: #f4f7f5; color: #26352d; padding: 20px; box-sizing: border-box;">

    <div style="width: 100%; max-width: 400px; padding: 35px; background-color: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); box-sizing: border-box;">

        <h1 style="text-align: center; color: #176b45; margin: 0 0 10px;">
            Explore Ondo
        </h1>

        <p style="text-align: center; color: #6b786f; margin-bottom: 30px;">
            Forgot Password
        </p>

        <p style="color: #6b786f; line-height: 1.5;">Enter your email address to request a password reset code.</p>

        <form id="forgot-password-form" action="{{ route('requestEMailToResetPassword') }}" method="POST" style="margin-top: 20px;">
            @csrf
            <div style="margin-bottom: 20px;">
                <label for="email" style="display: block; margin-bottom: 8px; font-weight: bold;">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 15px;">
            </div>
            <button id="send-code-button" type="submit" style="width: 100%; padding: 13px; background-color: #176b45; color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: bold; cursor: pointer;">
                <span id="send-code-spinner" aria-hidden="true" hidden></span>
                <span id="send-code-label" role="status" aria-live="polite">Send Code</span>
            </button>
            @if ($errors->any())
                <div style="margin-top: 20px; color: red;">
                    <ul style="list-style-type: none; padding: 0; margin: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div style="margin-top: 20px; color: green;">
                    {{ session('success') }}
                </div>
            @endif
        </form>
        <script>
            const forgotPasswordForm = document.getElementById('forgot-password-form');
            const sendCodeButton = document.getElementById('send-code-button');
            const sendCodeSpinner = document.getElementById('send-code-spinner');
            const sendCodeLabel = document.getElementById('send-code-label');

            forgotPasswordForm.addEventListener('submit', function (event) {
                if (sendCodeButton.disabled) {
                    event.preventDefault();
                    return;
                }

                sendCodeButton.disabled = true;
                sendCodeButton.setAttribute('aria-busy', 'true');
                sendCodeSpinner.hidden = false;
                sendCodeLabel.textContent = 'Sending…';
            });

            window.addEventListener('pageshow', function () {
                sendCodeButton.disabled = false;
                sendCodeButton.removeAttribute('aria-busy');
                sendCodeSpinner.hidden = true;
                sendCodeLabel.textContent = 'Send Code';
            });
        </script>

        <p style="text-align: center; margin: 25px 0 0; font-size: 14px;">
            <a href="{{ route('login') }}" style="color: #176b45; text-decoration: none;">
                ← Back to Log In
            </a>
        </p>

    </div>

</body>
</html>
