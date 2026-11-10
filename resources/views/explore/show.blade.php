<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $place->name }} | Explore Ondo</title>
    <meta name="description" content="{{ \Illuminate\Support\Str::limit($place->description, 155) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css-explore-ondo.css') }}">
    @endif
</head>
<body>
    <header class="site-header"><a class="brand" href="{{ route('home') }}"><span class="brand-mark">✳</span><span>explore<span class="brand-accent">ondo</span></span></a><nav class="main-nav"><a href="{{ route('home') }}">Home</a><a href="{{ route('explore.index') }}">Explore places</a></nav><a class="button button-small" href="{{ route('home') }}#newsletter">Get city updates ↗</a></header>
    <main class="content-width detail-page">
        <a class="text-link back-link" href="{{ route('explore.index') }}">← Back to places</a>
        <article class="place-detail">
            <div class="detail-gallery">
                @forelse ($place->images as $image)
                    <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->label ?: $place->name }}" loading="lazy">
                @empty
                    <div class="place-image-placeholder"><span>✳</span><small>Discover Ondo</small></div>
                @endforelse
            </div>
            <div class="detail-copy">
                <p class="section-kicker">{{ $categoryName ?? 'Discover Ondo City' }}</p>
                <h1>{{ $place->name }}</h1>
                <p class="detail-address">⌖ {{ $place->address }}</p>
                <div class="detail-description">{{ $place->description }}</div>
                @if ($place->lat !== null && $place->lng !== null)
                    <a class="button" href="https://www.google.com/maps?q={{ $place->lat }},{{ $place->lng }}" target="_blank" rel="noopener noreferrer">Get directions ↗</a>
                @endif
            </div>
        </article>
    </main>
    <footer class="site-footer"><a class="brand footer-brand" href="{{ route('home') }}"><span class="brand-mark">✳</span><span>explore<span class="brand-accent">ondo</span></span></a><p>A city guide made with care in Ondo, Nigeria.</p><span>© {{ date('Y') }} Explore Ondo</span></footer>
</body>
</html>
