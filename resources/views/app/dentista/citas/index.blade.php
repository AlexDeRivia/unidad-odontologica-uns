@extends('layouts.dentista')

@section('title', 'Unidad Odontológica')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a type="button" class="ms-auto btn btn-secondary" href="{{ route('dentista.home') }}">
            <i class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">
    <div class="card my-3">
        <div class="card-header">Lista de Citas reservadas por mis Pacientes</div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="mitabla2">
                <thead>
                    <tr>
                        <th></th>
                        <th>Estado</th>
                        <th>Motivo</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Paciente</th>
                        <th>Comentario del paciente</th>
                        <th>Comentario del dentista</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Estado</th>
                        <th>Motivo</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Paciente</th>
                        <th>Comentario del paciente</th>
                        <th>Comentario del dentista</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($citas as $cita)
                    <tr>
                        <td>
                            <a role="button" href="{{ route('dentista.citas.show', $cita) }}" class="btn btn-sm-option btn-primary p-1 px-2 @if ($cita->estado_id != 1) disabled @endif">Atender</a>
                        </td>
                        <td>
                            <span class="field-sm">
                            @switch($cita->estado_id)
                                @case(1)
                                    <span class="text-secondary">{{ $cita->estado->descripcion }}</span>
                                    @break
                                @case(2)
                                    <span class="text-success">{{ $cita->estado->descripcion }}</span>
                                    @break
                                @case(3)
                                    <span class="text-danger">{{ $cita->estado->descripcion }}</span>
                                    @break
                                @default
                            @endswitch
                            </span>
                        </td>
                        <td><span class="field-lg">{{ $cita->motivo->descripcion }}</span></td>
                        <td><span class="field-sm">{{ $cita->fecha }}</span></td>
                        <td><span class="field-sm">{{ $cita->hora }}</span></td>
                        <td><span class="field-lg">{{ $cita->paciente->nombres . ' ' . $cita->paciente->apellidos }}</span></td>
                        <td><span class="field-xl">{{ $cita->comentario }}</span></td>
                        <td><span class="field-xl">{{ $cita->comentario_dentista }}</span></td>
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