@php
    $usuario = auth('usuarios')->user();
@endphp

@extends('layouts.dentista')

@section('title', 'Unidad Odontológica')

@section('content')

<div class="container mb-3">

    <h5 class="py-3 mb-3 border-bottom">
        ¡Bienvenido a la Unidad Odontológica de la Universidad Nacional del Santa!
    </h5>

    <div class="row align-items-start">

        <div class="col-12 col-lg-4">
            <div class="p-4">
                <div class="uo-feature-panel"><i class="fa-solid fa-tooth" aria-hidden="true"></i><span>Atención odontológica</span></div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="my-2">Presentación</h5>
                </div>
                <div class="card-body text-end">
                    <figure class="text-start">
                        <blockquote class="blockquote">
                            <p class="pb-3">
                                En esta plataforma, te damos la bienvenida a una experiencia de gestión de citas optimizada.
                                Aquí puedes administrar las citas de tus pacientes, y colaborar de manera eficiente para brindar la mejor atención odontológica.
                                Tu participación es esencial para mantener sonrisas saludables.
                                Gracias por ser parte de nuestro equipo de profesionales de la salud bucal.
                            </p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                            Unidad Odontológica <cite title="Source Title">UNS</cite>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>

        <div class="col-lg-8 offset-lg-4 offset-0 text-center">
            <h1>Bienvenido</h1>
            <div class="alert alert-secondary mt-3" role="alert">
                <h3 class="m-0">{{ $usuario->nombres . ' ' . $usuario->apellidos }}</h3>
            </div>
            <p>Gracias por visitar nuestro sitio.</p>
            <div class="alert alert-warning mt-3" role="alert">
                No olvides cerrar tu sesión al Salir
            </div>
            <h4>Eres un dentista</h4>
            <i class="fa-solid fa-truck-medical mt-3" style="font-size: 150px;"></i>
        </div>
    </div>
</div>

@endsection
