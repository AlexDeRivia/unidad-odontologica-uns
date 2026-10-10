@php
$active = "active bg-darg bg-gradient";
$linkhome = route('dentista.home');
$linkmicuenta = route('dentista.mi-cuenta');
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
                <a class="nav-link {{ request()->routeIs('dentista.home') ? $active : '' }}" href="{{ route('dentista.home') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>
                    Inicio
                </a>
                <div class="sb-sidenav-menu-heading">Personal</div>
                <a class="nav-link {{ request()->routeIs('dentista.mi-cuenta') ? $active : '' }}" href="{{ route('dentista.mi-cuenta') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Mi Cuenta
                </a>
                <div class="sb-sidenav-menu-heading">Opciones</div>
                <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'dentista.citas') ? $active : '' }}" href="{{ route('dentista.citas') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-calendar"></i></i></div>
                    Citas
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
