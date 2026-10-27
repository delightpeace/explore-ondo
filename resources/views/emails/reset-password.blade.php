<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password | Explore Ondo</title>
</head>
<body style="margin: 0; padding: 24px 12px; background-color: #f4f7f5; font-family: Arial, sans-serif; color: #26352d;">
    <div style="display: none; max-height: 0; overflow: hidden;">Use your reset code to choose a new Explore Ondo password.</div>

    <table role="presentation" style="width: 100%; border-collapse: collapse;">
        <tr>
            <td align="center">
                <table role="presentation" style="width: 100%; max-width: 520px; border-collapse: collapse; background-color: #ffffff;">
                    <tr>
                        <td style="padding: 32px 24px;">
                            <h1 style="margin: 0 0 24px; color: #176b45; font-size: 28px; text-align: center;">Explore Ondo</h1>
                            <h2 style="margin: 0 0 16px; font-size: 22px;">Reset your password</h2>
                            <p style="margin: 0 0 16px; line-height: 1.6;">
                                We received a password reset request for <strong style="overflow-wrap: anywhere;">{{ $email }}</strong>.
                            </p>
                            <p style="margin: 0 0 16px; line-height: 1.6;">
                                Enter this code on the password reset page, then enter and confirm your new password.
                            </p>

                            <div style="margin: 24px 0; padding: 20px; border: 1px solid #cfe3d6; background-color: #eef6f0; color: #176b45; text-align: center;">
                                <p style="margin: 0 0 8px; font-size: 14px;">Your password reset code</p>
                                <p style="margin: 0; font-size: 28px; font-weight: bold; overflow-wrap: anywhere;">{{ $token }}</p>
                            </div>

                            <p style="margin: 0 0 16px; line-height: 1.6;">Keep this code private. Never share it with anyone.</p>
                            <p style="margin: 0 0 24px; line-height: 1.6; color: #6b786f;">
                                If you did not request a password reset, you can ignore this email. Your password will remain unchanged.
                            </p>
                            <p style="margin: 0; line-height: 1.6;">The Explore Ondo team</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
