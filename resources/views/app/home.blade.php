@extends('layouts.welcome')

@section('title', 'Unidad Odontológica')

@section('content')
@include('partials.app.carousel')

<!-- Contenido principal -->
<div class="container bg-white shadow py-4 py-md-5">

    <!-- Bienvenida -->
    <div class="row mx-0 mx-lg-5">

        <div class="col-12 col-md-6 col-lg-5 px-0 px-sm-3">
            <h5 class="danger text-danger mb-4">¡Sonríe con Confianza!</h5>
            <p class="mb-4">
                Bienvenidos a nuestra Unidad Odontológica, donde tu salud oral es nuestra prioridad.
                Nuestros profesionales capacitados y tecnología de vanguardia están listos para brindarte una sonrisa saludable y radiante.
                Reserva tu cita ahora y descubre la diferencia que podemos hacer en tu bienestar dental.
            </p>
            <a href="{{ route('paciente.citas') }}" class="btn btn-danger mb-4" type="button">Reserva tu cita en línea</a>
        </div>

        <div class="col-12 col-md-6 col-lg-7 px-0 px-sm-3">

            <div class="row text-left align-items-start">

                <div class="col-12 col-md-12 col-lg-6">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-3 text-center">
                                <i class="bi bi-heart-fill fs-1 text-secondary"></i>
                            </div>
                            <div class="col-9">
                                <h5 class="mb-3"><a href="{{ route('nosotros') }}#mision-vision" class="link-danger link-underline-opacity-0">Misión y Visión</a></h5>
                                <p class="mb-0">Descubre por que prevenimos problemas dentales, manteniendo tu sonrisa en su mejor forma.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-6">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-3 text-center">
                                <i class="bi bi-people-fill fs-1 text-secondary"></i>
                            </div>
                            <div class="col-9">
                                <h5 class="mb-3"><a href="{{ route('nosotros') }}#equipo" class="link-danger link-underline-opacity-0">Nuestro Equipo</a></h5>
                                <p class="mb-0">Conoce a nuestros profesionales altamente capacitados, listos para cuidar de tu salud dental.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-6">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-3 text-center">
                                <i class="bi bi-bookmark-check-fill fs-1 text-secondary"></i>
                            </div>
                            <div class="col-9">
                                <h5 class="mb-3"><a href="{{ route('nosotros') }}#servicios" class="link-danger link-underline-opacity-0">Nuestros Servicios</a></h5>
                                <p class="mb-0">Consulta nuestra amplia gama de servicios dentales, para mantener tu sonrisa saludable.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-6">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-3 text-center">
                                <i class="bi bi-calendar-fill fs-1 text-secondary"></i>
                            </div>
                            <div class="col-9">
                                <h5 class="mb-3"><a href="{{ route('horarios') }}#horarios" class="link-danger link-underline-opacity-0">Horarios</a></h5>
                                <p class="mb-0">Revisa nuestros horarios de atención y reserva una cita en nuestra unidad odontológica.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ubicacion -->
    <div class="mx-0 mx-lg-5 px-0 px-sm-3">
        <h5 class="danger text-danger my-4">Nos encontramos dentro de la universidad!</h5>
        <p>
            La Unidad Odontológica está convenientemente situada en las inmediaciones del Vicerrectorado Académico de la Universidad Nacional del Santa (UNS), en proximidad a las Oficinas de Admisión de la UNS.
            Esta ubicación estratégica facilita el acceso y la comodidad para los estudiantes y miembros de la comunidad universitaria que requieren servicios odontológicos.
        </p>
        <div class="ratio ratio-21x9">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d984.8493961668956!2d-78.5162084!3d-9.1185143!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91ab85c944aa8e77%3A0x7adeadcf8b17602f!2sVicerrectorado%20Acad%C3%A9mico%20UNS!5e0!3m2!1ses-419!2spe!4v1698223458122!5m2!1ses-419!2spe" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</div>
<!-- Fin de Contenido principal -->
@endsection
