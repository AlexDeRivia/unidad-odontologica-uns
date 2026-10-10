@extends('layouts.admin')

@section('title', 'Unidad Odontológica')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a type="button" class="ms-auto btn btn-secondary" href="{{ route('admin.especialidad-asignar') }}">
            <i class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">

    <div class="row">

        <div class="col-lg-6 offset-lg-3">

            <form action="{{ route('admin.especialidad-asignar.process') }}" method="post">

                @csrf

                <input type="hidden" name="dentista_id" value="{{ $dentista->usuario_id }}">
                <div class="card my-3">
                    <div class="card-header">Selecciona las Especialidades</div>
                    <div class="card-body">
                        <p>Dentista:</p>
                        <table class="table table-striped table-hover">
                            <tr>
                                <td>DNI:</td>
                                <td>{{ $dentista->dni }}</td>
                            </tr>
                            <tr>
                                <td>Correo:</td>
                                <td>{{ $dentista->correo }}</td>
                            </tr>
                            <tr>
                                <td>Nombres:</td>
                                <td>{{ $dentista->nombres . ' ' . $dentista->apellidos }}</td>
                            </tr>
                        </table>
                        <p>Selecciona las especialidades de este dentista:</p>
                        <div class="row">
                            @foreach ($especialidades as $especialidad)
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" name="especialidades[]" type="checkbox" value="{{ $especialidad->especialidad_id }}" id="{{ $especialidad->especialidad_id }}" {{ in_array($especialidad->especialidad_id, array_column($dentista['especialidades']->toArray(), 'especialidad_id')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $especialidad->especialidad_id }}">{{ $especialidad->descripcion }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.especialidad-asignar') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="ms-auto btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
