@extends('layouts.paciente')

@section('title', 'Unidad Odontológica')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a type="button" class="btn btn-primary" href="{{ route('paciente.citas.create') }}">
            <i class="fa-solid fa-calendar me-2"></i>Reservar
        </a>
        <a type="button" class="ms-auto btn btn-secondary" href="{{ route('paciente.home') }}">
            <i class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">
    <div class="card my-3">
        <div class="card-header">Lista de Citas reservadas</div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="mitabla">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Estado</th>
                        <th>Motivo</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Dentista</th>
                        <th>Comentario del paciente</th>
                        <th>Comentario del dentista</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Estado</th>
                        <th>Motivo</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Dentista</th>
                        <th>Comentario del paciente</th>
                        <th>Comentario del dentista</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($citas as $cita)
                    <tr>
                        <td>
                            <a href="{{ route('paciente.citas.edit', $cita) }}" class="btn btn-lg-option btn-primary p-1 px-2 @if ($cita->estado_id != 1) disabled @endif">
                                Reprogramar
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('paciente.citas.show', $cita) }}" class="btn btn-sm-option btn-danger p-1 px-2 @if ($cita->estado_id != 1) disabled @endif">
                                Cancelar
                            </a>
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
                        <td><span class="field-lg">{{ $cita->dentista->nombres . ' ' . $cita->dentista->apellidos }}</span></td>
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