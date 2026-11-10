<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Newsletter signups | Explore Ondo</title>
    <style>
        body { margin: 0; padding: 32px; background: #f4f7f5; color: #26352d; font: 15px Arial, sans-serif; }
        main { max-width: 900px; margin: 0 auto; padding: 28px; border-radius: 12px; background: white; box-shadow: 0 4px 15px #0000000c; }
        h1 { color: #176b45; }
        .back { color: #176b45; font-weight: bold; text-decoration: none; }
        table { width: 100%; margin-top: 24px; border-collapse: collapse; text-align: left; }
        th, td { padding: 13px 10px; border-bottom: 1px solid #e4e9e5; }
        th { color: #5d6b61; font-size: 12px; text-transform: uppercase; letter-spacing: .7px; }
        .empty { padding: 28px 0; color: #68736b; }
        .pagination { margin-top: 20px; }
        @media (max-width: 550px) { body { padding: 14px; } main { padding: 18px; } }
    </style>
</head>
<body>
    <main>
        <a class="back" href="{{ route('places') }}">← Back to place manager</a>
        <h1>Newsletter signups</h1>
        <p>{{ $subscribers->total() }} email {{ \Illuminate\Support\Str::plural('address', $subscribers->total()) }} signed up for Explore Ondo updates.</p>
        @if ($subscribers->isNotEmpty())
            <table>
                <thead><tr><th>Email address</th><th>Signup date</th></tr></thead>
                <tbody>
                    @foreach ($subscribers as $subscriber)
                        <tr><td>{{ $subscriber->email }}</td><td>{{ \Illuminate\Support\Carbon::parse($subscriber->subscribed_at)->format('M j, Y') }}</td></tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">{{ $subscribers->links() }}</div>
        @else
            <p class="empty">No one has signed up yet.</p>
        @endif
    </main>
</body>
</html>
