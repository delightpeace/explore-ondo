<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Explore places in Ondo | Explore Ondo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css-explore-ondo.css') }}?v={{ md5_file(public_path('css-explore-ondo.css')) }}">
</head>
<body>
    <header class="topbar"><div class="topbar-inner"><a class="brand" href="{{ route('home') }}"><span class="brand-mark" aria-hidden="true">✳</span><span>Explore Ondo</span></a><nav class="topbar-links" aria-label="Main navigation"><a href="{{ route('home') }}">Home</a><a href="{{ route('explore.index') }}">Places</a><a href="{{ route('explore.index', ['category' => 'events']) }}">Festivals</a><a href="{{ route('about-ondo') }}">About Ondo</a><a href="{{ route('people-businesses') }}">People & businesses</a></nav><a class="topbar-cta" href="{{ route('home') }}#newsletter">Stay connected ↗</a></div></header>
    <main class="content-width directory-page">
        <p class="section-kicker">Ondo City directory</p>
        <h1 class="directory-title">{{ $selectedCategory ? $categories[$selectedCategory] : 'Explore all places' }}</h1>
        <p class="directory-intro">Find useful places and local favourites across Ondo City.</p>
        <aside class="people-promo"><div><p class="section-kicker">Stories behind the city</p><p>Meet notable people and discover businesses with roots in Ondo.</p></div><a class="text-link" href="{{ route('people-businesses') }}">Meet the people & businesses <span aria-hidden="true">→</span></a></aside>
        <form class="directory-search" method="get" action="{{ route('explore.index') }}">
            @if ($selectedCategory)<input type="hidden" name="category" value="{{ $selectedCategory }}">@endif
            <label class="sr-only" for="place-search">Search places</label><input id="place-search" type="search" name="q" value="{{ $search }}" placeholder="Search places, areas or services">
            <button type="submit">Search</button>
        </form>
        <nav class="directory-filters" aria-label="Filter places by category"><a class="{{ $selectedCategory === null ? 'is-active' : '' }}" href="{{ route('explore.index') }}">All places</a>@foreach ($categories as $slug => $label)<a class="{{ $selectedCategory === $slug ? 'is-active' : '' }}" href="{{ route('explore.index', ['category' => $slug]) }}">{{ $label }}</a>@endforeach</nav>
        @if ($selectedCategory === 'motor-parks')
            <section class="directory-feature" aria-labelledby="transport-title">
                <p class="section-kicker">Getting around Ondo</p><h2 id="transport-title">Motor parks & transport points</h2>
                <p class="directory-intro">Local reporting names these parks and transport areas in Ondo. Routes and operating times can change; check with drivers before travelling.</p>
                <div class="directory-feature-grid">
                    @foreach ([['Ife Garage Motor Park', 'Ife Garage, Ondo City'], ['Akure Motor Park', 'Ondo–Akure Road, Ondo City'], ['Oka Motor Park', 'Oka, Ondo City'], ['Bolorunduro Motor Park', 'Bolorunduro, Ondo East']] as [$park, $area])
                        <article class="directory-feature-card"><p class="place-location">Transport · {{ $area }}</p><h3>{{ $park }}</h3><a class="place-action" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($park . ', ' . $area . ', Ondo, Nigeria') }}" target="_blank" rel="noopener noreferrer">Find on map <span>↗</span></a></article>
                    @endforeach
                </div>
                <p class="source-note">Park names reported by <a href="https://tribuneonlineng.com/ondo-lawmaker-makinde-lays-foundation-of-four-ultra-mordern-motor-parks/" target="_blank" rel="noopener noreferrer">Nigerian Tribune</a>.</p>
            </section>
        @elseif ($selectedCategory === 'events')
            <section class="directory-feature" aria-labelledby="festival-title">
                <p class="section-kicker">Living traditions</p><h2 id="festival-title">Festivals of Ondo Kingdom</h2>
                <p class="directory-intro">Festival dates are set by local organisers and traditional authorities. Confirm this year’s programme before making travel plans.</p>
                <div class="directory-feature-grid">
                    <article class="directory-feature-card"><p class="place-location">Annual · December</p><h3>Ekimogun Day</h3><p>A homecoming celebration of Ondo heritage, with cultural performances, community events and royal appearances.</p></article>
                    <article class="directory-feature-card"><p class="place-location">Traditional festival</p><h3>Ogun Festival</h3><p>A major Ondo Kingdom festival honouring Ogun, with ceremonies and cultural observances.</p></article>
                    <article class="directory-feature-card"><p class="place-location">Traditional festival · July season</p><h3>Odun Oba (Odunbami)</h3><p>A new-year and planting-season celebration in which the community pays homage to the Osemawe.</p></article>
                    <article class="directory-feature-card"><p class="place-location">Ondo cultural calendar</p><h3>Agheregbe Festival</h3><p>A traditional celebration associated with the Ondo Kingdom’s history and warrior heritage.</p></article>
                </div>
                <p class="source-note">Sources: <a href="https://oedcondo.com/events/" target="_blank" rel="noopener noreferrer">Ondo Ekimogun Dynamic Club</a>, <a href="https://oecsonline.com/entertainment/2025/07/odun-oba-2025/" target="_blank" rel="noopener noreferrer">OECS Online</a>, and <a href="https://www.thehopenewspaper.com/ondo-celebrates-20-years-of-osemawe-coronation/" target="_blank" rel="noopener noreferrer">The Hope Newspaper</a>.</p>
            </section>
        @endif
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
        @elseif (!in_array($selectedCategory, ['motor-parks', 'events'], true))
            <div class="empty-places"><span>✳</span><h3>No places found yet</h3><p>Try another category or search term, or check back as the city guide grows.</p><a class="text-link" href="{{ route('explore.index') }}">View all places →</a></div>
        @endif
    </main>
    <footer class="public-footer"><div class="public-footer-inner"><div class="footer-brand-block"><a class="brand footer-brand" href="{{ route('home') }}"><span class="brand-mark" aria-hidden="true">✳</span><span>Explore Ondo</span></a><p>Discover the Sunshine State.</p></div><nav class="footer-nav" aria-label="Footer navigation"><a href="{{ route('explore.index') }}">Explore places</a><a href="{{ route('about-ondo') }}">About Ondo</a><a href="{{ route('people-businesses') }}">People & businesses</a></nav><div class="footer-contact"><span>Made with care in Ondo, Nigeria</span><a href="{{ route('home') }}#newsletter">Stay connected</a></div><small class="footer-copyright">© {{ date('Y') }} Explore Ondo</small></div></footer>
</body>
</html>
