<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('equips.index') }}">Futbol Femení</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('equips.*') ? 'active' : '' }}" href="{{ route('equips.index') }}">Equips</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('estadis.*') ? 'active' : '' }}" href="{{ route('estadis.index') }}">Estadis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('jugadores.*') ? 'active' : '' }}" href="{{ route('jugadores.index') }}">Jugadores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('partits.*') ? 'active' : '' }}" href="{{ route('partits.index') }}">Partits</a>
                </li>
            </ul>
        </div>
    </div>
</nav>