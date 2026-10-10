<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-uns sticky-top shadow" data-bs-theme="dark">
    <div class="container" id="myNavbar">
        <a class="navbar-brand" href="{{ route('home') }}">
            <span class="uo-brand">UNS <small>· Unidad Odontológica</small></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Inicio</a>
                </li>
                <li class="nav-item dropdown" data-bs-theme="light">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('nosotros') ? 'active' : '' }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">Nosotros</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('nosotros') }}#mision-vision">Misión y Visión</a></li>
                        <li><a class="dropdown-item" href="{{ route('nosotros') }}#equipo">Nuestro Equipo</a></li>
                        <li><a class="dropdown-item" href="{{ route('nosotros') }}#servicios">Nuestros Servicios</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('horarios') ? 'active' : '' }}" href="{{ route('horarios') }}#horarios">Horarios</a>
                </li>
            </ul>
            <div class="d-flex">
                <a class="btn btn-uns me-3 ms-0 mx-lg-3 mb-2 mb-lg-0" href="{{ route('login') }}">Ingresar</a>
                <a class="btn btn-uns mb-2 mb-lg-0" href="{{ route('register') }}">Registrarse</a>
            </div>
        </div>
    </div>
</nav>
<!-- Fin de Navbar -->
