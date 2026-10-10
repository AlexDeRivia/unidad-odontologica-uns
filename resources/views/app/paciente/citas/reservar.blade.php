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

        <div class="col-lg-10 offset-lg-1">

            <form action="{{ route('paciente.citas.store') }}" method="post" class="needs-validation" novalidate>

                @csrf

                <div class="card my-3">
                    <div class="card-header">Reservar Cita</div>
                    @foreach ($errors->all() as $error)
                        @component('components.alertheader')
                            @slot('alert', $error)
                        @endcomponent
                    @endforeach
                    <div class="card-body">
                        <div class="row text-lg-end">
                            <div class="col-lg-2">
                                <label for="dentista_id" class="form-label">Dentista</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <select class="form-select" name="dentista_id" id="dentista_id" required>
                                    <option></option>
                                    @foreach ($dentistas as $dentista)
                                        <option value="{{ $dentista->usuario_id }}" {{ old('dentista_id') == $dentista->usuario_id ? 'selected' : '' }}>
                                            {{ $dentista->nombres . ' ' . $dentista->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-2">
                                <label for="fecha" class="form-label">Fecha</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="date" name="fecha" id="fecha" value="{{ old('fecha') }}" class="form-control" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-2">
                                <label class="form-label">Horario</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                @for ($i = 8; $i <= 13; $i++)
                                    @php
                                        $startTime = sprintf('%02d:00:00', $i);
                                        $endTime = sprintf('%02d:00:00', $i + 1);
                                        $id = str_replace(':', '', $startTime);
                                    @endphp
                                    <input type="radio" class="btn-check" name="hora" id="{{ $id }}" value="{{ $startTime }}" required {{ old('hora') == $startTime ? 'checked' : '' }}>
                                    <label class="btn btn-light d-block w-100 rounded-0 border" for="{{ $id }}">{{ $startTime }}&emsp;-&emsp;{{ $endTime }}</label>
                                @endfor
                                <div class="invalid-feedback">Eliga un horario</div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label for="motivo_id" class="form-label">Motivo</label>
                                    </div>
                                    <div class="col-lg-8 mb-3">
                                        <select class="form-select" name="motivo_id" id="motivo_id" required>
                                            <option></option>
                                            @foreach ($motivos as $motivo)
                                                <option value="{{ $motivo->motivo_id }}" {{ old('motivo_id') == $motivo->motivo_id ? 'selected' : '' }}>
                                                    {{ $motivo->descripcion }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Este campo es obligatorio</div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="comentario" class="form-label">Comentario</label>
                                    </div>
                                    <div class="col-lg-8 mb-3">
                                        <textarea class="form-control" placeholder="Si tienes algo más que añadir, ¡estamos aquí para escucharte!" id="comentario" name="comentario" rows="7">{{ old('comentario') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('paciente.citas') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="ms-auto btn btn-primary">Reservar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection