<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Explore places in Ondo | Explore Ondo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css-explore-ondo.css') }}">
    @endif
</head>
<body>
    <header class="site-header"><a class="brand" href="{{ route('home') }}"><span class="brand-mark">✳</span><span>explore<span class="brand-accent">ondo</span></span></a><nav class="main-nav"><a href="{{ route('home') }}">Home</a><a href="{{ route('explore.index') }}">All places</a></nav><a class="button button-small" href="{{ route('home') }}#newsletter">Get city updates ↗</a></header>
    <main class="content-width directory-page">
        <p class="section-kicker">Ondo City directory</p>
        <h1 class="directory-title">{{ $selectedCategory ? $categories[$selectedCategory] : 'Explore all places' }}</h1>
        <p class="directory-intro">Find useful places and local favourites across Ondo City.</p>
        <form class="directory-search" method="get" action="{{ route('explore.index') }}">
            @if ($selectedCategory)<input type="hidden" name="category" value="{{ $selectedCategory }}">@endif
            <label class="sr-only" for="place-search">Search places</label><input id="place-search" type="search" name="q" value="{{ $search }}" placeholder="Search places, areas or services">
            <button type="submit">Search</button>
        </form>
        <nav class="directory-filters" aria-label="Filter places by category"><a class="{{ $selectedCategory === null ? 'is-active' : '' }}" href="{{ route('explore.index') }}">All places</a>@foreach ($categories as $slug => $label)<a class="{{ $selectedCategory === $slug ? 'is-active' : '' }}" href="{{ route('explore.index', ['category' => $slug]) }}">{{ $label }}</a>@endforeach</nav>
        <div class="directory-results"><span>{{ $places->total() }} {{ \Illuminate\Support\Str::plural('place', $places->total()) }}</span>@if ($search)<span>matching “{{ $search }}”</span>@endif</div>
        @if ($places->isNotEmpty())
            <div class="place-grid directory-grid">
                @foreach ($places as $place)
                    <article class="place-card">
                        @if ($place->images->isNotEmpty())
                            @php($coverImage = $place->images->first())
                            <a class="place-image-wrap" href="{{ route('explore.show', $place) }}"><img class="place-image" src="{{ asset('storage/' . $coverImage->path) }}" alt="{{ $coverImage->label ?: $place->name }}" loading="lazy"></a>
                        @else
                            <a class="place-image-placeholder" href="{{ route('explore.show', $place) }}"><span>✳</span><small>Discover Ondo</small></a>
                        @endif
                        <div class="place-card-body"><p class="place-location">{{ $categories[$place->category] ?? 'Ondo City' }}</p><h2><a href="{{ route('explore.show', $place) }}">{{ $place->name }}</a></h2><p class="place-description">{{ \Illuminate\Support\Str::limit($place->description, 125) }}</p><a class="place-action" href="{{ route('explore.show', $place) }}">View details <span>→</span></a></div>
                    </article>
                @endforeach
            </div>
            <div class="directory-pagination">{{ $places->links() }}</div>
        @else
            <div class="empty-places"><span>✳</span><h3>No places found yet</h3><p>Try another category or search term, or check back as the city guide grows.</p><a class="text-link" href="{{ route('explore.index') }}">View all places →</a></div>
        @endif
    </main>
    <footer class="site-footer"><a class="brand footer-brand" href="{{ route('home') }}"><span class="brand-mark">✳</span><span>explore<span class="brand-accent">ondo</span></span></a><p>A city guide made with care in Ondo, Nigeria.</p><span>© {{ date('Y') }} Explore Ondo</span></footer>
</body>
</html>
