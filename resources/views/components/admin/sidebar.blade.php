@php
    $active = request()->routeIs('admin.media.index') ? 'active' : '';
@endphp

<aside class="sidebar-admin">
    <ul class="admin-menu">
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <span class="icon">📊</span>
                Tableau de bord
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.media.index') ? 'active' : '' }}">
            <a href="{{ route('admin.media.index') }}">
                <span class="icon">📷</span>
                Galerie
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.residents.index') ? 'active' : '' }}">
            <a href="{{ route('admin.residents.index') }}">
                <span class="icon">🧑‍🎨</span>
                Résidents
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.events.index') ? 'active' : '' }}">
            <a href="{{ route('admin.events.index') }}">
                <span class="icon">📅</span>
                Événements
            </a>
        </li>


    </ul>
</aside>