<!doctype html>
<html lang="en">
<body style="margin:0;padding:32px 12px;background:#f6f7f2;color:#1c2b24;font-family:Arial,sans-serif;">
    <main style="max-width:580px;margin:0 auto;padding:36px 32px;border-radius:14px;background:#fff;">
        <p style="margin:0 0 18px;color:#768347;font-size:12px;font-weight:bold;letter-spacing:2px;text-transform:uppercase;">Explore Ondo</p>
        <h1 style="margin:0 0 18px;color:#153f31;font-family:Georgia,serif;font-size:30px;line-height:1.25;">{{ $greeting['title'] }}</h1>
        <p style="margin:0;color:#536157;font-size:15px;line-height:1.8;">{{ $greeting['message'] }}</p>
        <p style="margin:26px 0 0;"><a href="{{ route('home') }}" style="display:inline-block;padding:13px 18px;border-radius:7px;background:#153f31;color:#fff;font-size:13px;font-weight:bold;text-decoration:none;">{{ $greeting['button'] }}</a></p>
        <p style="margin:32px 0 0;padding-top:18px;border-top:1px solid #e5e7df;color:#788379;font-size:11px;line-height:1.6;">You’re receiving this because you signed up for Explore Ondo email updates.</p>
    </main>
</body>
</html>

