<!-- Footer -->
<footer class="text-center text-lg-start text-light-uns bg-dark-uns">

    <div class="container pt-4">

        <div class="row">

            <!-- Seccion Principal de Footer -->
            <div class="col-lg-6 col-md-6 mb-0 mb-lg-4">

                <h5>Universidad Nacional del Santa</h5>
                <hr>
                <h6>Bienestar Universitario - Unidad Odontológica</h6>
                <ul class="list-unstyled mb-0">
                    <li>Dirección: <a class="link-light-uns" href="https://maps.app.goo.gl/MNr8s4TQ7EpPuAHg7" target="_blank">Av. Universitaria, Nuevo Chimbote 02712</a></li>
                    <li>Central Telefónica: (51)-43-310445 Chimbote - Ancash - Perú.</li>
                    <li>La Unidad Odontológica UNS le espera para brindar una atención profesional esmerada, pensando primero en su bienestar y a precios módicos.</li>
                </ul>

                <!-- Redes Sociales -->
                <section class="mt-4">
                    <a class="btn btn-uns mx-2 ms-lg-0 fs-5 mb-5 mb-lg-0" href="https://www.facebook.com/UNSChimbote/" role="button" target="_blank"><i class="bi bi-facebook"></i></a>
                    <a class="btn btn-uns mx-2 fs-5 mb-5 mb-lg-0" href="https://twitter.com/UNS_Chimbote" role="button" target="_blank"><i class="bi bi-twitter"></i></a>
                    <a class="btn btn-uns mx-2 fs-5 mb-5 mb-lg-0" href="https://www.instagram.com/unschimbote/" role="button" target="_blank"><i class="bi bi-instagram"></i></i></a>
                    <a class="btn btn-uns mx-2 fs-5 mb-5 mb-lg-0" href="https://www.youtube.com/@UniversidadNacionaldelSanta" role="button" target="_blank"><i class="bi bi-youtube"></i></a>
                </section>
            </div>

            <!-- Navegación en el sitio -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Unidad Odontológica</h5>
                <hr>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><a class="link-light-uns" href="{{ route('home') }}#">Inicio</a></li>
                    <li class="mb-2"><a class="link-light-uns" href="{{ route('nosotros') }}#mision-vision">Nosotros</a></li>
                    <li class="mb-2"><a class="link-light-uns" href="{{ route('horarios') }}#horarios">Horarios</a></li>
                    <li class="mb-2"><a class="link-light-uns" href="{{ route('login') }}">Ingresar</a></li>
                    <li class="mb-2"><a class="link-light-uns" href="{{ route('register') }}">Registrarse</a></li>
                </ul>
            </div>

            <!-- Navegación UNS en Otras pestañas -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Universidad</h5>
                <hr>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><a class="link-light-uns" href="https://www.uns.edu.pe/#/principal" target="_blank">Página principal</a></li>
                    <li class="mb-2"><a class="link-light-uns" href="https://www.uns.edu.pe/#/directorio" target="_blank">Directorio</a></li>
                    <li class="mb-2"><a class="link-light-uns" href="https://registro.uns.edu.pe/udemsi/faces/index.xhtml" target="_blank">Intranet</a></li>
                    <li class="mb-2"><a class="link-light-uns" href="https://www.uns.edu.pe/#/pagovirtual-fut-tarifario" target="_blank">Pago Virtual - FUT - TUPA y TUSNE</a></li>
                    <li class="mb-2"><a class="link-light-uns" href="https://www.uns.edu.pe/vistas/bases_de_datos.html" target="_blank">Bases de datos Bibliográficas</a></li>
                    <li class="mb-2"><a class="link-light-uns" href="https://www.uns.edu.pe/#/transparencia/12a/ley-de-transparencia" target="_blank">Transparencia</a></li>
                    <li class="mb-2"><a class="link-light-uns" href="https://www.uns.edu.pe/vistas/politicas_de_privacidad.html" target="_blank">Políticas de Provacidad</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="text-center p-3 bg-black-uns">
        &copy; {{ date('Y') }} <a class="link-light-uns" href="{{ route('home') }}">Unidad Odontológica UNS</a>
    </div>
</footer>
<!-- Fin de Footer -->
