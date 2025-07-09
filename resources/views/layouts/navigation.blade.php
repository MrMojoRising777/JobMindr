<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">{{ config('app.name', 'JobMindr') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('companies.index') ? 'active' : '' }}" href="{{ route('companies.index') }}">
                        Companies
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contacts.index') ? 'active' : '' }}" href="{{ route('contacts.index') }}">
                        Contacts
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('applications.index') ? 'active' : '' }}" href="{{ route('applications.index') }}">
                        Applications
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('favorites.index') ? 'active' : '' }}" href="{{ route('favorites.index') }}">
                        Favorites
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                        <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#importModal">Import</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
