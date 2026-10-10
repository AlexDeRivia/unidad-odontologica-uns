@extends('layouts.admin')

@section('title', 'Unidad Odontológica')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a type="button" class="ms-auto btn btn-secondary" href="{{ route('admin.home') }}">
            <i class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">
    <div class="card my-3">
        <div class="card-header">Asignación de Especialidades</div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="mitabla2">
                <thead>
                    <tr>
                        <th></th>
                        <th>Dentista</th>
                        <th>Especialidades</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Dentista</th>
                        <th>Especialidades</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($dentistas as $dentista)
                    <tr>
                        <td>
                            <a href="{{ route('admin.especialidad-asignar.show', $dentista) }}" class="btn btn-md-option btn-primary p-1 px-2">
                                <i class="me-2 fa-solid fa-plus-minus"></i></i>Asignar
                            </a>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td class="pe-4"><span class="fw-semibold">ID:</span></td>
                                    <td>{{ $dentista->usuario_id }}</td>
                                </tr>
                                <tr>
                                    <td class="pe-4"><span class="fw-semibold">DNI:</span></td>
                                    <td>{{ $dentista->dni }}</td>
                                </tr>
                                <tr>
                                    <td class="pe-4"><span class="fw-semibold">Correo:</span></td>
                                    <td>{{ $dentista->correo }}</td>
                                </tr>
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

<script src="{{ asset('dist/js/datatables.js') }}"></script>
<script src="{{ asset('dist/js/mitable.js') }}"></script>

@endsection
