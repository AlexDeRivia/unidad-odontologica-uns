
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-danger shadow-sm">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{ $linkhome }}">
        <span class="uo-brand">UNS <small>· Odontología</small></span>
    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ $linkhome }}">Inicio</a></li>
                <li><a class="dropdown-item" href="{{ $linkmicuenta }}">Mi Cuenta</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li>
                    <form action="{{ route('logout.auth') }}" method="post">
                        @csrf
                        <input type="submit" class="dropdown-item" value="Cerrar Sesión">
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
