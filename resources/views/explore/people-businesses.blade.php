<!doctype html>
<html lang="en">
<head>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Meet notable people with roots in Ondo and explore local businesses.">
    <title>People & businesses | Explore Ondo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css-explore-ondo.css') }}?v={{ md5_file(public_path('css-explore-ondo.css')) }}">
</head>
<body>
    <header class="topbar"><div class="topbar-inner"><a class="brand" href="{{ route('home') }}"><img class="brand-mark" src="{{ asset('ondo-sun-mark.svg') }}" alt=""><span>Explore Ondo</span></a><nav class="topbar-links" aria-label="Main navigation"><a href="{{ route('home') }}">Home</a><a href="{{ route('explore.index') }}">Places</a><a href="{{ route('explore.index', ['category' => 'events']) }}">Festivals</a><a href="{{ route('about-ondo') }}">About Ondo</a><a href="{{ route('people-businesses') }}" aria-current="page">People & businesses</a></nav><a class="topbar-cta" href="{{ route('home') }}#newsletter">Stay connected ↗</a></div></header>
    <main class="content-width people-page">
        <a class="text-link back-link" href="{{ route('home') }}">← Back to Explore Ondo</a>
        <section class="people-hero">
            <div><p class="section-kicker">The people behind the place</p><h1>People & businesses<br>of Ondo.</h1><p class="story-lede">Meet people with Ondo roots and find the local places and businesses that bring the city to life.</p></div>
            <nav class="people-jump-links" aria-label="On this page"><a href="#notable-people">Notable people <span>↘</span></a><a href="#local-businesses">Local businesses <span>↘</span></a></nav>
        </section>

        <section class="people-section" id="notable-people">
            <div class="section-heading"><div><p class="section-kicker">Notable people</p>
                <h2>Lives and work with Ondo roots</h2></div><span class="people-count">{{ $people->count() }} featured {{ \Illuminate\Support\Str::plural('story', $people->count()) }}</span></div>
            <div class="people-grid">
                @forelse ($people as $person)
                    <article class="person-card">
                        <div class="person-portrait">
                            @if ($person->image_url)
                                <img src="{{ $person->image_url }}" alt="{{ $person->name }}" loading="lazy">
                            @else
                                <span aria-hidden="true">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($person->name, 0, 1)) }}</span>
                            @endif
                        </div>
                        <div class="person-copy"><p class="person-meta">{{ $person->subtitle }}</p><h3>{{ $person->name }}</h3><p>{{ $person->description }}</p>
                            @if ($person->website_url)<a class="text-link" href="{{ $person->website_url }}" target="_blank" rel="noopener noreferrer">Read more <span aria-hidden="true">↗</span></a>@endif
                        </div>
                    </article>
                @empty
                    <div class="business-empty"><h3>People profiles are coming soon.</h3><p>Featured stories will appear here as they are added.</p></div>
                @endforelse
            </div>
        </section>

        <section class="people-section businesses-section" id="local-businesses">
            <div class="section-heading"><div><p class="section-kicker">Local businesses</p><h2>Meet the businesses of Ondo</h2></div><a class="text-link" href="{{ route('explore.index') }}">Browse all places <span aria-hidden="true">→</span></a></div>
            <div class="featured-business-grid">
                @forelse ($featuredBusinesses as $businessProfile)
                    <article class="featured-business-card">
                        <div class="featured-business-mark">
                            @if ($businessProfile->image_url)<img src="{{ $businessProfile->image_url }}" alt="" loading="lazy">@else{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($businessProfile->name, 0, 1)) }}@endif
                        </div>
                        <p class="person-meta">{{ $businessProfile->subtitle }}</p><h3>{{ $businessProfile->name }}</h3><p>{{ $businessProfile->description }}</p>
                        @if ($businessProfile->website_url)<a class="text-link" href="{{ $businessProfile->website_url }}" target="_blank" rel="noopener noreferrer">Visit business <span aria-hidden="true">↗</span></a>@endif
                    </article>
                @empty
                    <div class="business-empty"><h3>Business profiles are coming soon.</h3><p>Featured businesses will appear here as they are added.</p></div>
                @endforelse
            </div>
            <aside class="advertise-banner">
                <div><p class="section-kicker">Own a local business?</p><h3>Put your business in the picture.</h3><p>Reach people exploring Ondo. Contact us to ask about advertising your business on this page.</p></div>
                <div class="advertise-actions"><a class="advertise-button" href="tel:+2347033410902">Call 0703 341 0902</a><a class="advertise-email" href="mailto:delightadebisi056@gmail.com?subject=Advertise%20on%20Explore%20Ondo">Email us ↗</a></div>
            </aside>
            <div class="business-listing-heading"><p class="section-kicker">Places to discover</p><h3>More local favourites</h3></div>
            @if ($businesses->isNotEmpty())
                <div class="business-grid">
                    @foreach ($businesses as $business)
                        <article class="business-card">
                            @if ($business->images->isNotEmpty())
                                <a class="business-image" href="{{ route('explore.show', $business) }}"><img src="{{ asset('storage/' . $business->images->first()->path) }}" alt="{{ $business->images->first()->label ?: $business->name }}" loading="lazy"></a>
                            @else
                                <a class="business-placeholder" href="{{ route('explore.show', $business) }}" aria-label="View {{ $business->name }}"><span>✳</span></a>
                            @endif
                            <div class="business-card-copy"><p class="person-meta">{{ ucfirst($business->category) }} <span>·</span> Ondo City</p><h3>{{ $business->name }}</h3><p>{{ \Illuminate\Support\Str::limit($business->description, 130) }}</p><a class="text-link" href="{{ route('explore.show', $business) }}">View place <span aria-hidden="true">→</span></a></div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="business-empty"><h3>Local listings are coming soon.</h3><p>We’re adding places and businesses to the Ondo City directory.</p><a class="text-link" href="{{ route('explore.index') }}">Browse the directory →</a></div>
            @endif
        </section>
        <aside class="people-submit"><p class="section-kicker">Know someone we should feature?</p><p>Explore the places directory to discover more of the people and businesses around Ondo.</p><a class="text-link" href="{{ route('explore.index') }}">Explore Ondo places <span aria-hidden="true">→</span></a></aside>
    </main>
    <footer class="public-footer"><div class="public-footer-inner"><div class="footer-brand-block"><a class="brand footer-brand" href="{{ route('home') }}"><img class="brand-mark" src="{{ asset('ondo-sun-mark.svg') }}" alt=""><span>Explore Ondo</span></a><p>Discover the Sunshine State.</p></div><nav class="footer-nav" aria-label="Footer navigation"><a href="{{ route('explore.index') }}">Explore places</a><a href="{{ route('about-ondo') }}">About Ondo</a><a href="{{ route('people-businesses') }}">People & businesses</a></nav><div class="footer-contact"><span>Made with care in Ondo, Nigeria</span><a href="{{ route('home') }}#newsletter">Stay connected</a></div><small class="footer-copyright">© {{ date('Y') }} Explore Ondo</small></div></footer>
</body>
</html>
