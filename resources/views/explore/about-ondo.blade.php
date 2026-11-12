<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Learn about Ondo City, its Ekimogun heritage and the current Osemawe.">
    <title>About Ondo City | Explore Ondo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css-explore-ondo.css') }}?v={{ md5_file(public_path('css-explore-ondo.css')) }}">
    @endif
</head>
<body>
    <header class="topbar"><div class="topbar-inner"><a class="brand" href="{{ route('home') }}"><span class="brand-mark" aria-hidden="true">✳</span><span>Explore Ondo</span></a><nav class="topbar-links" aria-label="Main navigation"><a href="{{ route('home') }}">Home</a><a href="{{ route('explore.index') }}">Places</a><a href="{{ route('explore.index', ['category' => 'events']) }}">Festivals</a><a href="{{ route('about-ondo') }}">About Ondo</a><a href="{{ route('people-businesses') }}">People & businesses</a></nav><a class="topbar-cta" href="{{ route('home') }}#newsletter">Stay connected ↗</a></div></header>
    <main class="content-width story-page">
        <a class="text-link back-link" href="{{ route('home') }}">← Back to Explore Ondo</a>
        <section class="story-hero"><p class="section-kicker">Rooted in Ekimogun</p><h1>Get to know Ondo.</h1><p class="story-lede">A city shaped by Yoruba heritage, community, and a living tradition that continues to welcome new generations.</p></section>
        <section class="story-columns">
            <article class="story-card"><p class="section-kicker">The city</p><h2>Ode Ondo, a home with deep roots</h2><p>Ondo City, also known as Ode Ondo, is an historic Yoruba city in southwestern Nigeria. Its people are often known as Ekimogun. Community histories preserve the story of Pupupu, remembered as the first Osemawe, and the traditions that shaped the kingdom.</p><p>The Osemawe and the palace remain important to the city’s cultural life. Ondo’s traditions also recognize women leaders, including the Lobun, reflecting the place of women in the kingdom’s history.</p><p class="source-note">Learn more: <a href="https://www.oufa.org/uploads/3/4/9/7/34973525/profileofodeondo.pdf" target="_blank" rel="noopener noreferrer">Profile of Ode Ondo (PDF) ↗</a></p></article>
            <article class="king-card"><p class="section-kicker">The present Osemawe</p><p class="king-number">44th</p><h2>Oba Dr. Victor Adesimbo Ademefun Kiladejo</h2><p class="king-title">Jilo III · Osemawe of Ondo Kingdom</p><p>Oba Kiladejo ascended the throne in 2006. He is the current traditional ruler of Ondo Kingdom.</p><a class="button" href="https://monarch-osemawe44th.org/biography-of-his-royal-majesty/" target="_blank" rel="noopener noreferrer">Read the royal biography ↗</a><p class="source-note">The title and reign dates follow the official royal biography.</p></article>
        </section>
    </main>
    <footer class="public-footer"><div class="public-footer-inner"><div class="footer-brand-block"><a class="brand footer-brand" href="{{ route('home') }}"><span class="brand-mark" aria-hidden="true">✳</span><span>Explore Ondo</span></a><p>Discover the Sunshine State.</p></div><nav class="footer-nav" aria-label="Footer navigation"><a href="{{ route('explore.index') }}">Explore places</a><a href="{{ route('about-ondo') }}">About Ondo</a><a href="{{ route('people-businesses') }}">People & businesses</a></nav><div class="footer-contact"><span>Made with care in Ondo, Nigeria</span><a href="{{ route('home') }}#newsletter">Stay connected</a></div><small class="footer-copyright">© {{ date('Y') }} Explore Ondo</small></div></footer>
</body>
</html>
