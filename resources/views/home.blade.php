<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#153f31">
    <meta name="description" content="Discover places, people, culture and everyday life in Ondo City.">
    <title>Explore Ondo — Find your place in the city</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css-explore-ondo.css') }}?v={{ md5_file(public_path('css-explore-ondo.css')) }}">
    @endif
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <a class="brand" href="{{ route('home') }}" aria-label="Explore Ondo home"><span class="brand-mark" aria-hidden="true">✳</span><span>Explore Ondo</span></a>
            <nav class="topbar-links" aria-label="Main navigation">
                <a href="#discover">Discover</a>
                <a href="#places">Places</a>
                <a href="{{ route('explore.index', ['category' => 'events']) }}">Festivals</a>
                <a href="{{ route('about-ondo') }}">About Ondo</a>
                <a href="{{ route('people-businesses') }}">People & businesses</a>
            </nav>
            <a class="topbar-cta" href="#newsletter">Stay connected <span aria-hidden="true">↗</span></a>
        </div>
    </header>

    <main>
        <section class="hero" aria-labelledby="hero-title">
            <div class="hero-shade"></div>
            <div class="hero-content">
                <p class="eyebrow">A city of heritage, warmth & everyday wonder</p>
                <h1 id="hero-title">Find your place<br>in Ondo.</h1>
                <p class="hero-copy">From the heart of Ekimogun to the places locals love, discover the people, places and stories that make this city feel like home.</p>
                <a class="button button-lime" href="#discover">Explore the city <span aria-hidden="true">→</span></a>
            </div>
            <div class="hero-caption">PHOTO: <a href="https://commons.wikimedia.org/wiki/File:Ondo_city_gate.jpg" target="_blank" rel="noopener noreferrer">ONDO CITY GATE · WIKIMEDIA COMMONS (CC BY-SA 4.0)</a></div>
        </section>

        <section class="intro content-width" id="discover">
            <div>
                <p class="section-kicker">Make it your Ondo</p>
                <h2>What are you looking for?</h2>
            </div>
            <p class="intro-copy">A good city guide helps you find the everyday essentials and the special places worth sharing. Start with what matters to you.</p>
        </section>

        <section class="category-grid content-width" aria-label="Explore by category">
            <a class="category-card category-market" href="{{ route('explore.index', ['category' => 'markets']) }}"><span class="category-symbol">⌂</span><strong>Markets & shopping</strong><span>Local finds and daily life <b>↗</b></span></a>
            <a class="category-card category-food" href="{{ route('explore.index', ['category' => 'food']) }}"><span class="category-symbol">✳</span><strong>Food & restaurants</strong><span>Good things to eat <b>↗</b></span></a>
            <a class="category-card category-stay" href="{{ route('explore.index', ['category' => 'stays']) }}"><span class="category-symbol">⌂</span><strong>Stays & resorts</strong><span>Places to rest and unwind <b>↗</b></span></a>
            <a class="category-card category-culture" href="{{ route('explore.index', ['category' => 'attractions']) }}"><span class="category-symbol">◉</span><strong>Culture & heritage</strong><span>Stories rooted in Ondo <b>↗</b></span></a>
            <a class="category-card category-services" href="{{ route('explore.index') }}"><span class="category-symbol">＋</span><strong>Schools, faith & more</strong><span>Find useful places nearby <b>↗</b></span></a>
        </section>

        <section class="places-section" id="places">
            <div class="content-width">
                <div class="section-heading">
                    <div><p class="section-kicker">A few good places to begin</p><h2>Discover places in Ondo</h2></div>
                    <a class="text-link" href="{{ route('explore.index') }}">See all places <span aria-hidden="true">→</span></a>
                </div>

                @if ($places->isNotEmpty())
                    <div class="place-grid" id="places-list">
                        @foreach ($places as $place)
                            <article class="place-card">
                                @if ($place->images->isNotEmpty())
                                    @php($coverImage = $place->images->first())
                                    <div class="place-image-wrap">
                                        <img class="place-image" src="{{ asset('storage/' . $coverImage->path) }}" alt="{{ $coverImage->label ?: $place->name }}" loading="lazy">
                                    </div>
                                @else
                                    <div class="place-image-placeholder"><span>✳</span><small>Discover Ondo</small></div>
                                @endif
                                <div class="place-card-body">
                                    <p class="place-location">Ondo City</p>
                                    <h3><a href="{{ route('explore.show', $place) }}">{{ $place->name }}</a></h3>
                                    <p class="place-description">{{ \Illuminate\Support\Str::limit($place->description, 125) }}</p>
                                    @if ($place->address)
                                        <p class="place-address"><span aria-hidden="true">⌖</span> {{ $place->address }}</p>
                                    @endif
                                    @if ($place->lat !== null && $place->lng !== null)
                                        <a class="place-action" href="https://www.google.com/maps?q={{ $place->lat }},{{ $place->lng }}" target="_blank" rel="noopener noreferrer">View on map <span aria-hidden="true">↗</span></a>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="empty-places"><span aria-hidden="true">✳</span><h3>Good things are being added</h3><p>We’re gathering the places that make Ondo special. Check back soon.</p></div>
                @endif
            </div>
        </section>

        <section class="about-section content-width" id="about">
            <div class="about-mark" aria-hidden="true">O</div>
            <div><p class="section-kicker">Rooted in Ekimogun</p><h2>Get to know Ondo.</h2><p>Ondo City is a place of deep Yoruba heritage, a welcoming community and a rhythm all its own. Meet the city and learn about its present Osemawe.</p><a class="text-link" href="{{ route('about-ondo') }}">Discover Ondo City and its king <span aria-hidden="true">→</span></a></div>
        </section>

        <section class="quote-section content-width">
            <p class="section-kicker">Take the scenic route</p>
            <blockquote>“The best journeys don’t just show you somewhere new. They help you see it differently.”</blockquote>
            <p class="quote-caption">Your next chapter starts in Ondo</p>
        </section>

        <section class="newsletter" id="newsletter">
            <div class="newsletter-copy"><h2>A little sunshine in your inbox.</h2><p>Get destination ideas, local stories and trip inspiration from Ondo.</p></div>
            <form class="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="post">
                @csrf
                <label class="sr-only" for="newsletter-email">Email address</label>
                <input id="newsletter-email" type="email" name="email" value="{{ old('email') }}" placeholder="Your email address" required maxlength="255" aria-describedby="newsletter-feedback">
                <button type="submit">Keep me inspired <span aria-hidden="true">→</span></button>
                <p class="newsletter-message" id="newsletter-feedback" aria-live="polite">
                    @if (session('newsletter_status'))
                        {{ session('newsletter_status') }}
                    @elseif ($errors->has('email'))
                        {{ $errors->first('email') }}
                    @endif
                </p>
            </form>
        </section>
    </main>

    <footer class="public-footer">
        <div class="public-footer-inner">
            <div class="footer-brand-block"><a class="brand footer-brand" href="{{ route('home') }}"><span class="brand-mark" aria-hidden="true">✳</span><span>Explore Ondo</span></a><p>Discover the Sunshine State.</p></div>
            <nav class="footer-nav" aria-label="Footer navigation"><a href="{{ route('explore.index') }}">Explore places</a><a href="{{ route('about-ondo') }}">About Ondo</a><a href="{{ route('people-businesses') }}">People & businesses</a></nav>
            <div class="footer-contact"><span>Made with care in Ondo, Nigeria</span><a href="mailto:hello@exploreondo.com">Contact</a></div>
            <small class="footer-copyright">© {{ date('Y') }} Explore Ondo</small>
        </div>
    </footer>
    {{-- <p class="photo-credits">Image credits: <a href="https://commons.wikimedia.org/wiki/File:Traditional_local_market_
        in_ondo_city_of_Nigeria.jpg" target="_blank" rel="noopener noreferrer">Ondo City market — Agbadaola</a>; 
        <a href="https://commons.wikimedia.org/wiki/File:Iya_Alaje_Market,_Ondo.jpg" target="_blank" rel="noopener n
        oreferrer">Iya Alaje Market — Ei'eke</a>; <a href="https://commons.wikimedia.org/wiki/File:Food_Point_Restaurant.jpg" target="_blank" rel="noopener noreferrer">Food Point Restaurant — Wikimedia Commons</a>; <a href="https://commons.wikimedia.org/wiki/File:From_the_top_of_the_Pele_mountain.jpg" target="_blank" rel="noopener noreferrer">Pele mountain — Temilayo1</a>; <a href="https://commons.wikimedia.org/wiki/File:Ondo_city_gate.jpg" target="_blank" rel="noopener noreferrer">Ondo city gate — Wikimedia Commons</a>; <a href="https://commons.wikimedia.org/wiki/File:Student_Union_Government_building,_Adeyemi_College_of_Education.jpg" target="_blank" rel="noopener noreferrer">Adeyemi campus — Haylad</a>. 
        Photos are from Wikimedia Commons; see each source page for its license and full attribution.</p> --}}
</body>
</html>
