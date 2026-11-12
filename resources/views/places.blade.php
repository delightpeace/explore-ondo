<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#153f31">
    <title>Place manager | Explore Ondo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root { --green: #153f31; --green-dark: #103126; --lime: #d7e889; --paper: #f6f7f2; --ink: #1c2b24; --muted: #68736b; --line: #e4e8df; --white: #fff; }
        * { box-sizing: border-box; }
        body { margin: 0; background: var(--paper); color: var(--ink); font-family: 'DM Sans', Arial, sans-serif; -webkit-font-smoothing: antialiased; }
        a { color: inherit; text-decoration: none; }
        .topbar { background: var(--green); color: var(--white); }
        .topbar-inner { width: min(1240px, calc(100% - 48px)); min-height: 74px; margin: auto; display: flex; align-items: center; justify-content: space-between; gap: 24px; }
        .brand { display: inline-flex; align-items: center; gap: 10px; font-size: 16px; font-weight: 700; letter-spacing: -.3px; }
        .brand-mark { width: 34px; height: 34px; display: grid; place-items: center; border-radius: 50%; background: var(--lime); color: var(--green); font-size: 18px; }
        .topbar-links { display: flex; align-items: center; gap: 20px; color: #e0e8e2; font-size: 12px; }
        .topbar-links a:hover { color: var(--lime); }
        main { width: min(1240px, calc(100% - 48px)); margin: 0 auto; padding: 42px 0 70px; }
        .page-heading { display: flex; align-items: end; justify-content: space-between; gap: 24px; margin-bottom: 26px; }
        .eyebrow { margin: 0 0 7px; color: #7c8c49; font-size: 10px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; }
        h1, h2, h3, p { margin-top: 0; }
        h1, .panel-title { font-family: 'Playfair Display', Georgia, serif; }
        h1 { margin-bottom: 7px; font-size: clamp(30px, 4vw, 40px); line-height: 1.15; }
        .page-intro { margin: 0; color: var(--muted); font-size: 13px; }
        .button { display: inline-flex; min-height: 42px; align-items: center; justify-content: center; gap: 9px; padding: 0 16px; border: 0; border-radius: 6px; background: var(--green); color: var(--white); font: 700 12px 'DM Sans', Arial, sans-serif; cursor: pointer; transition: background .18s, transform .18s; }
        .button:hover { background: var(--green-dark); transform: translateY(-1px); }
        .button-light { border: 1px solid var(--line); background: var(--white); color: var(--green); }
        .button-light:hover { background: #f1f4eb; }
        .summary-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 28px; }
        .summary-card { padding: 17px 19px; border: 1px solid var(--line); border-radius: 9px; background: var(--white); }
        .summary-label { margin: 0 0 7px; color: var(--muted); font-size: 11px; }
        .summary-value { margin: 0; color: var(--green); font-size: 25px; font-weight: 700; }
        .dashboard-grid { display: grid; grid-template-columns: minmax(290px, 360px) minmax(0, 1fr); align-items: start; gap: 22px; }
        .panel { border: 1px solid var(--line); border-radius: 10px; background: var(--white); box-shadow: 0 5px 22px #1c2b2408; }
        .form-panel { padding: 22px; }
        .panel-heading { margin-bottom: 18px; }
        .panel-title { margin: 0 0 5px; font-size: 22px; }
        .panel-subtitle { margin: 0; color: var(--muted); font-size: 11px; line-height: 1.6; }
        .field { margin-bottom: 15px; }
        label { display: block; margin-bottom: 6px; color: #334239; font-size: 11px; font-weight: 700; }
        input, select, textarea { width: 100%; min-height: 42px; padding: 10px 11px; border: 1px solid #dce2d8; border-radius: 5px; outline: none; background: #fff; color: var(--ink); font: 12px 'DM Sans', Arial, sans-serif; }
        textarea { min-height: 100px; resize: vertical; line-height: 1.6; }
        input:focus, select:focus, textarea:focus { border-color: #78905c; box-shadow: 0 0 0 3px #78905c1c; }
        input[type=file] { padding: 8px; }
        .coordinates { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .field-help { margin: 6px 0 0; color: #808b82; font-size: 10px; line-height: 1.5; }
        .field-error { display: block; margin-top: 5px; color: #b42318; font-size: 10px; }
        .notice { margin-bottom: 18px; padding: 12px 14px; border: 1px solid #bdd7bd; border-radius: 6px; background: #eef7ed; color: #245631; font-size: 12px; }
        .notice-error { border-color: #f0c5c0; background: #fff2f0; color: #922b21; }
        .form-submit { width: 100%; margin-top: 3px; }
        .places-panel { padding: 22px; }
        .places-heading { display: flex; align-items: end; justify-content: space-between; gap: 15px; margin-bottom: 16px; }
        .places-heading .panel-title { margin-bottom: 0; }
        .place-count { color: var(--muted); font-size: 11px; }
        .place-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 13px; }
        .place-card { overflow: hidden; border: 1px solid var(--line); border-radius: 8px; background: white; }
        .place-cover, .place-cover-placeholder { display: block; width: 100%; height: 145px; object-fit: cover; }
        .place-cover-placeholder { display: grid; place-items: center; background: linear-gradient(135deg, #e4eadf, #cbd8c6); color: var(--green); font-size: 27px; }
        .place-body { padding: 14px; }
        .place-category { display: inline-block; margin-bottom: 7px; padding: 5px 8px; border-radius: 99px; background: #eff3e5; color: #536a39; font-size: 9px; font-weight: 700; letter-spacing: .6px; text-transform: uppercase; }
        .place-name { margin: 0 0 6px; font: 600 19px 'Playfair Display', Georgia, serif; }
        .place-address { margin: 0 0 9px; color: #727d74; font-size: 10px; line-height: 1.5; }
        .place-description { min-height: 34px; margin: 0; color: #536057; font-size: 11px; line-height: 1.6; }
        .place-actions { display: flex; align-items: center; gap: 8px; margin-top: 14px; padding-top: 12px; border-top: 1px solid #edf0ea; }
        .action-link, .delete-button { display: inline-flex; min-height: 34px; align-items: center; justify-content: center; padding: 0 11px; border-radius: 5px; font: 700 10px 'DM Sans', Arial, sans-serif; cursor: pointer; }
        .action-link { background: var(--green); color: white; }
        .delete-form { margin-left: auto; }
        .delete-button { border: 1px solid #efd4d1; background: white; color: #a33d35; }
        .delete-button:hover { background: #fff4f2; }
        .empty-state { grid-column: 1 / -1; padding: 38px 18px; border: 1px dashed #cbd5c9; border-radius: 8px; color: var(--muted); text-align: center; }
        .empty-state strong { display: block; margin-bottom: 5px; color: var(--ink); font: 600 20px 'Playfair Display', Georgia, serif; }
        .admin-footer { padding-top: 28px; color: #8a938b; font-size: 10px; text-align: center; }
        @media (max-width: 980px) { .dashboard-grid { grid-template-columns: 1fr; } .form-panel { order: 0; } .places-panel { order: 1; } }
        @media (max-width: 650px) { .topbar-inner, main { width: calc(100% - 30px); } .topbar-inner { min-height: 66px; } .topbar-links { gap: 12px; font-size: 10px; } main { padding-top: 30px; } .page-heading { display: block; } .page-heading .button { margin-top: 17px; } .summary-grid { gap: 8px; } .summary-card { padding: 13px 11px; } .summary-label { min-height: 26px; font-size: 9px; } .summary-value { font-size: 21px; } .places-panel { padding: 16px; } .place-grid { grid-template-columns: 1fr; } .place-cover, .place-cover-placeholder { height: 190px; } }
        @media (max-width: 390px) { .topbar-links { gap: 8px; } .topbar-links a { font-size: 9px; } .coordinates { grid-template-columns: 1fr; gap: 0; } }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <a class="brand" href="{{ route('home') }}"><span class="brand-mark" aria-hidden="true">✳</span><span>Explore Ondo <span style="font-weight:400;color:#c9d7ce">/ Admin</span></span></a>
            <nav class="topbar-links" aria-label="Admin links">
                <a href="{{ route('home') }}">View website ↗</a>
                <a href="{{ route('newsletter.subscribers') }}">Newsletter signups</a>
                <a href="{{ route('logout') }}">Log out</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="page-heading">
            <div>
                <p class="eyebrow">Your city guide workspace</p>
                <h1>Place manager</h1>
                <p class="page-intro">Add, update and organize the places visitors can discover in Ondo.</p>
            </div>
            <a class="button button-light" href="{{ route('newsletter.subscribers') }}">View newsletter signups <span aria-hidden="true">→</span></a>
        </section>

        @if (session('status'))
            <div class="notice" role="status">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="notice notice-error" role="alert">Please check the highlighted fields and try again.</div>
        @endif

        <section class="summary-grid" aria-label="Place overview">
            <article class="summary-card"><p class="summary-label">Places in your guide</p><p class="summary-value">{{ $places->count() }}</p></article>
            <article class="summary-card"><p class="summary-label">Places with a category</p><p class="summary-value">{{ $places->filter(fn ($place) => filled($place->category))->count() }}</p></article>
            <article class="summary-card"><p class="summary-label">Places with photos</p><p class="summary-value">{{ $places->filter(fn ($place) => $place->images->isNotEmpty())->count() }}</p></article>
        </section>

        <div class="dashboard-grid">
            <section class="panel form-panel" aria-labelledby="add-place-title">
                <div class="panel-heading">
                    <p class="eyebrow">Grow the directory</p>
                    <h2 class="panel-title" id="add-place-title">Add a place</h2>
                    <p class="panel-subtitle">Share the details visitors need to find this place.</p>
                </div>

                <form action="{{ route('places.add') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="field">
                        <label for="name">Place name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required maxlength="255" placeholder="e.g. Osemawe Palace">
                        @error('name') <small class="field-error">{{ $message }}</small> @enderror
                    </div>
                    <div class="field">
                        <label for="category">Category</label>
                        <select id="category" name="category">
                            <option value="">Choose a category</option>
                            @foreach (['attractions' => 'Attractions & heritage', 'schools' => 'Schools & education', 'stays' => 'Hotels, stays & resorts', 'worship' => 'Churches & places of worship', 'markets' => 'Markets & shopping', 'food' => 'Food & restaurants', 'health' => 'Healthcare', 'events' => 'Events & festivals', 'motor-parks' => 'Motor parks & transport', 'services' => 'Useful services'] as $value => $label)
                                <option value="{{ $value }}" @selected(old('category') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('category') <small class="field-error">{{ $message }}</small> @enderror
                    </div>
                    <div class="field">
                        <label for="description">Description <span style="font-weight:400;color:#849087">(optional)</span></label>
                        <textarea id="description" name="description" placeholder="A short, helpful introduction">{{ old('description') }}</textarea>
                        @error('description') <small class="field-error">{{ $message }}</small> @enderror
                    </div>
                    <div class="field">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}" required maxlength="255" placeholder="Street, area or nearby landmark">
                        @error('address') <small class="field-error">{{ $message }}</small> @enderror
                    </div>
                    <div class="coordinates">
                        <div class="field">
                            <label for="lat">Latitude <span style="font-weight:400;color:#849087">(optional)</span></label>
                            <input type="number" step="any" id="lat" name="lat" value="{{ old('lat') }}" placeholder="7.0925">
                            @error('lat') <small class="field-error">{{ $message }}</small> @enderror
                        </div>
                        <div class="field">
                            <label for="lng">Longitude <span style="font-weight:400;color:#849087">(optional)</span></label>
                            <input type="number" step="any" id="lng" name="lng" value="{{ old('lng') }}" placeholder="4.8410">
                            @error('lng') <small class="field-error">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="field">
                        <label for="image">Place photo <span style="font-weight:400;color:#849087">(optional)</span></label>
                        <input type="file" id="image" name="image" accept="image/*">
                        <p class="field-help">Choose a clear photo of this specific place.</p>
                        @error('image') <small class="field-error">{{ $message }}</small> @enderror
                    </div>
                    <button class="button form-submit" type="submit">Add place <span aria-hidden="true">→</span></button>
                </form>
            </section>

            <section class="panel places-panel" aria-labelledby="places-title">
                <div class="places-heading">
                    <div>
                        <p class="eyebrow">Your directory</p>
                        <h2 class="panel-title" id="places-title">Places in Ondo</h2>
                    </div>
                    <span class="place-count">{{ $places->count() }} total</span>
                </div>

                <div class="place-grid">
                    @forelse ($places as $place)
                        <article class="place-card">
                            @if ($place->images->isNotEmpty())
                                @php($coverImage = $place->images->first())
                                <img class="place-cover" src="{{ $coverImage->path ? asset('storage/' . $coverImage->path) : asset($coverImage->url) }}" alt="{{ $coverImage->label ?: $place->name }}" loading="lazy">
                            @else
                                <div class="place-cover-placeholder" aria-label="No photo added">✳</div>
                            @endif
                            <div class="place-body">
                                <span class="place-category">{{ $place->category ? \Illuminate\Support\Str::headline($place->category) : 'Uncategorized' }}</span>
                                <h3 class="place-name">{{ $place->name }}</h3>
                                <p class="place-address">⌖ {{ $place->address }}</p>
                                <p class="place-description">{{ \Illuminate\Support\Str::limit($place->description ?: 'No description has been added yet.', 95) }}</p>
                                <div class="place-actions">
                                    <a class="action-link" href="{{ route('places.edit', $place->id) }}">Edit place</a>
                                    @if ($place->lat !== null && $place->lng !== null)
                                        <a class="action-link" href="https://www.google.com/maps?q={{ $place->lat }},{{ $place->lng }}" target="_blank" rel="noopener noreferrer">Map ↗</a>
                                    @endif
                                    <form class="delete-form" action="{{ route('places.delete', $place->id) }}" method="post" onsubmit="return confirm('Delete this place from the directory?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="delete-button" type="submit">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="empty-state"><strong>Your directory is ready to grow</strong>Add your first place using the form.</div>
                    @endforelse
                </div>
            </section>
        </div>
        <footer class="admin-footer">Explore Ondo · Place manager</footer>
    </main>
</body>
</html>
