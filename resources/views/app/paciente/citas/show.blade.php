@extends('layouts.paciente')

@section('title', 'Unidad Odontológica')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a type="button" class="ms-auto btn btn-secondary" href="{{ route('paciente.citas') }}">
            <i class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">

    <div class="row">

        <div class="col-lg-6 offset-lg-3">

            <form action="{{ route('paciente.citas.cancel', $cita) }}" method="post">

                @csrf
                @method('delete')

                <div class="card my-3">
                    <div class="card-header">Cancelar</div>
                    <div class="card-body">
                        <p>La siguiente cita será cancelada:</p>
                        <input type="hidden" name="id" value="93">
                        <table class="table table-hover">
                            <tr>
                                <th>Motivo</th>
                                <td>{{ $cita->motivo->descripcion }}</td>
                            </tr>
                            <tr>
                                <th>Dentista</th>
                                <td>{{ $cita->dentista->nombres . ' ' . $cita->dentista->apellidos }}</td>
                            </tr>
                            <tr>
                                <th>Fecha</th>
                                <td>{{ $cita->fecha }}</td>
                            </tr>
                            <tr>
                                <th>Hora</th>
                                <td>{{ $cita->hora }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('paciente.citas') }}" class="btn btn-secondary">Volver</a>
                        <button type="submit" class="ms-auto btn btn-danger">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection