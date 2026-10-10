@extends('layouts.welcome')

@section('title', 'Unidad Odontológica')

@section('content')
@include('partials.app.carousel')

<div class="container bg-white shadow py-4 py-md-5">

    <div class="mx-0 mx-lg-5 px-0 px-sm-3" id="mision-vision">

        <h3 class="text-danger">Unidad Odontológica - UNS</h3>
        <p class="pb-3">
            La unidad Odontológica es una parte del Servicio de Medicina ofrecido por la Universidad Nacional del Santa
            a través de la Oficina Central de Bienestar Universitario, que cuenta con moderna infraestructura, materiales,
            equipos de alta calidad y profesionales capacitados para garantizar un servicio odontológico de calidad.
        </p>

        <div class="row mb-3 g-0 align-items-center border rounded-3 py-2 px-3 shadow-sm">
            <div class="col-md-5">
                <div class="uo-feature-panel uo-feature-panel--compact"><i class="fa-solid fa-tooth" aria-hidden="true"></i><span>Misión</span></div>
            </div>
            <div class="col-md-7 px-0 px-md-3">
                <h4 class="text-danger my-3">Misión</h4>
                <hr>
                <p>
                    Nuestra misión en la Unidad Odontológica de la Universidad Nacional del Santa es brindar atención odontológica de alta calidad,
                    accesible y gratuita para todos los miembros de la comunidad universitaria, incluyendo alumnos, docentes, trabajadores y sus familias.
                    Extendemos nuestro compromiso más allá de los límites de la universidad al ofrecer servicios gratuitos a la comunidad en general.
                    Además, nos esforzamos por difundir información crucial sobre la salud oral y el sistema estomatognático, así como llevar a cabo
                    programas de promoción y prevención para garantizar una población más saludable en general. Nuestro enfoque se centra en su bienestar,
                    brindando atención profesional y esmerada a precios asequibles.
                </p>
            </div>
        </div>

        <div class="row g-0 align-items-center border rounded-3 py-2 px-3 shadow-sm">
            <div class="col-md-7 px-0 px-md-3">
                <h4 class="text-danger my-3">Visión</h4>
                <hr>
                <p>
                    En el año 2024, la Unidad Odontológica de la Universidad Nacional del Santa se convertirá en un referente en la atención odontológica de calidad en la región.
                    Continuaremos mejorando nuestra infraestructura y equipos para mantenernos a la vanguardia en tecnología odontológica. Ampliaremos nuestros servicios para abarcar
                    todas las necesidades de salud oral de nuestra comunidad universitaria y la población en general. Nuestra visión es ser reconocidos por la excelencia en la atención,
                    la promoción de la salud oral y la prevención de enfermedades bucales. Nos esforzaremos por ser líderes en la formación de profesionales de la odontología comprometidos
                    con la ética y el servicio a la sociedad. Continuaremos trabajando con pasión y dedicación para garantizar sonrisas saludables y felices para todos.
                </p>
            </div>
            <div class="col-md-5">
                <div class="uo-feature-panel uo-feature-panel--compact"><i class="fa-solid fa-heart-pulse" aria-hidden="true"></i><span>Visión</span></div>
            </div>
        </div>
    </div>

    <div class="mx-0 mx-lg-5 px-0 px-sm-3" id="equipo">

        <h3 class="text-danger mt-5">Nuestro Equipo</h3>

        <div class="card my-3">
            <div class="card-header">Lista de dentistas</div>
            <div class="card-body">
                <table class="table table-striped table-hover" id="mitabla3">
                    <thead>
                        <tr>
                            <th>Dentista</th>
                            <th>Especialidades</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Dentista</th>
                            <th>Especialidades</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($dentistas as $dentista)
                        <tr>
                            <td>
                                <table>
                                    <tr>
                                        <td class="pe-4"><span class="fw-semibold">Nombres:</span></td>
                                        <td>{{ $dentista->nombres }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pe-4"><span class="fw-semibold">Apellidos:</span></td>
                                        <td>{{ $dentista->apellidos }}</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                @if ($dentista->especialidades->count() > 0)
                                <ul class="ps-4">
                                    @foreach ($dentista->especialidades as $especialidad)
                                    <li>{{ $especialidad->descripcion }}</li>
                                    @endforeach
                                </ul>
                                @else
                                    <p class="text-secondary fst-italic ps-4">Este dentista no cuenta con especialidades</p>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mx-0 mx-lg-5 px-0 px-sm-3" id="servicios">
        <h3 class="text-danger mt-5 mb-3">Nuestras Especialidades</h3>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($especialidades as $especialidad)
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2"><i class="fas fa-check-circle fa-2x text-primary"></i></div>
                            <div class="col-10">{{ $especialidad->descripcion }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
