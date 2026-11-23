<aside class="admin-sidebar" aria-label="Admin navigation">
    <a class="admin-sidebar-brand" href="{{ route('places') }}">
        <span class="admin-sidebar-mark" aria-hidden="true">✳</span>
        <span class="admin-sidebar-brand-copy"><strong>Explore Ondo</strong><small>Admin workspace</small></span>
    </a>
    <p class="admin-sidebar-label">Manage</p>
    <nav class="admin-sidebar-nav">
        <a href="{{ route('places') }}" class="{{ request()->routeIs('places*') ? 'is-active' : '' }}" @if (request()->routeIs('places*')) aria-current="page" @endif><span aria-hidden="true">▦</span> Places</a>
        <a href="{{ route('newsletter.subscribers') }}" class="{{ request()->routeIs('newsletter.subscribers') ? 'is-active' : '' }}" @if (request()->routeIs('newsletter.subscribers')) aria-current="page" @endif><span aria-hidden="true">✉</span> Newsletter emails</a>
    </nav>
    <div class="admin-sidebar-bottom">
        <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">View public website <span aria-hidden="true">↗</span></a>
        <a href="{{ route('logout') }}">Log out</a>
    </div>
</aside>
