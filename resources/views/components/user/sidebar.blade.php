<aside class="sidebar-user bg-light p-3 rounded">
    <ul class="nav flex-column">
        <li class="nav-item mb-2">
            <a href="{{ route('user.dashboard') }}" class="nav-link {{ request()->routeIs('user.dashboard') ? 'active fw-bold' : '' }}">
                👤Home
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('user.profile.edit') }}" class="nav-link {{ request()->routeIs('user.profile.edit') ? 'active fw-bold' : '' }}">
                👤 Mon profil
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('user.become-resident') }}" class="nav-link {{ request()->routeIs('user.become-resident') ? 'active fw-bold' : '' }}">
                🏠 Devenir résident
            </a>
        </li>
    </ul>
</aside>
