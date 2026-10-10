@php
$active = "active bg-darg bg-gradient";
$linkhome = route('admin.home');
$linkmicuenta = route('admin.mi-cuenta');
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('dist/css/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
</head>

<body class="sb-nav-fixed">

@include('partials.user.terms')

@component('components.navbaruser')
    @slot('linkhome', $linkhome)
    @slot('linkmicuenta', $linkmicuenta)
@endcomponent

<div id="layoutSidenav">

<div id="layoutSidenav_nav">

    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Principal</div>
                <a class="nav-link {{ request()->routeIs('admin.home') ? $active : '' }}" href="{{ route('admin.home') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>
                    Inicio
                </a>
                <div class="sb-sidenav-menu-heading">Personal</div>
                <a class="nav-link {{ request()->routeIs('admin.mi-cuenta') ? $active : '' }}" href="{{ route('admin.mi-cuenta') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Mi Cuenta
                </a>
                <div class="sb-sidenav-menu-heading">Opciones</div>
                <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.usuarios') ? $active : '' }}" href="{{ route('admin.usuarios') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                    Usuarios
                </a>
                <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.citas') ? $active : '' }}" href="{{ route('admin.citas') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-calendar me-1"></i></div>
                    Citas
                </a>
                <a class="nav-link collapsed {{ Str::startsWith(Route::currentRouteName(), 'admin.especialidad') ? $active : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                    Especialidades
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.especialidades') ? 'active' : '' }}" href="{{ route('admin.especialidades') }}">Gestión</a>
                        <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.especialidad-asignar') ? 'active' : '' }}" href="{{ route('admin.especialidad-asignar') }}">Asignación</a>
                    </nav>
                </div>
                <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.motivos') ? $active : '' }}" href="{{ route('admin.motivos') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-teeth-open"></i></div>
                    Motivos
                </a>
                <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.sexos') ? $active : '' }}" href="{{ route('admin.sexos') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-venus-mars"></i></div>
                    Sexos
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Correo:</div> {{ auth('usuarios')->user()->correo }}
        </div>
    </nav>
</div>
<div id="layoutSidenav_content">

<main>
@yield('content')
</main>

@include('partials.user.footer')

</div>
</div>
</body>

<script src="{{ asset('dist/fonts/all.js') }}"></script>
<script src="{{ asset('dist/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('dist/js/scripts.js') }}"></script>
<script src="{{ asset('dist/js/validation.js') }}"></script>

</html>
