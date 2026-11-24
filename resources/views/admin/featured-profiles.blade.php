<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <title>People & businesses | Explore Ondo Admin</title>
    <link rel="stylesheet" href="{{ asset('css-admin-sidebar.css') }}?v={{ md5_file(public_path('css-admin-sidebar.css')) }}">
    <style>
        body { margin: 0; background: #f6f7f2; color: #1c2b24; font: 14px 'DM Sans', Arial, sans-serif; }
        .admin-topbar { min-height: 74px; padding: 0 32px; display: flex; align-items: center; justify-content: space-between; background: #153f31; color: #fff; }
        .admin-topbar strong { font-size: 14px; }.admin-topbar a { color: #e2eadd; font-size: 12px; text-decoration: none; }
        .page-title { margin-bottom: 24px; }.eyebrow { margin: 0 0 8px; color: #7d8b48; font-size: 10px; font-weight: 700; letter-spacing: 1.8px; text-transform: uppercase; }
        h1, h2, h3, p { margin-top: 0; }.page-title h1 { margin-bottom: 7px; font: 600 36px 'Playfair Display', Georgia, serif; }.page-title p:last-child { color: #68736b; font-size: 13px; }
        .notice { margin-bottom: 18px; padding: 12px 14px; border-radius: 6px; background: #e8f1dd; color: #30552f; font-size: 12px; }
        .profile-layout { display: grid; grid-template-columns: minmax(260px, .7fr) minmax(0, 1.4fr); gap: 20px; align-items: start; }
        .panel, .profile-card { padding: 22px; border: 1px solid #e4e8df; border-radius: 9px; background: #fff; box-shadow: 0 5px 22px #1c2b2408; }
        .panel h2 { margin-bottom: 5px; font: 600 22px 'Playfair Display', Georgia, serif; }.panel-intro { color: #68736b; font-size: 11px; line-height: 1.6; }
        .field { margin: 14px 0; }label { display: block; margin-bottom: 6px; color: #334239; font-size: 11px; font-weight: 700; }
        input, select, textarea { width: 100%; min-height: 40px; box-sizing: border-box; padding: 10px 11px; border: 1px solid #dce2d8; border-radius: 5px; outline: none; color: #1c2b24; font: 12px 'DM Sans', Arial, sans-serif; }
        textarea { min-height: 88px; resize: vertical; }.field-pair { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .button, .button-danger { min-height: 38px; padding: 0 14px; border: 0; border-radius: 5px; background: #153f31; color: #fff; font: 700 11px 'DM Sans', Arial, sans-serif; cursor: pointer; }
        .button-danger { border: 1px solid #efd4d1; background: #fff; color: #a33d35; }
        .profile-list { display: grid; gap: 12px; }.profile-card { padding: 0; overflow: hidden; }.profile-card summary { padding: 17px 19px; display: flex; align-items: center; gap: 12px; cursor: pointer; list-style: none; }.profile-card summary::-webkit-details-marker { display: none; }
        .avatar { width: 42px; height: 42px; display: grid; place-items: center; overflow: hidden; border-radius: 50%; background: #eef2e4; color: #153f31; font: 600 17px 'Playfair Display', Georgia, serif; }.avatar img { width: 100%; height: 100%; object-fit: cover; }.summary-copy { flex: 1; }.summary-copy strong { display: block; margin-bottom: 4px; }.summary-copy small { color: #748078; font-size: 10px; }.type-label { padding: 5px 8px; border-radius: 20px; background: #f1f3ec; color: #53634f; font-size: 9px; text-transform: uppercase; }
        .edit-form { padding: 17px 19px 20px; border-top: 1px solid #edf0ea; }.edit-actions { display: flex; align-items: center; justify-content: space-between; gap: 10px; }
        @media(max-width: 900px) { .profile-layout { grid-template-columns: 1fr; } }
        @media(max-width: 700px) { .admin-topbar { padding: 0 16px; }.field-pair { grid-template-columns: 1fr; }.admin-page-content { padding: 22px 16px 32px !important; } }
    </style>
</head>
<body>
    <header class="admin-topbar"><strong>Explore Ondo · Admin</strong><a href="{{ route('people-businesses') }}" target="_blank" rel="noopener">View public page ↗</a></header>
    <div class="admin-shell">
        @include('partials.admin-sidebar')
        <main class="admin-page-content">
            <div class="page-title"><p class="eyebrow">Public directory content</p><h1>People & businesses</h1><p>Edit the featured profiles shown on the public page. Place listings are still managed under Places.</p></div>
            @if (session('status'))<div class="notice" role="status">{{ session('status') }}</div>@endif
            @if ($errors->any())<div class="notice" role="alert"><ul style="margin:0;padding-left:18px">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
            <div class="profile-layout">
                <section class="panel">
                    <h2>Add a profile</h2><p class="panel-intro">Add a notable person or a featured local business.</p>
                    <form method="post" action="{{ route('admin.featured-profiles.store') }}">@csrf
                        <div class="field"><label for="new-type">Profile type</label><select id="new-type" name="type" required><option value="person">Notable person</option><option value="business">Local business</option></select></div>
                        <div class="field"><label for="new-name">Name</label><input id="new-name" name="name" value="{{ old('name') }}" required maxlength="160"></div>
                        <div class="field"><label for="new-subtitle">Role or category</label><input id="new-subtitle" name="subtitle" value="{{ old('subtitle') }}" maxlength="180" placeholder="e.g. Artist · Ondo City"></div>
                        <div class="field"><label for="new-description">Description</label><textarea id="new-description" name="description" required maxlength="2000">{{ old('description') }}</textarea></div>
                        <div class="field"><label for="new-image">Image URL <span style="font-weight:400">(optional)</span></label><input id="new-image" type="url" name="image_url" value="{{ old('image_url') }}" maxlength="2048" placeholder="https://..."></div>
                        <div class="field"><label for="new-website">Website or profile link <span style="font-weight:400">(optional)</span></label><input id="new-website" type="url" name="website_url" value="{{ old('website_url') }}" maxlength="2048" placeholder="https://..."></div>
                        <div class="field"><label for="new-order">Display order</label><input id="new-order" type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" max="65535" required></div>
                        <button class="button" type="submit">Add profile</button>
                    </form>
                </section>
                <section class="profile-list" aria-label="Existing featured profiles">
                    @forelse ($profiles as $profile)
                        <details class="profile-card">
                            <summary><span class="avatar">@if ($profile->image_url)<img src="{{ $profile->image_url }}" alt="">@else{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($profile->name, 0, 1)) }}@endif</span><span class="summary-copy"><strong>{{ $profile->name }}</strong><small>{{ $profile->subtitle }}</small></span><span class="type-label">{{ $profile->type }}</span></summary>
                            <form class="edit-form" method="post" action="{{ route('admin.featured-profiles.update', $profile) }}">@csrf @method('put')
                                <div class="field-pair"><div class="field"><label for="type-{{ $profile->id }}">Profile type</label><select id="type-{{ $profile->id }}" name="type"><option value="person" @selected($profile->type === 'person')>Notable person</option><option value="business" @selected($profile->type === 'business')>Local business</option></select></div><div class="field"><label for="name-{{ $profile->id }}">Name</label><input id="name-{{ $profile->id }}" name="name" value="{{ $profile->name }}" required maxlength="160"></div></div>
                                <div class="field"><label for="subtitle-{{ $profile->id }}">Role or category</label><input id="subtitle-{{ $profile->id }}" name="subtitle" value="{{ $profile->subtitle }}" maxlength="180"></div>
                                <div class="field"><label for="description-{{ $profile->id }}">Description</label><textarea id="description-{{ $profile->id }}" name="description" required maxlength="2000">{{ $profile->description }}</textarea></div>
                                <div class="field-pair"><div class="field"><label for="image-{{ $profile->id }}">Image URL</label><input id="image-{{ $profile->id }}" type="url" name="image_url" value="{{ $profile->image_url }}" maxlength="2048" placeholder="https://..."></div><div class="field"><label for="website-{{ $profile->id }}">Website or profile link</label><input id="website-{{ $profile->id }}" type="url" name="website_url" value="{{ $profile->website_url }}" maxlength="2048" placeholder="https://..."></div></div>
                                <div class="field"><label for="order-{{ $profile->id }}">Display order</label><input id="order-{{ $profile->id }}" type="number" name="sort_order" value="{{ $profile->sort_order }}" min="0" max="65535" required></div>
                                <div class="edit-actions"><button class="button" type="submit">Save changes</button><button class="button-danger" type="submit" form="delete-profile-{{ $profile->id }}">Delete profile</button></div>
                            </form>
                            <form id="delete-profile-{{ $profile->id }}" method="post" action="{{ route('admin.featured-profiles.destroy', $profile) }}" onsubmit="return confirm('Remove this profile from the public page?')">@csrf @method('delete')</form>
                        </details>
                    @empty
                        <div class="panel"><p>No featured profiles yet. Add your first person or business with the form.</p></div>
                    @endforelse
                </section>
            </div>
        </main>
    </div>
</body>
</html>
