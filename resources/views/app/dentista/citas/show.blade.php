@extends('layouts.dentista')

@section('title', 'Unidad Odontológica')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a type="button" class="ms-auto btn btn-secondary" href="{{ route('dentista.citas') }}">
            <i class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">

    <div class="row">

        <div class="col-lg-6 offset-lg-3">

            <form action="{{ route('dentista.citas.atender', $cita) }}" method="post">

                @csrf
                <div class="card my-3">
                    <div class="card-header">Atender</div>
                    <div class="card-body">
                        <p>La siguiente cita será atendida:</p>
                        <table class="table table-hover">
                            <tr>
                                <th>Motivo</th>
                                <td>{{ $cita->motivo->descripcion }}</td>
                            </tr>
                            <tr>
                                <th>Paciente</th>
                                <td>{{ $cita->paciente->nombres . ' ' . $cita->paciente->apellidos }}</td>
                            </tr>
                            <tr>
                                <th>Fecha y hora</th>
                                <td>{{ $cita->fecha . ' ' . $cita->hora }}</td>
                            </tr>
                        </table>
                        <label for="comentario_dentista" class="form-label">Comentarios adicionales:</label>
                        <textarea class="form-control" id="comentario_dentista" name="comentario_dentista" rows="3"></textarea>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('dentista.citas') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="ms-auto btn btn-primary">Atender</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
