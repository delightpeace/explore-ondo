<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <title>Categories | Explore Ondo Admin</title>
    <link rel="stylesheet" href="{{ asset('css-admin-sidebar.css') }}?v={{ md5_file(public_path('css-admin-sidebar.css')) }}">
    <style>
        body { margin: 0; background: #f6f7f2; color: #1c2b24; font: 14px 'DM Sans', Arial, sans-serif; }
        .page-title { margin-bottom: 24px; }.eyebrow { margin: 0 0 8px; color: #7d8b48; font-size: 10px; font-weight: 700; letter-spacing: 1.8px; text-transform: uppercase; }
        h1, h2, h3, p { margin-top: 0; }.page-title h1 { margin-bottom: 7px; font: 600 36px 'Playfair Display', Georgia, serif; }.page-title p:last-child { color: #68736b; font-size: 13px; }
        .notice { margin-bottom: 18px; padding: 12px 14px; border-radius: 6px; background: #e8f1dd; color: #30552f; font-size: 12px; }
        .admin-columns { display: grid; grid-template-columns: minmax(280px, .72fr) minmax(0, 1.5fr); gap: 20px; align-items: start; }
        .panel, .category-card { padding: 22px; border: 1px solid #e4e8df; border-radius: 9px; background: #fff; box-shadow: 0 5px 22px #1c2b2408; }
        .panel h2 { margin-bottom: 5px; font: 600 22px 'Playfair Display', Georgia, serif; }.panel-intro { color: #68736b; font-size: 11px; line-height: 1.6; }
        .field { margin: 14px 0; }label { display: block; margin-bottom: 6px; color: #334239; font-size: 11px; font-weight: 700; }
        input, textarea { width: 100%; min-height: 40px; box-sizing: border-box; padding: 10px 11px; border: 1px solid #dce2d8; border-radius: 5px; outline: none; color: #1c2b24; font: 12px 'DM Sans', Arial, sans-serif; }
        textarea { min-height: 72px; resize: vertical; }.field-pair { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .button, .button-danger { min-height: 38px; padding: 0 14px; border: 0; border-radius: 5px; background: #153f31; color: #fff; font: 700 11px 'DM Sans', Arial, sans-serif; cursor: pointer; }
        .button-danger { border: 1px solid #efd4d1; background: #fff; color: #a33d35; }.button:hover { background: #103126; }
        .category-list { display: grid; gap: 12px; }.category-card { padding: 0; overflow: hidden; }.category-card summary { padding: 17px 19px; display: flex; align-items: center; gap: 12px; cursor: pointer; list-style: none; }.category-card summary::-webkit-details-marker { display: none; }
        .symbol { width: 38px; height: 38px; display: grid; place-items: center; border-radius: 50%; background: #eef2e4; color: #153f31; font-size: 18px; }.summary-copy { flex: 1; }.summary-copy strong { display: block; margin-bottom: 4px; }.summary-copy small { color: #748078; font-size: 10px; }.place-count { color: #68736b; font-size: 10px; white-space: nowrap; }
        .edit-form { padding: 17px 19px 20px; border-top: 1px solid #edf0ea; }.edit-actions { display: flex; align-items: center; gap: 10px; }.edit-actions form { margin-left: auto; }
        @media(max-width: 900px) { .admin-columns { grid-template-columns: 1fr; } }
        @media(max-width: 700px) { .field-pair { grid-template-columns: 1fr; }.admin-page-content { padding: 22px 16px 32px !important; } }
    </style>
</head>
<body>
    @include('partials.admin-topbar')
    <div class="admin-shell">
        @include('partials.admin-sidebar')
        <main class="admin-page-content">
            <div class="page-title"><p class="eyebrow">Public directory setup</p><h1>Categories</h1><p>Add, rename and arrange categories shown on the homepage and directory.</p></div>
            @if (session('status'))<div class="notice" role="status">{{ session('status') }}</div>@endif
            @if ($errors->any())<div class="notice" role="alert"><ul style="margin:0;padding-left:18px">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
            <div class="admin-columns">
                <section class="panel">
                    <h2>Add a category</h2><p class="panel-intro">Categories can be created before places are added. The slug is used in website links.</p>
                    <form method="post" action="{{ route('admin.categories.store') }}">@csrf
                        <div class="field"><label for="new-name">Category name</label><input id="new-name" name="name" value="{{ old('name') }}" required maxlength="120" placeholder="e.g. Arts & culture"></div>
                        <div class="field"><label for="new-slug">URL slug</label><input id="new-slug" name="slug" value="{{ old('slug') }}" required maxlength="100" pattern="[a-z0-9]+(-[a-z0-9]+)*" placeholder="e.g. arts-culture"></div>
                        <div class="field"><label for="new-description">Short description</label><textarea id="new-description" name="description" maxlength="255">{{ old('description') }}</textarea></div>
                        <div class="field-pair"><div class="field"><label for="new-symbol">Card symbol</label><input id="new-symbol" name="symbol" value="{{ old('symbol', '◉') }}" maxlength="12" required></div><div class="field"><label for="new-order">Display order</label><input id="new-order" type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" max="65535" required></div></div>
                        <div class="field"><label for="new-image">Card image URL <span style="font-weight:400">(optional)</span></label><input id="new-image" type="url" name="image_url" value="{{ old('image_url') }}" maxlength="2048" placeholder="https://..."></div>
                        <button class="button" type="submit">Add category</button>
                    </form>
                </section>
                <section class="category-list" aria-label="Existing categories">
                    @forelse ($categories as $category)
                        <details class="category-card">
                            <summary><span class="symbol">{{ $category->symbol }}</span><span class="summary-copy"><strong>{{ $category->name }}</strong><small>{{ $category->slug }}</small></span><span class="place-count">{{ $category->places_count }} places</span></summary>
                            <form class="edit-form" method="post" action="{{ route('admin.categories.update', $category) }}">@csrf @method('put')
                                <div class="field-pair"><div class="field"><label for="name-{{ $category->id }}">Name</label><input id="name-{{ $category->id }}" name="name" value="{{ $category->name }}" required maxlength="120"></div><div class="field"><label for="slug-{{ $category->id }}">Slug</label><input id="slug-{{ $category->id }}" name="slug" value="{{ $category->slug }}" required maxlength="100" pattern="[a-z0-9]+(-[a-z0-9]+)*"></div></div>
                                <div class="field"><label for="description-{{ $category->id }}">Description</label><textarea id="description-{{ $category->id }}" name="description" maxlength="255">{{ $category->description }}</textarea></div>
                                <div class="field-pair"><div class="field"><label for="symbol-{{ $category->id }}">Card symbol</label><input id="symbol-{{ $category->id }}" name="symbol" value="{{ $category->symbol }}" maxlength="12" required></div><div class="field"><label for="order-{{ $category->id }}">Display order</label><input id="order-{{ $category->id }}" type="number" name="sort_order" value="{{ $category->sort_order }}" min="0" max="65535" required></div></div>
                                <div class="field"><label for="image-{{ $category->id }}">Card image URL</label><input id="image-{{ $category->id }}" type="url" name="image_url" value="{{ $category->image_url }}" maxlength="2048" placeholder="https://..."></div>
                                <div class="edit-actions"><button class="button" type="submit">Save changes</button></div>
                            </form>
                            <form class="edit-form" method="post" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Remove this category?')">@csrf @method('delete')<button class="button-danger" type="submit">Delete category</button></form>
                        </details>
                    @empty
                        <div class="panel"><p>No categories yet. Add your first category with the form.</p></div>
                    @endforelse
                </section>
            </div>
        </main>
    </div>
</body>
</html>
