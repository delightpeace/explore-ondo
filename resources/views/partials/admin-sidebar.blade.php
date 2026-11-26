<aside class="admin-sidebar" aria-label="Admin navigation">
    <a class="admin-sidebar-brand" href="{{ route('admin.dashboard') }}">
        <img class="admin-sidebar-mark" src="{{ asset('ondo-sun-mark.svg') }}" alt="">
        <span class="admin-sidebar-brand-copy"><strong>Explore Ondo</strong><small>Admin workspace</small></span>
    </a>
    <nav class="admin-sidebar-nav">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}" @if (request()->routeIs('admin.dashboard')) aria-current="page" @endif><span aria-hidden="true">▦</span> Dashboard</a>
        <a href="{{ route('places') }}" class="{{ request()->routeIs('places*') ? 'is-active' : '' }}" @if (request()->routeIs('places*')) aria-current="page" @endif><span aria-hidden="true">▦</span> Places</a>
        <a href="{{ route('admin.categories') }}" class="{{ request()->routeIs('admin.categories*') ? 'is-active' : '' }}" @if (request()->routeIs('admin.categories*')) aria-current="page" @endif><span aria-hidden="true">◈</span> Categories</a>
        <a href="{{ route('admin.featured-profiles') }}" class="{{ request()->routeIs('admin.featured-profiles*') ? 'is-active' : '' }}" @if (request()->routeIs('admin.featured-profiles*')) aria-current="page" @endif><span aria-hidden="true">◎</span> People & businesses</a>
        <a href="{{ route('newsletter.subscribers') }}" class="{{ request()->routeIs('newsletter.subscribers') ? 'is-active' : '' }}" @if (request()->routeIs('newsletter.subscribers')) aria-current="page" @endif><span aria-hidden="true">✉</span> Newsletter emails</a>
    </nav>
    <div class="admin-sidebar-bottom">
        <a href="{{ route('logout') }}">Log out</a>
    </div>
</aside>
