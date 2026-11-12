<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Meet notable people with roots in Ondo and explore local businesses.">
    <title>People & businesses | Explore Ondo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css-explore-ondo.css') }}?v={{ md5_file(public_path('css-explore-ondo.css')) }}">
    @endif
</head>
<body>
    <header class="topbar"><div class="topbar-inner"><a class="brand" href="{{ route('home') }}"><span class="brand-mark" aria-hidden="true">✳</span><span>Explore Ondo</span></a><nav class="topbar-links" aria-label="Main navigation"><a href="{{ route('home') }}">Home</a><a href="{{ route('explore.index') }}">Places</a><a href="{{ route('explore.index', ['category' => 'events']) }}">Festivals</a><a href="{{ route('about-ondo') }}">About Ondo</a><a href="{{ route('people-businesses') }}" aria-current="page">People & businesses</a></nav><a class="topbar-cta" href="{{ route('home') }}#newsletter">Stay connected ↗</a></div></header>
    <main class="content-width people-page">
        <a class="text-link back-link" href="{{ route('home') }}">← Back to Explore Ondo</a>
        <section class="people-hero">
            <div><p class="section-kicker">The people behind the place</p><h1>People & businesses<br>of Ondo.</h1><p class="story-lede">Meet people with Ondo roots and find the local places and businesses that bring the city to life.</p></div>
            <nav class="people-jump-links" aria-label="On this page"><a href="#notable-people">Notable people <span>↘</span></a><a href="#local-businesses">Local businesses <span>↘</span></a></nav>
        </section>

        <section class="people-section" id="notable-people">
            <div class="section-heading"><div><p class="section-kicker">Notable people</p>
                <h2>Lives and work with Ondo roots</h2></div><span class="people-count">Featured stories</span></div>
            <div class="people-grid">
                <article class="person-card"><div class="person-portrait person-portrait-gf" aria-hidden="true"><span>GF</span></div>
                    <div class="person-copy"><p class="person-meta">Lawyer · publisher · human rights advocate</p><h3>Gani Fawehinmi</h3>
                    <p>Born in Ondo in 1938, Gani Fawehinmi became one of Nigeria’s best-known lawyers and advocates for human rights and public accountability.</p>
                    <a class="text-link" href="https://www.osgf.gov.ng/storage/app/media/pdf/Profiles%20of%20the%20National%20Awardees.pdf" target="_blank" rel="noopener noreferrer">Read his profile <span aria-hidden="true">↗</span></a></div></article>
                <article class="person-card"><div class="person-portrait person-portrait-sa" aria-hidden="true"><span>SA</span></div><div class="person-copy"><p class="person-meta">Jùjú musician · Ondo family roots</p><h3>King Sunny Adé</h3><p>A renowned Nigerian Jùjú musician whose father was from Ondo City. King Sunny Adé was born in Osogbo.</p><a class="text-link" href="https://dawncommission.org/otunba-king-sunny-ade-mfr-at-80-the-global-king-of-juju-music/" target="_blank" rel="noopener noreferrer">Read about his Ondo connection <span aria-hidden="true">↗</span></a></div></article>
                <article class="person-card"><div class="person-portrait person-portrait-biodun"><img src="https://biodunbamigboye.com/images/image1.png" alt="Biodun Bamigboye" loading="lazy"></div><div class="person-copy"><p class="person-meta">Software engineer · education technology</p><h3>Biodun Bamigboye</h3><p>His profile describes more than a decade working in educational technology, building school management systems and AI-supported learning tools. He is listed as founder and CTO of Hunnovate.</p><a class="text-link" href="https://biodunbamigboye.com/" target="_blank" rel="noopener noreferrer">Visit his official profile <span aria-hidden="true">↗</span></a></div></article>
            </div>
            <p class="profile-coming-soon">Profile and portrait for Biodun Bamigboye are from his <a href="https://biodunbamigboye.com/" target="_blank" rel="noopener noreferrer">official website</a>.</p>
        </section>

        <section class="people-section businesses-section" id="local-businesses">
            <div class="section-heading"><div><p class="section-kicker">Local businesses</p><h2>Meet the businesses of Ondo</h2></div><a class="text-link" href="{{ route('explore.index') }}">Browse all places <span aria-hidden="true">→</span></a></div>
            <div class="featured-business-grid">
                <article class="featured-business-card"><div class="featured-business-mark" aria-hidden="true">H</div><p class="person-meta">Technology · Ondo City</p><h3>Hunnovate</h3><p>A technology company in Ondo City working across programming and software development.</p><a class="text-link" href="https://hunnovate.com" target="_blank" rel="noopener noreferrer">Visit Hunnovate <span aria-hidden="true">↗</span></a></article>
                <article class="featured-business-card"><div class="featured-business-mark" aria-hidden="true">C</div><p class="person-meta">Local brand · Ondo City</p><h3>Charis Brand</h3><p>A local brand featured in the Explore Ondo business guide.</p></article>
                <article class="featured-business-card"><div class="featured-business-mark" aria-hidden="true">GE</div><p class="person-meta">Interiors · Ondo City</p><h3>GE Interiors</h3><p>An interiors business featured in the Explore Ondo business guide.</p></article>
            </div>
            <aside class="advertise-banner">
                <div><p class="section-kicker">Own a local business?</p><h3>Put your business in the picture.</h3><p>Reach people exploring Ondo. Contact us to ask about advertising your business on this page.</p></div>
                <div class="advertise-actions"><a class="advertise-button" href="tel:+2347033410902">Call 0703 341 0902</a><a class="advertise-email" href="mailto:delightadebisi056@gmail.com?subject=Advertise%20on%20Explore%20Ondo">Email us ↗</a></div>
            </aside>
            <div class="business-listing-heading"><p class="section-kicker">Places to discover</p><h3>More local favourites</h3></div>
            <article class="business-feature">
                <div class="business-feature-copy"><p class="section-kicker">A local stay · Igbado</p><h3>Nibanola Motherland Resort & Golf</h3><p>A resort and leisure destination on Ondo-Ore Road in Ondo City.</p><a class="button" href="https://www.nibanola.com/" target="_blank" rel="noopener noreferrer">Visit Nibanola <span aria-hidden="true">↗</span></a></div>
                <div class="business-feature-mark" aria-hidden="true">N</div>
            </article>
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
    <footer class="public-footer"><div class="public-footer-inner"><div class="footer-brand-block"><a class="brand footer-brand" href="{{ route('home') }}"><span class="brand-mark" aria-hidden="true">✳</span><span>Explore Ondo</span></a><p>Discover the Sunshine State.</p></div><nav class="footer-nav" aria-label="Footer navigation"><a href="{{ route('explore.index') }}">Explore places</a><a href="{{ route('about-ondo') }}">About Ondo</a><a href="{{ route('people-businesses') }}">People & businesses</a></nav><div class="footer-contact"><span>Made with care in Ondo, Nigeria</span><a href="{{ route('home') }}#newsletter">Stay connected</a></div><small class="footer-copyright">© {{ date('Y') }} Explore Ondo</small></div></footer>
</body>
</html>
