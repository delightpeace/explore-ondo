<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <title>Dashboard | Explore Ondo Admin</title>
    <link rel="stylesheet" href="{{ asset('css-admin-sidebar.css') }}?v={{ md5_file(public_path('css-admin-sidebar.css')) }}">
    <style>
        body { margin: 0; background: #f6f7f2; color: #1c2b24; font: 14px 'DM Sans', Arial, sans-serif; }
        .eyebrow { margin: 0 0 8px; color: #7d8b48; font-size: 10px; font-weight: 700; letter-spacing: 1.8px; text-transform: uppercase; }
        h1, h2, p { margin-top: 0; }.page-heading h1 { margin-bottom: 7px; font: 600 36px 'Playfair Display', Georgia, serif; }.page-heading > p:last-child { color: #68736b; font-size: 13px; }
        .summary-grid { display: grid; grid-template-columns: repeat(2, minmax(180px, 1fr)); gap: 14px; max-width: 850px; margin-top: 28px; }
        .summary-card { padding: 20px; border: 1px solid #e4e8df; border-radius: 9px; background: #fff; text-decoration: none; box-shadow: 0 5px 22px #1c2b2408; }
        .summary-card span { display: block; margin-bottom: 10px; color: #68736b; font-size: 11px; }.summary-card strong { color: #153f31; font-size: 28px; }.summary-card:hover { border-color: #b6c58a; }
        @media(max-width:700px) { .admin-page-content { padding: 22px 16px 32px !important; }.summary-grid { grid-template-columns: 1fr 1fr; gap: 8px; }.summary-card { padding: 15px; } }
    </style>
</head>
<body>
    @include('partials.admin-topbar')
    <div class="admin-shell">
        @include('partials.admin-sidebar')
        <main class="admin-page-content">
            <section class="page-heading"><p class="eyebrow">Your workspace</p><h1>Dashboard</h1><p>Welcome back, Administrator.</p></section>
            <section class="summary-grid" aria-label="Website content overview">
                <a class="summary-card" href="{{ route('places') }}"><span>Places</span><strong>{{ $placeCount }}</strong></a>
                <a class="summary-card" href="{{ route('admin.categories') }}"><span>Categories</span><strong>{{ $categoryCount }}</strong></a>
                <a class="summary-card" href="{{ route('admin.featured-profiles') }}"><span>People & businesses</span><strong>{{ $profileCount }}</strong></a>
                <a class="summary-card" href="{{ route('newsletter.subscribers') }}"><span>Newsletter emails</span><strong>{{ $subscriberCount }}</strong></a>
            </section>
        </main>
    </div>
</body>
</html>
